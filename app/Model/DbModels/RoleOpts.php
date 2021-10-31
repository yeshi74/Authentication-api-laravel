<?php
    namespace App\Model\DbModels;
    use Illuminate\Database\Eloquent\Model;
    class RoleOpts extends Model
    {
        public $table = "role_opts";
        public $timestamps = true;
        protected $fillable = [
            'role_id','menuid' 
        ];

}
