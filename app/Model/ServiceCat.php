<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class ServiceCat extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public function service()
    {
        return $this->hasMany('App\Model\Service','category_id');
    }
    public function child_cat()
    {
        return $this->hasMany('App\Model\ServiceCat','service_id')->where('status','active')->orderBy('sort');
    }
    public function packages()
    {
        return $this->hasMany('App\Model\ServiceCat','category_id');
    }
    public function head_service()
    {
        return $this->belongsTo('App\Model\ServiceCat', 'service_id')->first('title');
    }
    public function photo()
    {
        return $this->morphOne('App\Model\Photo', 'pictures');
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
        });
    }
}

