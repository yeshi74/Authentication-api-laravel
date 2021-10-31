<?php
    namespace App\Model\DbModels;
    use Illuminate\Database\Eloquent\Model; 
    class UploadItems extends Model
    {
        public $table = "upl_items";
        public $timestamps = true;
        protected $fillable = [
            'section_id','name','status','typ','ord','answer_type','header','incalc','max_val','header_show','name_show',
            'no_results','remarks','remarks_show','caption2','caption2_show','results_caption','caption_show'
        ];
    }
?>