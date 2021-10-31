<?php
    namespace App\Model\DbModels;
    use Illuminate\Database\Eloquent\Model;
    class Training extends Model
    {
        public $table = "training";
        public $timestamps = true;
        protected $fillable = [
           'subject','category','summary','training_date','status','before_survey','after_survey','training_edate',
           'mode','details','location','publish','url'
        ];

}
 
