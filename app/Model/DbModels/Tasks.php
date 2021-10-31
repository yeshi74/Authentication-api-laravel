<?php
    namespace App\Model\DbModels;
    use Illuminate\Database\Eloquent\Model;
    class Tasks extends Model
    {
        public $table = "tasks";
        public $timestamps = true;
        protected $fillable = [
           'assign_to','parent_id','typ','track_id','assign_date','closed_date',
           'exp_closing_date','status','assigned_by'
        ];



}
