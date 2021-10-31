<?php

namespace App\Model\DbModels;

use Illuminate\Notifications\Notifiable;
use DesignMyNight\Mongodb\Auth\User as Authenticatable;
class ServiceCategory extends Authenticatable
{
    //use Authenticatable, Authorizable, CanResetPassword;
    use Notifiable;
    protected $connection = 'mongodb';
        public $table = "service_category";
        protected $fillable = [
           'name','code','status','ord','summary','coverimage'
        ];
    public static function getName($id)
    {
        $rs = ServiceCategory::where('_id',$id)->first();
        return $rs->name;
    }
}