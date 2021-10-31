<?php

namespace App\Model\DbModels;

use Illuminate\Database\Eloquent\Model;
use DesignMyNight\Mongodb\Auth\User as Authenticatable;
class TokenRecords extends Authenticatable
{

    protected $connection = 'mongodb';
    public $table = "tokens";
    protected $fillable = [
       'name' , 'docid', 'token', 'message'
    ];

}
