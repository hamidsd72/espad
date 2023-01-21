<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'mobile',
        'password', 
        'mobile_verified',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
    public function photo()
    {
        return $this->morphOne('App\Model\Photo', 'pictures');
    }
    public function file()
    {
        return $this->morphOne('App\Model\Filep', 'files');
    }
    public function state()
    {
        return $this->belongsTo('App\Model\ProvinceCity','state_id');
    }
    public function city()
    {
        return $this->belongsTo('App\Model\ProvinceCity','city_id');
    }
    public function reagent()
    {
        return $this->hasOne('App\User','reagent_id','reagent_code');
    }
    public function marketer()
    {
        return $this->belongsTo('App\Model\Marketer','id','user_id');
    }
    public function agent()
    {
        return $this->belongsTo('App\Model\Agent','id','user_id');
    }
    public function redirect_page($link,$msg)
    {
        return redirect($link)->with('call_message', $msg);
    }
    public function call_pending()
    {
        $call_r= Model\CallRequest::where('status', 'pending')->where('consultant_id',auth()->user()->id)->first();
        if($call_r)
            return $call_r;
        else
            return null;
    }
    public function call_doing()
    {
        $call_r= Model\CallRequest::where('status', 'doing')->where('user',auth()->user()->id)->first();
        if($call_r)
            return $call_r;
        else
            return null;
    }
    public function is_special() {
        if (auth()->user() && auth()->user()->is_special) {
            if (Carbon::now()->diffInDays( Carbon::parse(auth()->user()->is_special) , false) > 0) return true;
        }
        return false;
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($item) {
            $item->photo()->get()
                ->each(function ($photo) {
                    $path = $photo->path;
                    File::delete($path);
                    $photo->delete();
                });
            $item->file()->get()
                ->each(function ($file) {
                    $path = $file->path;
                    File::delete($path);
                    $file->delete();
                });
        });
    }
}
