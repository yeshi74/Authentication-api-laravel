<?php

namespace App\Model\DbModels;

 
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
 
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;

class Admin extends Eloquent   implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    use Notifiable;
    protected $connection = 'mongodb';
    protected $collection = 'admin_users';
    public $timestamps = false;
    protected $fillable = [
        'name', 'email','phone','address','category','city','country','services_offered','logo','permissions'
    ];

    protected $hidden = [
        'password'
    ];
    public function addNew($input)

    {
        $check = static::where('google_id',$input['google_id'])->first();
        if(is_null($check)){
            return static::create($input);
        }
        return $check;
    }
    
    
}
