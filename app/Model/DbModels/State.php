<?php
    namespace App\Model\DbModels;
    use Illuminate\Database\Eloquent\Model;
    class State extends Model
    {
        public $table = "cms_state";
        public $timestamps = true;
        protected $fillable = [
            'name','status','indate'
        ];

}
