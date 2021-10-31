<?php
    namespace App\Model\DbModels;
    use Illuminate\Database\Eloquent\Model;
    class TasksComments extends Model
    {
        public $table = "tasks_comments";
        public $timestamps = true;
        protected $fillable = [
            'task_id','userid','comments' 
        ];

}
