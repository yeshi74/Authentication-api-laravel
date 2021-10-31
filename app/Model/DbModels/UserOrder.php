<?php

namespace App\Model\DbModels;

use Illuminate\Notifications\Notifiable;
use DesignMyNight\Mongodb\Auth\User as Authenticatable;
class UserOrder extends Authenticatable
{
    //use Authenticatable, Authorizable, CanResetPassword;
    use Notifiable;
    protected $connection = 'mongodb';
        public $table = "user_orders";
        public $timestamps = true;
        protected $fillable = [
           'order_id','order_date','mobile','status','amount','sales_person','userid','document'
        ];

}

