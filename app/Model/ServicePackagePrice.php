<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class ServicePackagePrice extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public function package()
    {
        return $this->belongsTo('App\Model\ServicePackage','package_id');
    }
    public static function type($type)
    {
        switch ($type){
            case 'active':
                return '<span class="badge bg-success">فعال</span>';
                break;
            case 'pending':
                return '<span class="badge bg-danger">غیرفعال</span>';
                break;
            default:
                return '';
                break;
        }
    }
}
