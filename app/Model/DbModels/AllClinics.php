<?php

namespace App\Model\DbModels;

use Illuminate\Notifications\Notifiable;
use DesignMyNight\Mongodb\Auth\User as Authenticatable;
class AllClinics extends Authenticatable
{
    //use Authenticatable, Authorizable, CanResetPassword;
    use Notifiable;
    protected $connection = 'mongodb';
    public $table = "allclinics";
    public $timestamps = true;
    protected $fillable = [
        'name'
    ];

    public static function getCities()
    {
        $results = City::orderBy('name')->get();
        return $results;
    }
    
    public static function getName($id)
    {
        $cnt = City::where('id',$id)->count();
        $out="";
        if($cnt > 0){
            $results = City::where('id',$id)->first();
            $out = $results->name;
        }
        return $out;
    }
    public static function getCode($id)
    {
        $cnt = AllClinics::where('id',$id)->count();
        $out="";
        if($cnt > 0){
            $results = AllClinics::where('id',$id)->first();
            $out = $results->ClinicID;
        }
        return $out;
    }
}