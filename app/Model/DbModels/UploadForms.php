<?php
    namespace App\Model\DbModels;
    use Illuminate\Database\Eloquent\Model; 
    class UploadForms extends Model
    {
        public $table = "upl_forms";
        public $timestamps = true;
        protected $fillable = [
            'section','header','item','section_id','item_id','values'
        ];
        public static function insertData($row)
        {
            $data = array();
            $data['section'] = $row[0];
            $data['header'] = $row[1];
            $data['item'] = $row[2];
            $vals = array();
             
            $xctr=3;
            for($sctr=1;$sctr<=10;$sctr++)
            {
                $label = isset($row[$xctr]) ? $row[$xctr] : "";
                $xctr++;
                $value = isset($row[$xctr]) ? $row[$xctr] : "";
                $xctr++;
                $include = isset($row[$xctr]) ? $row[$xctr] : "";
                $xctr++;
                $a = array("label"=>$label,"value"=>$value,"include"=>$include);
                array_push($vals,$a);
            }
            $items = json_encode($vals);
            
            $l = new UploadForms;
            $l->section = $data['section'];
            $l->header = $data['header'];
            $l->item = $data['item'];
            $l->section_id=0;
            $l->item_id=0;
            $l->values = $items;
            $l->save();
        }
        public static function deleteAll()
        {
            UploadForms::where('id','>','0')->delete();
        }
    }
