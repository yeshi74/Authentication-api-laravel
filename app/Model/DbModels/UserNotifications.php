<?php
    namespace App\Model\DbModels;
    use Illuminate\Database\Eloquent\Model;
    class UserNotifications extends Model
    {
        public $table = "user_notifications";
        public $timestamps = true;
        protected $dates = ['created_at','updated_at','senddate'];

        protected $fillable = [
            'userid','priority','typ','message','status','parent_id','parent_typ','action','template','senddate','mflag','isvalid'
        ];

}
