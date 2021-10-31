<?php
    namespace App\Model\DbModels;
    use Illuminate\Database\Eloquent\Model;
    class Slides extends Model
    {
        public $table = "slides";
        public $timestamps = true;
        protected $fillable = [
            'title','ord','status','typ','body','img','video' 
        ];

}
