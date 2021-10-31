<?php

namespace App\Model\DbModels;

use Illuminate\Notifications\Notifiable;
use DesignMyNight\Mongodb\Auth\User as Authenticatable;
class Messages extends Authenticatable
{
    //use Authenticatable, Authorizable, CanResetPassword;
    use Notifiable;
    protected $connection = 'mongodb';
    public $table = "messages";
    public $timestamps = true;
    protected $fillable = [
        'typ','subject','mto','mcc','status','userid','url'
    ];

    public static function insertMessage($params)
    {
        $l = new Messages;
        $l->typ = $params['typ'];
        $l->subject = $params['subject'];
        $l->mto = $params['mto'];
        $l->mcc = $params['mcc'];
        $l->status = $params['status'];
        $l->userid = $params['userid'];
        $l->url = $params['url'];
        $l->save();
    }
     
    
     
}