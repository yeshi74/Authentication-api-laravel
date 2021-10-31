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

class Dashboard extends Eloquent   implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    use Notifiable;
    protected $connection = 'mongodb';
        public $table = "dashboard";
        public $timestamps = true;
        protected $fillable = [
            'dbid','desturl','icon','caption','query','status','ord' 
        ];
 
}