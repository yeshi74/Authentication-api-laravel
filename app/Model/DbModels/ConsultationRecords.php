<?php
namespace App\Model\DbModels;
use Illuminate\Notifications\Notifiable;
use DesignMyNight\Mongodb\Auth\User as Authenticatable;
class ConsultationRecords extends Authenticatable
{
    //use Authenticatable, Authorizable, CanResetPassword;
    use Notifiable;
    protected $connection = 'mongodb';
    public $table = "consultations";
    public $timestamps = true;
    //protected $dates = ['created_at','updated_at','apt_date','appointment_date'];
    protected $fillable = [
        'userid','name','mobile','email','date','typ','consultation_name','front','back','left','right','upward','top','eyebrows'
       

    ];

  protected $guarded = [];

}