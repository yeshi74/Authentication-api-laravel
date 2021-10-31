<?php
namespace App\Model\DbModels;
use Illuminate\Database\Eloquent\Model;
class SurveyAnswers extends Model
{
    public $table = "survey_answers";
    public $timestamps = true;
    protected $fillable = [
       'survey_id','field_id','val','parent_id','typ','caption'
    ];
}
