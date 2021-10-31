<?php
    namespace App\Model\DbModels;
    use Illuminate\Database\Eloquent\Model; 
    class UploadSections extends Model
    {
        public $table = "upl_sections";
        public $timestamps = true;
        protected $fillable = [
            'form_id','name','ord','section_typ','answer_type','style','header1','header2','results_header','remarks_header','display',
            'footer','max_value','status','is_total','section_id','showremarks'
        ];
    }
?>
