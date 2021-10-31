<?php // Code within app\Helpers\Helper.php
namespace App\Helpers;
use Config;
use App\Model\DbModels\Attachments;
use Illuminate\Http\Request;
use App\Model\DbModels\AttachmentSettings;
use Illuminate\Support\Facades\Storage;
class FileAttachments
{
    public static $filePath=array("IMAGE"=>"/file/img/","PDF"=>"/file/pdf/","OTHERS"=>"/file/view/");
    public static function writeLog($id,$contents)
    {
        $filename = "logs/".$id.".log";
        Storage::disk('local')->put($filename, $contents);
    }
    public static function deleteAttachment(Request $request,$params)
    {
        $cnt = Attachments::where('ref',$params['ref'])->where('module',$params['module'])->where('parent_id',$params['id'])->count();
        if($cnt > 0)
        {
            Attachments::where('ref',$params['ref'])->where('module',$params['module'])->where('parent_id',$params['id'])->delete();
            $results = AttachmentSettings::where('module',$params['module'])->first();
            $fileName = $results->location."/".$params['ref'];
            Storage::delete($fileName);
        }
    }
    public static function isValid(Request $request,$params)
    {
        $bFlag=true;
        $message="";
        $data = array();
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $ref = substr(str_shuffle($permitted_chars), 0, 10)."-".time();
        $data['ref'] = $ref;
        $data['module'] = $params['module'];
        $output=array();
        $output['status'] = "SUCCESS";
        $output['ref'] = $data['ref'];
        $output['message'] = "";
        
        $cnt = AttachmentSettings::where('module',$params['module'])->count();
        if($cnt != 0)
        {
            $results = AttachmentSettings::where('module',$params['module'])->first();
            $fileConfig['path'] = $results->location;
            $fileConfig['size'] = $results->filesize;
            if($fileConfig['size']==0)  $fileConfig['size'] = 1024;
            $fileConfig['size'] = $fileConfig['size'] * 1024 * 1024;
            
            $fileConfig['allowed'] = $results->allowed_type;
            if($request->hasFile($params['col']))
            {
            
                $uploadFile = $request->file($params['col']);
                $data['file_name'] = $uploadFile->getClientOriginalName();
                $data['file_ext'] = $uploadFile->getClientOriginalExtension();
                $data['file_size'] = $uploadFile->getSize();
                if($data['file_size'] > $fileConfig['size'])
                {
                    $bFlag=false;
                    $message = "File size exceeds limit";
                }
                else
                {
                    $b=0;
                    if($fileConfig['allowed'] == "*")
                    {
                        $b=1;
                    }
                    else
                    {
                        $ar = explode(";",$fileConfig['allowed']);
                        foreach($ar as $ext)
                        {
                            if(strtoupper($ext) == strtoupper($data['file_ext'])) $b = 1;
                        }
                    }
                    
                    if($b==1)
                    {
                        $uploadFile->storeAs($fileConfig['path'],$data['ref']);
                        $data['file_type'] = "OTHERS";
                        if(strtoupper($data['file_ext']) == "JPG" || strtoupper($data['file_ext']) == "JPEG" || strtoupper($data['file_ext']) == "GIF" || strtoupper($data['file_ext']) == "PNG") $data['file_type'] = "IMAGE";
                        if(strtoupper($data['file_ext']) == "PDF") $data['file_type'] = "PDF";
                    }
                    else
                    {
                        $bFlag = false;
                        $message = "Invalid File Type";
                    }
                }
            }
            // else
            // {
            //     $bFlag=false;
            //     $message = "No file specified for uploading";
            // }
        }
        else
        {
            $bFlag=false;
            $message = "Module not specified";
        }
        
        
        
        if($bFlag==false) 
        {
            $output['message'] = $message;
            $output['status'] = "FAIL";
            $output['ref'] = "";
        }
       //dd($output);
        return $output;
    }

