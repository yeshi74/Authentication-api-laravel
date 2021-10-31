<?php
    namespace App\Model\DbModels;
    use Illuminate\Database\Eloquent\Model;
    class Roles extends Model
    {
        public $table = "roles";
        public $timestamps = true;
        protected $fillable = [
           'code','name','def_role'
        ];
    public static function getRole()
    {
    	$results = Roles::orderBy('name')->get();
    	return $results;
    }
}
