<?php
    namespace App\Model\DbModels;
    use Illuminate\Database\Eloquent\Model;
    use App\Model\DbModels\Survey;
    use Carbon\Carbon;
    class TrainingUsers extends Model
    {
        public $table = "training_users";
        public $timestamps = true;
        protected $fillable = [
            'training_id','user_id','start_date','complete_date','status','last_attend','before_survey','after_survey',
            'before_points','after_points'
        ];
        public static function updateLastViewed($id,$userid)
        {
        	$data['last_attend'] = Carbon::now();
        	TrainingUsers::where('training_id',$id)->where('user_id',$userid)->update($data);
        }
        public static function getTrainingStatus($id,$userid)
        {
        	$cnt = TrainingUsers::where('training_id',$id)->where('user_id',$userid)->count();
        	if($cnt > 0)
        	{
        		$results = TrainingUsers::where('training_id',$id)->where('user_id',$userid)->first();
        		$out['status'] = $results->status;
                $out['startDate'] = $results->start_date;
                $out['fStartDate'] = date('d/m/Y',strtotime($results->start_date));
                $out['completeDate'] = "";
                $out['fCompleteDate'] = "";
                $out['lastAttend'] = $results->last_attend;
                $out['fLastAttend'] = date('d/m/Y',strtotime($results->last_attend));
                $out['before'] = $results->before_survey;
                $out['after'] = $results->after_survey;
                $out['results'] = "";
                $html= "";
                if($results->before_survey != 0) {
                    $html = $results->before_points." points in your Pre Training Evaluation";
                }
                if($results->after_survey != 0) {
                    if($html != "") $html .= " and ";
                    $html .= $results->after_points." points in your Post Training Evaluation";
                }
                if($html != ""){
                    $html = "You have scored ".$html;
                }
                $out['results'] = $html;
        		switch($results->status)
        		{
        			case 0:
        				$out['statusName'] = "New";
		        		break;
		        	case 10:
		        		$out['statusName'] = "In Progress";
		        		break;
		        	case 20:
		        		$out['statusName'] = "Completed";
		        		$out['completeDate'] = $results->complete_date;
		        		$out['fCompleteDate'] = date('d/m/Y',strtotime($results->complete_date));
		        		break;
        		}
        	}
        	else
        	{
        		$out['status'] = 0;
        		$out['statusName'] = "New";
        		$out['startDate'] = "";
        		$out['fStartDate'] = "";
        		$out['completeDate'] = "";
        		$out['fCompleteDate'] = "";
        		$out['lastAttend'] = "";
        		$out['fLastAttend'] = "";
                $out['before'] = 0;
                $out['after'] = 0;
        	}
        	return $out;
        }
        public static function getTrainingColor($id,$userid)
        {
            $cnt = TrainingUsers::where('training_id',$id)->where('user_id',$userid)->count();
            $color="";
            if($cnt > 0)
            {
                $results = TrainingUsers::where('training_id',$id)->where('user_id',$userid)->first();
                $out['status'] = $results->status;
                switch($results->status)
                {
                    case 0:
                        $color = "orange";
                        break;
                    case 10:
                        $color = "green";
                        break;
                    case 20:
                        $color = "red";
                        break;
                }
            }
           
            return $color;
        }
        public static function getTrainingUsers($id)
        {
        	$results = TrainingUsers::join('users','users.id','training_users.user_id')
                        ->where('training_id',$id)
                        ->select('users.name as username','training_users.*')
                        ->get();
            $output = array();
            foreach($results as $row)
            {
				$startDate = $row->start_date != "" ?  date('d/m/Y',strtotime($row->start_date)) : "";
                $completeDate = $row->complete_date != "" ?  date('d/m/Y',strtotime($row->complete_date)) : "";
                $lastAttend = $row->last_attend != "" ?  date('d/m/Y',strtotime($row->last_attend)) : "";
                $statusName="";
                if($row->status == 0) $statusName = "New";
                if($row->status == 10) $statusName = "In Progress";
                if($row->status == 20) $statusName = "Completed";
                $a = $row;
                $a['statusName'] = $statusName;
                $a['fStartDate'] = $startDate;
                $a['fCompleteDate'] = $completeDate;
                $a['fLastAttend'] = $lastAttend;
                $a['beforeSurvey']="";
                $a['afterSurvey'] = "";
                if($row->before_survey != 0){
                	$r = Survey::where('id',$row->before_survey)->first();
                	$a['beforeSurvey'] = $r->name;
                }
                if($row->after_survey != 0){
                	$r = Survey::where('id',$row->after_survey)->first();
                	$a['afterSurvey'] = $r->name;
                }
                array_push($output,$a);
            }
            return $output;
        }
}
