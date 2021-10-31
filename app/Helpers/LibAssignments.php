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
use App\Model\DbModels\AuditForms;
use App\Helpers\LibNotifications;
use DateInterval;
use DatePeriod;
use DateTime;
use DB;
use App\Helpers\LibScores;
use App\Model\DbModels\ToClose;
use App\Model\DbModels\ClosedOutcomeForms;
use App\Model\DbModels\ClosedAuditForms;
use App\Helpers\LibOutcomeForms;
use App\Model\DbModels\FormPeriods;
class LibAssignments
{
    public static function checkListAssignments()
    {
       
        
        $lstForms = Q4eForms::join('q4e_type','q4e_type.id','q4e_forms.typ')
                    ->where('q4e_forms.status',0)
                    ->where('q4e_type.code','CHECKLIST')
                    ->select('q4e_type.code','q4e_forms.*')
                    ->get();

        foreach($lstForms as $row)
        {
            $id = $row->id;
            $code = $row->code;
            $freqType = $row->frequency;
            $nextMonth = date('Y-m-01',strtotime('first day of +1 month'));
            $lstUsers = LibForms::getUserList($id);
            foreach($lstUsers as $u)
            {
                $_userid = $u['userid'];
                $_center = $u['center'];
                switch(strtoupper($freqType)):
                    case "DAILY":
                        $nextDate = date('Y-m-01',strtotime('first day of +1 month'));
                        echo "DAILY === ".$nextDate."\n";
                        $lastDay = date('t',strtotime($nextDate));
                        $mm = date('m',strtotime($nextDate));
                        $yy = date('Y',strtotime($nextDate));
                        for($i=1;$i<=$lastDay;$i++){
                            $dd = $i;
                            if($dd < 10) $dd ="0".$dd;
                            $nextDate = $yy."-".$mm."-".$dd;
                            $period = date('F Y',strtotime($nextDate));
                            $aDate = $nextDate;
                            LibForms::addAssign($id,$_userid,$nextDate,$row->days_submit,$_center,$period,$aDate);
                        }
                        break;
                    case "WEEKLY":
                        $nextDate = date('Y-m-01',strtotime('first day of +1 month'));
                        echo "WEEKLY === ".$nextDate."\n";
                        $lastDay = date('t',strtotime($nextDate));
                        $mm = date('m',strtotime($nextDate));
                        $yy = date('Y',strtotime($nextDate));
                        for($i=1;$i<=$lastDay;$i++){
                            $dd = $i;
                            if($dd < 10) $dd ="0".$dd;
                            $nextDate = $yy."-".$mm."-".$dd;
                            $period = date('F Y',strtotime($nextDate));
                            $aDate = $nextDate;
                            $dayName = date('D',strtotime($nextDate));
                            if($dayName == "Mon") {
                                LibForms::addAssign($id,$_userid,$nextDate,$row->days_submit,$_center,$period,$aDate);
                            }
                        }
                        break;
                    case "FORTNIGHTLY":
                        $nextDate = date('Y-m-01',strtotime('first day of +1 month'));
                        echo "FORTNIGHTLY === ".$nextDate."\n";
                        $period = date('F Y',strtotime($nextDate));
                        LibForms::addAssign($id,$_userid,$nextDate,$row->days_submit,$_center,$period,"");
                        $nextDate = date('Y-m-d',strtotime($nextDate. ' + 14 days'));
                        $aDate = $nextDate;
                        $period = date('F Y',strtotime($nextDate));
                        LibForms::addAssign($id,$_userid,$nextDate,$row->days_submit,$_center,$period,$aDate);
                        break;
                    case "MONTHLY":
                        $nextDate = date('Y-m-01',strtotime('first day of +1 month'));
                        $aDate = $nextDate;
                        $period = date('F Y',strtotime($nextDate));
                        $nextDate = date('Y-m-01',strtotime('first day of +1 month'));
                        LibForms::addAssign($id,$_userid,$nextDate,$row->days_submit,$_center,$period,$aDate);
                        break;
                    default:
                        $nextDate = date('Y-m-01',strtotime('first day of +1 month'));
                        $period = date('F Y',strtotime($nextDate));
                        break;
                endswitch;
                //}
            }
        }
    }
    public static function outcomeAssignments()
    {
        $lstForms = Q4eForms::join('q4e_type','q4e_type.id','q4e_forms.typ')
                    ->where('q4e_forms.status',0)
                    ->where('q4e_type.code','OUTCOME')
                    ->select('q4e_type.code','q4e_forms.*')
                    ->get();
        foreach($lstForms as $row)
        {
            $id = $row->id;
            $code = $row->code;
            $freqType = $row->frequency;
            $nextMonth = date('Y-m-01',strtotime('first day of +1 month'));
            $lstUsers = LibForms::getUserList($id);
            foreach($lstUsers as $u)
            {
                $_userid = $u['userid'];
                $_center = $u['center'];
                echo "USERID ".$_userid." CENTER ".$_center;
                switch(strtoupper($freqType)):
                    case "FORTNIGHTLY":
                        $nextDate = date('Y-m-01',strtotime('first day of +1 month'));
                        $period = date('F Y',strtotime($nextDate));
                        //LibForms::addAssign($id,$_userid,$nextDate,$row->days_submit,$_center,$period,$nextDate);
                        $nextDate = date('Y-m-d',strtotime($nextDate. ' + 14 days'));
                        $aDate = $nextDate;
                        $period = date('F Y',strtotime($nextDate));
                        //LibForms::addAssign($id,$_userid,$nextDate,$row->days_submit,$_center,$period,$aDate);
                        break;
                    case "MONTHLY":
                        $nextDate = date('Y-m-01');

                        $period = date('F Y',strtotime($nextDate));
                        $aDate = $nextDate;
                        $nextDate = date('Y-m-01',strtotime('first day of +1 month'));
                       
                        LibForms::addAssign($id,$_userid,$nextDate,$row->days_submit,$_center,$period,$aDate);
                        break;
                    case "QUARTERLY":
                        $nextDate = date('Y-m-01',strtotime('first day of +1 month'));
                        $nextMonth = intval(date('m',strtotime('first day of +1 month')));
                        $period = date('F Y',strtotime($nextDate));
                        $isValidMonth = LibForms::isValidMonth($id,$nextMonth);
                        if($isValidMonth == 1)
                       // if($nextMonth == 1 || $nextMonth == 4 || $nextMonth == 7 || $nextMonth == 10)
                        {
                            $nMM = intval(date('m',strtotime('first day of +1 month')));
                            $nYY = date('Y',strtotime('first day of +1 month'));
                            $nextDate = $nYY."-".$nMM."-01"; 
                            $period = date('F Y',strtotime($nextDate));
                            $aDate = $nextDate;
                         //   LibForms::addAssign($id,$_userid,$nextDate,$row->days_submit,$_center,$period,$aDate);
                        }
                        break;
                    default:
                        $nextDate = date('Y-m-01',strtotime('first day of +1 month'));
                        $period = date('F Y',strtotime($nextDate));
                        break;
                endswitch;
                //}
            }
        }
    }
    public static function generateAssignments()
    {
        $lstForms = Q4eForms::join('q4e_type','q4e_type.id','q4e_forms.typ')
                    ->where('q4e_forms.status',0)
                    ->where('q4e_forms.typ','!=',5)
                    ->where('q4e_forms.typ','!=',7)
                    ->select('q4e_type.code','q4e_forms.*')
                    ->get();
        foreach($lstForms as $row)
        {
            $id = $row->id;
            $code = $row->code;
            $freqType = $row->frequency;
            $nextMonth = date('Y-m-01',strtotime('first day of +1 month'));
            $lstUsers = LibForms::getUserList($id);
            foreach($lstUsers as $u)
            {
                $_userid = $u['userid'];
                $_center = $u['center'];
                switch(strtoupper($freqType)):
                    case "FORTNIGHTLY":
                        $nextDate = date('Y-m-01',strtotime('first day of +1 month'));
                        $period = date('F Y',strtotime($nextDate));
                        LibForms::addAssign($id,$_userid,$nextDate,$row->days_submit,$_center,$period,$nextDate);
                        $nextDate = date('Y-m-d',strtotime($nextDate. ' + 14 days'));
                        $aDate = $nextDate;
                        $period = date('F Y',strtotime($nextDate));
                        LibForms::addAssign($id,$_userid,$nextDate,$row->days_submit,$_center,$period,$aDate);
                        break;
                    case "MONTHLY":
                        $nextDate = date('Y-m-01',strtotime('first day of +1 month'));
                        $period = date('F Y',strtotime($nextDate));
                        $aDate = $nextDate;
                        $nextDate = date('Y-m-01',strtotime('first day of +1 month'));
                        LibForms::addAssign($id,$_userid,$nextDate,$row->days_submit,$_center,$period,$aDate);
                        break;
                    case "PERPETUAL":
                        break;
                    case "QUARTERLY":
                        $nextDate = date('Y-m-01',strtotime('first day of +1 month'));
                        $nextMonth = intval(date('m',strtotime('first day of +1 month')));
                        $period = date('F Y',strtotime($nextDate));
                        $isValidMonth = LibForms::isValidMonth($id,$nextMonth);
                        if($isValidMonth == 1)
                       // if($nextMonth == 1 || $nextMonth == 4 || $nextMonth == 7 || $nextMonth == 10)
                        {
                            $nMM = intval(date('m',strtotime('first day of +1 month')));
                            $nYY = date('Y',strtotime('first day of +1 month'));
                            $nextDate = $nYY."-".$nMM."-01"; 
                            $period = date('F Y',strtotime($nextDate));
                            $aDate = $nextDate;
                            LibForms::addAssign($id,$_userid,$nextDate,$row->days_submit,$_center,$period,$aDate);
                        }
                        break;
                    default:
                        $nextDate = date('Y-m-01',strtotime('first day of +1 month'));
                        $period = date('F Y',strtotime($nextDate));
                        break;
                endswitch;
                //}
            }
        }
    }
}