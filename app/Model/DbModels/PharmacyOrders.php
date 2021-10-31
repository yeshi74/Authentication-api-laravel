<?php

namespace App\Model\DbModels;

use Illuminate\Notifications\Notifiable;
use DesignMyNight\Mongodb\Auth\User as Authenticatable;
class PharmacyOrders extends Authenticatable
{
    //use Authenticatable, Authorizable, CanResetPassword;
    use Notifiable;
    protected $connection = 'mongodb';
    public $table = "pharmacy_orders";
    public $timestamps = true;
    protected $fillable = [
        'userid','attachment','status','remarks','address','city','pincode'
    ];

     
}