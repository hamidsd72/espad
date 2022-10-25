<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class CallRequest extends Model
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
        return $this->belongsTo('App\Model\Service','service_id')->first();
    }
    public static function time_call($start,$end,$time,$status)
    {
        $min=Carbon::parse($start)->diffInSeconds(Carbon::parse($end),false);
        $minute=floor($min/60)<10?'0'.floor($min/60):floor($min/60);
        $sec=floor($min%60)<10?'0'.floor($min%60):floor($min%60);
        if($status=='end' || $status=='end_time')
        {
            return $minute.':'.$sec .' از '.$time.':00';
        }
        return '__';
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
                    break;
                case 'pending':
                    $res='درخواست تماس';
                    break;
                case 'doing':
                    $res='در حال تماس';
                    break;
                case 'blocked':
                    $res='رد تماس';
                    break;
                case 'not':
                    $res='بدون پاسخ';
                    break;
                case 'end_time':
                    $res='پایان زمان مشاوره';
                    break;
                default:
                    $res='';
            }
        return $res;
    }
}
