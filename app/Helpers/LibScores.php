<?php // Code within app\Helpers\Helper.php
namespace App\Helpers;
use Config;
use App\Model\DbModels\Attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Model\DbModels\Locations;
use App\Model\DbModels\Tasks;
use App\Model\DbModels\Users;
use App\Model\DbModels\Q4eAssign;
use App\Model\DbModels\Q4eItems;
use App\Model\DbModels\Q4eSections;
use App\Model\DbModels\Q4eAnswerType;
use App\Model\DbModels\Category;
use App\Model\DbModels\Q4eForms;
use App\Model\DbModels\Q4eAttachments;
use App\Model\DbModels\Q4eAnswers;
use App\Model\DbModels\Q4eType;
use App\Model\DbModels\Assignments;
use App\Model\DbModels\Q4eResults;
use App\Model\DbModels\Q4eOutcome;
use App\Model\DbModels\Q4eOAnswers;
use App\Model\DbModels\Q4eResultsCalc;
use App\Model\DbModels\Q4eOutcomeScore;
use App\Model\DbModels\OutcomeForms;
use App\Model\DbModels\Q4EUsers;
use App\Helpers\ApolloHelpers;
use App\Helpers\FileAttachments;
use App\Helpers\LibFiles;
use App\Helpers\LibAPI;
use App\Model\DbModels\Q4eItemsChoice;
use App\Model\DbModels\Q4EPerms;
use App\Model\DbModels\Q4EApiRes;
use App\Model\DbModels\Clinics;
use App\Model\DbModels\Q4ePeriods;
use App\Model\DbModels\ViewCenter;
use App\Model\DbModels\Q4eFormsProps;
use App\Helpers\LibNotifications;
use DateInterval;
use DatePeriod;
use DateTime;
use DB;
use App\Model\DbModels\AuditForms;
use App\Model\DbModels\CheckListForms;
class LibScores
{
	public static function outcomeScore($formid,$score)
	{
		$aScore=0;
		$rs = Q4eForms::where('id',$formid)->select('max_val')->first();
		$maxScore = $rs->max_val;
		if($maxScore == 0) $maxScore = 100;
		if($score != 0){
			$aScore = intval((100 * $score)/$maxScore);
		}
		return $aScore;
	}
	public static function getMaxOutcomeCenter($formid,$cdate,$location)
	{
		$mm = intval(date('m',strtotime($cdate)));
		$yy = date('Y',strtotime($cdate));
		$rs = OutcomeForms::where('form_id',$formid)
				->whereMonth('assign_date',$mm)
				->whereYear('assign_date',$yy)
				->where('status',20)
				->where('perstatus',20)
				->select('total_score','location_id','locname')
				->get();
		$score = 0;
		$loc="";
		$locname = "";
		foreach($rs as $r){
			if($r->total_score > $score){
				$loc = $r->location_id;
				$score = $r->total_score;
				$locname = $r->locname;
			}
		}
		$score = LibScores::outcomeScore($formid,$score);
		$out['locname'] = $locname;
		$m = $locname." achieved the highest score of ".$score;
		return $m;
	}
	public static function fiaAvgScore($yy,$mm)
	{
		$message="";
		$query = "SELECT avg(total_score) as t,location_id FROM v_audit_forms where year(assign_date) = '".$yy."' and month(assign_date) = '".$mm."'";
        $query .= " and status = 20 group by location_id ";
		$query .= " order by avg(total_score) desc limit 1";
		$cnt = AuditForms::whereYear('assign_date',$yy)->whereMonth('assign_date',$mm)->where('status',20)->count();
		if($cnt > 0){
			$r = DB::select($query);
			foreach($r as $r1){
				$maxAvgLoc = $r1->location_id;
				$maxAvgScore = $r1->t;
			}
			$maxAvgScore = round($maxAvgScore,2);
			$maxAvgLocName = Locations::getName($maxAvgLoc);
			$message = "Highest score by ".$maxAvgLocName." with ".$maxAvgScore; 
		}
       
		return $message;
	}
	public static function getFiaScore($location,$yy,$mm)
	{
		$query = AuditForms::where('status',20)
				->where('perstatus',20)
				->whereYear('assign_date',$yy)
				->whereMonth('assign_date',$mm);
		if($location != "") {
			$query->where('location_id',$location);
		}
		$score = $query->select('total_score')
				->avg('total_score');
		$score = round($score,2);
		return $score;
	}
	public static function getCheckListScore($formid,$maxVal,$totalScore)
	{
	   $score=0;
	//    $rs = Q4eForms::where('id',$formid)->select('max_val')->first();
	//    $maxVal = $rs->max_val;
	   if($totalScore !=0 && $maxVal !=0)
	   {
		   $score = (100 * $totalScore) / $maxVal;
		   $score = intval($score);
	   }
	   return $score;
	}
	public static function getAverageCheckListScore($formID,$maxVal,$locationID,$startDate,$user)
	{
		$yy = date('Y',strtotime($startDate));
		$mm = date('m',strtotime($startDate));
		$mm = intval($mm);
		$avg = ChecklistForms::where('form_id',$formID)->where('location_id',$locationID)
			   ->whereYear('start_date',$yy)->whereMonth('start_date',$mm)
			   ->where('userid',$user)
			   ->where('status',20)
			   ->avg('total_score');
		$score = LibScores::getCheckListScore($formID,$maxVal,$avg);
		return $score;
			
	}
}
