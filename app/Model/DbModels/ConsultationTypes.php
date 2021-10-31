<?php
namespace App\Model\DbModels;
use Illuminate\Notifications\Notifiable;
use DesignMyNight\Mongodb\Auth\User as Authenticatable;
class ConsultationTypes extends Authenticatable
{
    //use Authenticatable, Authorizable, CanResetPassword;
    use Notifiable;
    protected $connection = 'mongodb';
    public $table = "consultation_type";
    public $timestamps = true;
    protected $fillable = [
        'name','typ'
    ];

  
}