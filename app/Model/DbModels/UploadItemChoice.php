<?php
    namespace App\Model\DbModels;
    use Illuminate\Database\Eloquent\Model; 
    class UploadItemChoice extends Model
    {
        public $table = "upl_items_choice";
        public $timestamps = true;
        protected $fillable = [
            'item_id','label','val','include','status'
        ];
    }
?>