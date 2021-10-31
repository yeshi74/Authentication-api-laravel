<?php

namespace App\Model\DbModels;

use Illuminate\Notifications\Notifiable;
use DesignMyNight\Mongodb\Auth\User as Authenticatable;
class Pages extends Authenticatable
{
    //use Authenticatable, Authorizable, CanResetPassword;
    use Notifiable;
    protected $connection = 'mongodb';
        public $table = "pages";
        public $timestamps = true;
        protected $guarded = [];
}
