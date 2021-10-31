<?php
namespace App\Model\DbModels;
use Illuminate\Notifications\Notifiable;
use DesignMyNight\Mongodb\Auth\User as Authenticatable;
class Appointments extends Authenticatable
{
    //use Authenticatable, Authorizable, CanResetPassword;
    use Notifiable;
    protected $connection = 'mongodb';
    public $table = "appointments";
    public $timestamps = true;
    //protected $dates = ['created_at','updated_at','apt_date','appointment_date'];
    protected $fillable = [
        'date','time','mobile','status','doctor'
       

    ];
    protected $guarded = [];
 




}