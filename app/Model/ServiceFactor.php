<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ServiceFactor extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function package()
    {
        return $this->belongsTo('App\Model\ServicePackage', 'package_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function services()
    {
        return $this->hasMany('App\Model\ServiceBuy','factor_id');
    }
    public function services_default()
    {
        return $this->hasMany('App\Model\ServiceBuy','factor_id')->where('type',0);
    }
    public function services_custom()
    {
        return $this->hasMany('App\Model\ServiceBuy','factor_id')->where('type',1);
    }
    public function pluses()
    {
        return $this->hasMany('App\Model\ServicePlusBuy','factor_id');
    }
    public function transaction()
    {
        return $this->hasOne('App\Model\Transaction','factor_id');
    }
    public static function pay($type)
    {
        switch ($type){
            case 'paid':
                return '<span class="badge bg-success">پرداخت موفق</span>';
                break;
            case 'credit':
                return '<span class="badge bg-info">خرید اعتباری</span>';
                break;
            case 'pending':
                return '<span class="badge bg-secondary">در انتظار پرداخت</span>';
                break;
            case 'cancel':
                return '<span class="badge bg-warning">لغو پرداخت</span>';
                break;
            case 'notpaid':
                return '<span class="badge bg-danger">پرداخت ناموفق</span>';
                break;
            default:
                return '';
                break;
        }
    }
    public static function check_status($type)
    {
        switch ($type){
            case 'paid':
                return '<span class="badge bg-success">پرداخت موفق</span>';
                break;
            case 'credit':
                return '<span class="badge bg-info">خرید اعتباری</span>';
                break;
            case 'pending':
                return '<span class="badge bg-secondary">در انتظار پرداخت</span>';
                break;
            case 'cancel':
                return '<span class="badge bg-warning">لغو پرداخت</span>';
                break;
            case 'notpaid':
                return '<span class="badge bg-danger">پرداخت ناموفق</span>';
                break;
            default:
                return '';
                break;
        }
    }
    public static function status($type,$type1)
    {
        switch ($type){
            case 'pending':
                if($type1=='cancel')
                {
                    return '<span class="badge bg-danger">عملیات پرداخت لغو شد</span>';
                    break;
                }
                else {
                    return '<span class="badge bg-warning">درحال بررسی</span>';
                    break;
                }
            case 'working':
                return '<span class="badge bg-primary">تایید برای انجام کار</span>';
                break;
            case 'cancel':
                return '<span class="badge bg-danger">کنسل شد</span>';
                break;
            case 'active':
                return '<span class="badge bg-success">انجام شد</span>';
                break;
            default:
                return '';
                break;
        }
    }
    public static function service_plus($factor_id,$service_id)
    {
        return ServicePlusBuy::where('factor_id',$factor_id)->where('buy_id',$service_id)->get();
    }
    public static function service_defult_plus($factor_id,$service_id)
    {
        return ServicePlusBuy::where('factor_id',$factor_id)->where('service_id',$service_id)->get();
    }
}
