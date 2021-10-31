<?php
namespace App\Model\DbModels;
use Illuminate\Database\Eloquent\Model;
class SurveyField extends Model
{
    public $table = "survey_fields";
    public $timestamps = true;
    protected $fillable = [
       'survey_id','field_name','ord','status','field_type','options','required','fld1','points1',
       'fld2','point2','fld3','points3','fld4','points4','fld5','points5'
    ];
}
