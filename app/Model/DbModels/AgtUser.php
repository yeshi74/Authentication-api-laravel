<?php

namespace App\Model\DbModels;

use Illuminate\Notifications\Notifiable;
use DesignMyNight\Mongodb\Auth\User as Authenticatable;
class AgtUser extends Authenticatable
{
    //use Authenticatable, Authorizable, CanResetPassword;
    use Notifiable;
    protected $connection = 'mongodb';
    public $table = "agt_users";
    public $timestamps = true;
    protected $fillable = [
        'email','password','name','emp_code','city','state','status',
        'pincodes'
    ];

    public static function getUsers()
    {
        $results = AgtUser::where('status',0)->where('is_admin',1)->select('id','name')->orderBy('name')->get();
        return $results;
    }
    
    public static function getName($id)
    {
        $cnt = AgtUser::where('id',$id)->count();
        $out="";
        if($cnt > 0){
            $results = AgtUser::where('id',$id)->first();
            $out = $results->name;
        }
        return $out;
    }
}