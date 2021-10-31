<?php
    namespace App\Model\DbModels;
    use Illuminate\Database\Eloquent\Model;
    class Otps extends Model
    {
        public $table = "registrations";
        public $timestamps = true;
        protected $fillable = [
            'email','empcode','otp','token','mobile'
        ];

}
