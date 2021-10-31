<?php // Code within app\Helpers\Helper.php
namespace App\Helpers;
use Config;
use App\Model\DbModels\Attachments;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Model\DbModels\AttachmentSettings;
use App\Helpers\FileAttachments;
use App\Model\DbModels\Albums;
class LibFiles
{
    public static function getListOfAttachments($id,$module)
    {
        $params['module'] = $module;
        $params['id'] = $id;
        $params['mode'] = "";
        $lstSettings = AttachmentSettings::where('module',$params['module'])->first();
        $lstGallery = FileAttachments::getGallery($params['id'],$params['module']);
        $output=array();
        $ctr=1;
        foreach($lstGallery as $row)
        {
            $a['index'] = $ctr;
            $a['id'] = $row['id'];
            $a['caption'] = $row['caption'];
            $a['file_name'] = $row['file_name'];
            if($a['caption'] =="") $a['caption'] = $a['file_name'];
            $a['typ'] = $row['file_type'];
            if($row['file_type']=="IMAGE"){
                $a['url'] = $row['view'];
                $a['icon'] = $row['view'];
            }
            else{
                $a['url'] = $row['url'];
                $a['icon'] = FileAttachments::getIcon($row['file_ext']); 
            }
            
            
            $a['last_updated'] = date('d/m/Y H:i',strtotime($row['updated_at']));
            $ctr++;
            array_push($output,$a);
        }
        return $output;
    }
    public static function getAttachmentsCount($id,$module)
    {
        $cnt = Attachments::where('parent_id',$id)->where('module',$module)->count();
        return $cnt;
    }
    public static function getAlbumCoverImage($albumID)
    {
        $results = Albums::where('id',$albumID)->first();
        $fileSettings = AttachmentSettings::where('module','ALBUMS')->first();
        $a=array();
        $url = "images/no-image.png";
        if($results->img != 0){
            $cnt = Attachments::where('id',$results->img)->count();
            if($cnt > 0){
                $row = Attachments::where('id',$results->img)->first();
                $path = $fileSettings->location."/".$row['ref'];
                $exists = Storage::disk('local')->exists($path);
                if($exists){
                    $url = "/file/img/".$row['ref']."/".$row['file_name'];
                }
                // else{   
                //     //$path = $fileSettings->location."/no-image.png";
                //     $url = "images/no-image.png";
                // }
                // $a['id'] = $row['id'];
                // $a['file_name'] = $row['file_name'];
                // $a['caption']  = $row['caption'];
                // $a['view'] = url("/file/img/".$row['ref'])."/".$row['file_name'];
                // $a['url'] = url("/file/view/".$row['ref']);
                // $a['icon'] = FileAttachments::getIcon($row['file_ext']);
                // $a['file_type'] = $row['file_type'];
                // $a['parent'] = $row['parent'];
                // $a['updated_at'] = $row['updated_at'];
                // $a['file_ext'] = $row['file_ext'];
                // $url = $a['view'];
            }
            // else{
            //     $path = $fileSettings->location."/no-image.png";
            //     $url = url("images/no-image.png");
            // }
        }
        $url = url($url);
        return $url;
    }
    public static function getSlideImage($id,$img)
    {
        $results = Albums::where('id',$id)->first();
        $fileSettings = AttachmentSettings::where('module','SLIDES')->first();
        $a=array();
        $url = "images/no-image.png";
        $cnt = Attachments::where('parent_id',$id)->count();
        if($cnt > 0){
            $row = Attachments::where('parent_id',$id)->where('module','SLIDES')->first();
            $path = $fileSettings->location."/".$row['img'];
            $exists = Storage::disk('local')->exists($path);
            if($exists){
                $url = "/file/img/".$img."/".$row['file_name'];
            }
                
        }
            
        
        $url = url($url);
        return $url;
    }
    public static function getProfilePicture($id,$profile,$gender)
    {
        if($profile == ""){
            $url = "images/man.png";
            if(strtoupper($gender) == "FEMALE") $url = "images/woman.png";
            $profile = url($url);
        }
        return $profile;
    }
   
}
?>