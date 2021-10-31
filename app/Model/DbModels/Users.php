<?php

namespace App\Model\DbModels;

use Illuminate\Notifications\Notifiable;
use DesignMyNight\Mongodb\Auth\User as Authenticatable;
class Users extends Authenticatable
{
    //use Authenticatable, Authorizable, CanResetPassword;
    use Notifiable;
    protected $connection = 'mongodb';
        public $table = "users";
        public $timestamps = true;
        protected $guarded = [];
        public static function getUsers()
        {
            $results = Users::where('status',0)->where('is_admin',1)->select('id','name')->orderBy('name')->get();
            return $results;
        }
        public static function getName($id)
        {
            $cnt = Users::where('id',$id)->count();
            $out="";
            if($cnt > 0){
                $results = Users::where('id',$id)->first();
                $out = $results->name;
            }
            return $out;
        }
}
