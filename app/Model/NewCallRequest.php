<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class NewCallRequest extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function consultant()
    {
        return $this->belongsTo('App\User','consultant_id');
    }
    public function service()
    {
        return $this->belongsTo('App\Model\Service','service_id');
    }
    public static function status_set($status,$end_id)
    {
        $user=\App\User::find($end_id);
        $res='';
        switch ($status)
        {
            case 'end':
                $res='پایان تماس توسط ';
                $res.=$user?$user->first_name.' '.$user->last_name:$end_id;
                $className='text-success';
                break;
            case 'pending':
                $res='درحال تماس';
                $className='text-danger';
                break;
            default:
                $res='اتمام تماس بصورت دستی';
                $className='text-secondary';
        }
        return "<span class='text $className'>$res</span>";
    }
}