    public static function upload(Request $request,$params)
    {
        $bFlag=true;
        $message="";
        $data = array();
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $ref = substr(str_shuffle($permitted_chars), 0, 10)."-".time();
        $data['ref'] = $ref;
        $data['module'] = $params['module'];
        $data['id'] = $params['id'];
        $output=array();
        $output['status'] = "SUCCESS";
        $output['ref'] = $data['ref'];
        $output['message'] = "";
        
        $cnt = AttachmentSettings::where('module',$params['module'])->count();
        if($cnt != 0)
        {
            $results = AttachmentSettings::where('module',$params['module'])->first();
            $fileConfig['path'] = $results->location;
            $fileConfig['size'] = $results->filesize;
            if($fileConfig['size']==0)  $fileConfig['size'] = 1024;
            $fileConfig['size'] = $fileConfig['size'] * 1024 * 1024;
            
            $fileConfig['allowed'] = $results->allowed_type;
            if($request->hasFile($params['col']))
            {
                $uploadFile = $request->file($params['col']);
                $data['file_name'] = $uploadFile->getClientOriginalName();
                $data['file_ext'] = $uploadFile->getClientOriginalExtension();
                $data['file_size'] = $uploadFile->getSize();
                if($data['file_size'] > $fileConfig['size'])
                {
                    $bFlag=false;
                    $message = "File size exceeds limit";
                }
                else
                {
                    $b=0;
                    if($fileConfig['allowed'] == "*")
                    {
                        $b=1;
                    }
                    else
                    {
                        $ar = explode(";",$fileConfig['allowed']);
                        foreach($ar as $ext)
                        {
                            if(strtoupper($ext) == strtoupper($data['file_ext'])) $b=1;
                        }
                    }
                    if($b==1)
                    {
                        $uploadFile->storeAs($fileConfig['path'],$data['ref']);
                        $data['file_type'] = "OTHERS";
                        if(strtoupper($data['file_ext']) == "JPG" || strtoupper($data['file_ext'])=="JPEG" || strtoupper($data['file_ext'])=="GIF" || strtoupper($data['file_ext'])=="PNG") $data['file_type'] = "IMAGE";
                        if(strtoupper($data['file_ext'])=="PDF") $data['file_type'] = "PDF";
                        //Attachments::where('parent_id',$data['id'])->where('module',$data['module'])->delete();
                        $attachment = new Attachments;
                        $attachment->ref = $data['ref'];
                        $attachment->module = $data['module'];
                        $attachment->parent_id = $data['id'];
                        $attachment->file_name = $data['file_name'];
                        $attachment->file_type = $data['file_type'];
                        $attachment->file_ext = $data['file_ext'];
                        $attachment->save();
                        $id = $attachment->id;
                    }
                    else
                    {
                        $bFlag=false;
                        $message="Invalid File Type";
                    }
                }
            }
            else
            {
                $bFlag=false;
                $message = "No file specified for uploading";
            }
        }
        else
        {
            $bFlag=false;
            $message = "Module not specified";
        }
        if($bFlag==false) 
        {
            $output['message'] = $message;
            $output['status'] = "FAIL";
            $output['ref'] = "";
        }
       //dd($output);
        return $output;
    }
    public static function  uploadAttachment(Request $request)
    {
        $bFlag=true;
        $message="";
        $data = array();
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $ref = substr(str_shuffle($permitted_chars), 0, 10)."-".time();
        $data['ref'] = $ref;
        $data['module'] = $request->module;
        $data['id'] = $request->id;
        $data['caption'] = $request->caption;
        $output=array();
        $output['status'] = "SUCCESS";
        $output['ref'] = $data['ref'];
        $output['message'] = "";
        $output['parent'] = $request->id;
        $output['caption'] = $request->caption;
        $cnt = AttachmentSettings::where('module',$data['module'])->count();
        if($cnt != 0)
        {
            $results = AttachmentSettings::where('module',$data['module'])->first();
            $fileConfig['path'] = $results->location;
            $fileConfig['size'] = $results->filesize;
            if($fileConfig['size']==0)  $fileConfig['size'] = 1024;
            $fileConfig['size'] = $fileConfig['size'] * 1024 * 1024;
            
            $fileConfig['allowed'] = $results->allowed_type;
            if($request->hasFile("file"))
            {
            
                $uploadFile = $request->file("file");
                $data['file_name'] = $uploadFile->getClientOriginalName();
                $data['file_ext'] = $uploadFile->getClientOriginalExtension();
                $data['file_size'] = $uploadFile->getSize();
                if($data['file_size'] > $fileConfig['size'])
                {
                    $bFlag=false;
                    $message = "File size exceeds limit";
                }
                else
                {
                    $b=0;
                    if($fileConfig['allowed'] == "*")
                    {
                        $b=1;
                    }
                    else
                    {
                        $ar = explode(";",$fileConfig['allowed']);
                        foreach($ar as $ext)
                        {
                            if(strtoupper($ext) == strtoupper($data['file_ext'])) $b=1;
                        }
                    }
                    
                    if($b==1)
                    {
                        $uploadFile->storeAs($fileConfig['path'],$data['ref']);
                        $data['file_type'] = "OTHERS";
                        if(strtoupper($data['file_ext']) == "JPG" || strtoupper($data['file_ext'])=="JPEG" || strtoupper($data['file_ext'])=="GIF" || strtoupper($data['file_ext'])=="PNG") $data['file_type'] = "IMAGE";
                        if(strtoupper($data['file_ext'])=="PDF") $data['file_type'] = "PDF";
                        $ord = Attachments::where('parent_id',$data['id'])->where('module',$data['module'])->max('ord');
                         
                        $ord = $ord + 10;
                       //Attachments::where('parent_id',$data['id'])->where('module',$data['module'])->delete();
                        $attachment = new Attachments;
                        $attachment->ref = $data['ref'];
                        $attachment->module = $data['module'];
                        $attachment->parent_id = $data['id'];
                        $attachment->file_name = $data['file_name'];
                        $attachment->file_type = $data['file_type'];
                        $attachment->file_ext = $data['file_ext'];
                        $attachment->caption = $data['caption'];
                        $attachment->ord = $ord;
                        $attachment->save();

                        $output['url'] = url("/file/view/".$data['ref']);
                        $output['view'] = url("/file/img/".$data['ref']);
                        $output['file_type'] = $data['file_type'];
                        $output['updated_at'] = $attachment->updated_at;
                        $output['file_ext'] = $data['file_ext'];
                        $output['file_name'] = $data['file_name'];
                        $output['icon'] = FileAttachments::getIcon($data['file_ext']);
                        $id = $attachment->id;
                        $output['id'] = $id;
                    }
                    else
                    {
                        $bFlag=false;
                        $message="Invalid File Type";
                    }
                }
            }
            else
            {
                $bFlag=false;
                $message = "No file specified for uploading";
            }
        }
        else
        {
            $bFlag=false;
            $message = "Module not specified";
        }
        
        
        
        if($bFlag==false) 
        {
            $output['message'] = $message;
            $output['status'] = "FAIL";
            $output['ref'] = "";
        }
       //dd($output);
        return $output;
    }

