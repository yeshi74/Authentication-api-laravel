<?php
namespace App\Model\DbModels;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class UserLogs extends Model
{
    public $table = "user_logs";
    public $timestamps = true;
    protected $fillable = [ 'userid','logdate','device','menu'];
    public static function insert($userid,$device="APP",$menu){
    	$l = new UserLogs;
    	$l->userid = $userid;
    	$l->logdate = Carbon::now();
    	$l->device=$device;
        $l->menu=$menu;
    	$l->save();
    }
}
?>
