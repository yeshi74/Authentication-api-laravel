<?php

namespace App\Model\DbModels;

use Illuminate\Notifications\Notifiable;
use DesignMyNight\Mongodb\Auth\User as Authenticatable;
class AgtOrder extends Authenticatable
{
    //use Authenticatable, Authorizable, CanResetPassword;
    use Notifiable;
    protected $connection = 'mongodb';
        public $table = "agt_orders";
        public $timestamps = true;
        protected $fillable = [
           'order_id','order_date','customer_name','address','pincode','city','status','collected_date',
           'notes', 'collection_notes', 'userid', 'location'
        ];

}