    public static function removeAPIAttachments($id,$module)
    {
        Attachments::where('parent_id',$id)->where('module',$module)->delete();
        //todo: delete physical files
    }
    public static function  uploadAPIAttachment($id,$module,$file)
    {
        $caption="";
        $bFlag=true;
        $message="";
        $data = array();
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $ref = substr(str_shuffle($permitted_chars), 0, 10)."-".time();
        $data['ref'] = $ref;
        $data['module'] = $module;
        $data['id'] = $id;
        $data['caption'] = $caption;
        $output=array();
        $output['status'] = "SUCCESS";
        $output['ref'] = $data['ref'];
        $output['message'] = "";
        $output['parent'] = $id;
        $output['caption'] = $caption;
        $cnt = AttachmentSettings::where('module',$data['module'])->count();
        if($cnt != 0)
        {
            $results = AttachmentSettings::where('module',$data['module'])->first();
            $fileConfig['path'] = $results->location;
            $fileConfig['size'] = $results->filesize;
            if($fileConfig['size']==0)  $fileConfig['size'] = 1024;
            $fileConfig['size'] = $fileConfig['size'] * 1024 * 1024;
            
            $fileConfig['allowed'] = $results->allowed_type;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_ext'] = $file->getClientOriginalExtension();
            $data['file_size'] = $file->getSize();
            $file->storeAs($fileConfig['path'],$data['ref']);
            $data['file_type'] = "OTHERS";
            if(strtoupper($data['file_ext']) == "JPG" || strtoupper($data['file_ext'])=="JPEG" || strtoupper($data['file_ext'])=="GIF" || strtoupper($data['file_ext'])=="PNG") $data['file_type'] = "IMAGE";
            if(strtoupper($data['file_ext'])=="PDF") $data['file_type'] = "PDF";
            $ord = Attachments::where('parent_id',$data['id'])->where('module',$data['module'])->max('ord');
            $ord = $ord + 10;
            $attachment = new Attachments;
            $attachment->ref = $data['ref'];
            $attachment->module = $data['module'];
            $attachment->parent_id = $data['id'];
            $attachment->file_name = $data['file_name'];
            $attachment->file_type = $data['file_type'];
            $attachment->file_ext = $data['file_ext'];
            $attachment->caption = $data['caption'];
            $attachment->ord = $ord;
            $attachment->save();
            $id = $attachment->id;
        }
        else
        {
            $bFlag=false;
            $message = "Module not specified";
        }
        if($bFlag==false) 
        {
            $output['message'] = $message;
            $output['status'] = "FAIL";
            $output['ref'] = "";
        }
        return $output;
    }



