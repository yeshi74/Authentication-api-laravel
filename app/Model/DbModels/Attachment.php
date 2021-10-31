<?php

namespace App\Model\DbModels;

use Illuminate\Notifications\Notifiable;
use DesignMyNight\Mongodb\Auth\User as Authenticatable;
class Attachment extends Authenticatable
{
    //use Authenticatable, Authorizable, CanResetPassword;
    use Notifiable;
    protected $connection = 'mongodb';
        public $table = "attachment";
        public $timestamps = true;
        protected $guarded = [];
      
}