    public static function getDetails($opt)
    {
        $qry = Attachments::where('module',$opt['module'])->where('parent_id',$opt['id']);
        $output=array('status'=>'FAIL','type'=>'NONE', 'url'=>'','filename'=>'');
        if(isset($opt['value']) && $opt['value']!='') {
            
            $qry->where('ref',$opt['value']);
            $cnt = $qry->count();
            if($cnt > 0){
                $results = $qry->first();
                if($results) {
                    $output['status'] = "SUCCESS";
                    $output['type'] = $results['file_type'];                
                    // $output['url'] = url(self::$filePath[$results['file_type']].$opt['value']);
                    $output['url'] = url("/file/view/".$results['ref']);
                    $output['filename'] = $results['file_name'];
                    $output['caption'] = $results['caption'];
                }
            }
        }
        elseif(isset($opt['list']) && $opt['list']!=false) {
            if(isset($opt['ref']) && $opt['ref']!='') $qry->where('ref',"!=",$opt['ref']);
            $cnt = $qry->count();
            if($cnt > 0) {
                $output=array();
                $results = $qry->get();
                foreach ($results as $v) {
                    $a=array();
                    $a['type']= $v->file_type;                
                    //$a['url'] = url(self::$filePath[$v->file_type].$v->ref);
                    $a['url'] = url("/file/view/".$v['ref']);
                    $a['filename'] = $v['file_name'];
                    $a['caption'] = $v['caption'];
                    $a['status'] = "SUCCESS";
                    array_push($output,$a);
                }
            }
        }
        return $output;
        
    }
    public static function getPathInfo($ref)
    {
        $output = array();
        $cnt = Attachments::where('ref',$ref)->count();
        $path="";
        if($cnt > 0)
        {
          $results = Attachments::where('ref',$ref)->first();
          
          $fileSettings = AttachmentSettings::where('module',$results->module)->first();
          
          $path = $fileSettings->location."/".$ref;
        }
       # echo $path;
      #  die();
        return $path;
    }
    public static function delete($params)
    {
        if(Attachments::where('parent_id',$params['id'])->where('module',$params['module'])->exists())
        {
            $fileSettings = AttachmentSettings::where('module',$params['module'])->first();
            $results = Attachments::where('parent_id',$params['id'])->where('module',$params['module'])->get();
            foreach($results as $row)
            {
                $ref = $row->ref;
                $path = $fileSettings->location."/".$ref;
                Storage::delete($path);
            }
            Attachments::where('parent_id',$params['id'])->where('module',$params['module'])->delete();
            return "SUCCESS";
        }
        else{
            return "FAIL";
        }
        
    }
    public static function viewPDF($params)
    {

    }
    public static function downloadAttachment($params)
    {

    }
    public static function getIcon($ext)
    {
        $icons = array("XLSX"=>"xlsx.png",
                        "XLS"=>"xlsx.png",
                        "DOCX"=>"docx.png",
                        "DOC"=>"docx.png",
                        "PDF"=>"pdf.png",
                        "MPG"=>"mpeg.png",
                        "MOV"=>"mov.png",
                        "TXT"=>"txt.png",
                        "PPT"=>"pptx.png",
                        "PPTX"=>"pptx.png",
                        "MP3"=>"mp3.png",
                        "AVI"=>"avi.png");
        $icon="attachment.png";
        foreach($icons as $ky=>$val){
            if($ky == strtoupper($ext)) {
                if(env("DEV","Y") == "Y") {
                    $icon = url('public/images/icons/'.$val);
                }
                else {
                    $icon = url('images/icons/'.$val);
                }
            }
        }
        return $icon;
        
    }
    public static function getGallery($id,$module)
    {
        $attachmentSettings = AttachmentSettings::where('module',$module)->first();
        $results = Attachments::where('parent_id',$id)->where('module',$module)->orderBy('ord')->get();
        $output=array();
        foreach($results as $row)
        {
            $loc = $attachmentSettings->location;
            $path = $loc."/".$row['ref'];
            $exists = Storage::disk('local')->exists($path);
            if($exists)
            {
            
            $a['id'] = $row['id'];
            $a['file_name'] = $row['file_name'];
            $a['caption']  = $row['caption'];
            $a['view'] = url("/file/img/".$row['ref'])."/".$row['file_name'];
            $a['url'] = url("/file/view/".$row['ref']);
            $a['icon'] = FileAttachments::getIcon($row['file_ext']);
            $a['file_type'] = $row['file_type'];
            $a['parent'] = $row['parent'];
            $a['updated_at'] = $row['updated_at'];
            $a['file_ext'] = $row['file_ext'];
            array_push($output,$a);
            }
        }
        return $output;
    }
}
?>
    