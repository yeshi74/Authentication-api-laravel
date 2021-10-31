<?php 
namespace App\Helpers;
use Config;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;
use App\Model\DbModels\Opts;
use App\Model\DbModels\UserPerms;
use App\Model\DbModels\Favorites;
use App\Model\DbModels\AttachmentSettings;
use App\Model\DbModels\Attachments;
use App\Model\DbModels\Notifications;
use App\Model\DbModels\Admin;
use App\Model\DbModels\Department;
use App\Model\DbModels\Locations;
use App\Helpers\FileAttachments;
use App\Model\DbModels\AdminNotifications;
use App\Model\DbModels\Logs;
class Helper
{
  public static function applClasses()
  {
    $data = config('custom.custom');
    $layoutClasses = [
        'theme' => $data['theme'],
        'sidebarCollapsed' => $data['sidebarCollapsed'],
        'navbarColor' => $data['navbarColor'],
        'menuType' => $data['menuType'],
        'navbarType' => $data['navbarType'],
        'footerType' => $data['footerType'],
        'sidebarClass' => 'menu-expanded',
        'bodyClass' => $data['bodyClass'],
        'pageHeader' => $data['pageHeader'],
        'blankPage' => $data['blankPage'],
        'blankPageClass' => '',
        'contentLayout' => $data['contentLayout'],
        'sidebarPositionClass' => '',
        'contentsidebarClass' => '',
        'mainLayoutType' => $data['mainLayoutType'],
    ];
    if($layoutClasses['theme'] == 'dark')
      $layoutClasses['theme'] = "dark-layout";
    elseif($layoutClasses['theme'] == 'semi-dark')
      $layoutClasses['theme'] = "semi-dark-layout";
    else
      $layoutClasses['theme'] = "light";
    switch($layoutClasses['menuType']){
      case "static":
        $layoutClasses['menuType'] = "menu-static";
        break;
      default:
        $layoutClasses['menuType'] = "menu-fixed";
    }

    switch($layoutClasses['navbarType']){
        case "static":
            $layoutClasses['navbarType'] = "navbar-static";
            $layoutClasses['navbarClass'] = "navbar-static-top";
            break;
        case "sticky":
            $layoutClasses['navbarType'] = "navbar-sticky";
            $layoutClasses['navbarClass'] = "fixed-top";
            break;
        case "hidden":
            $layoutClasses['navbarType'] = "navbar-hidden";
            break;
        default:
            $layoutClasses['navbarType'] = "navbar-floating";
            $layoutClasses['navbarClass'] = "floating-nav";
    }

        // sidebar Collapsed
        if($layoutClasses['sidebarCollapsed'] == 'true')
            $layoutClasses['sidebarClass'] = "menu-collapsed";

        // sidebar Collapsed
        if($layoutClasses['blankPage'] == 'true')
            $layoutClasses['blankPageClass'] = "blank-page";

        //footer
        switch($layoutClasses['footerType']){
            case "sticky":
                $layoutClasses['footerType'] = "fixed-footer";
                break;
            case "hidden":
                $layoutClasses['footerType'] = "footer-hidden";
                break;
            default:
                $layoutClasses['footerType'] = "footer-static";
        }

        //Cotntent Sidebar
        switch($layoutClasses['contentLayout']){
            case "content-left-sidebar":
                $layoutClasses['sidebarPositionClass'] = "sidebar-left";
                $layoutClasses['contentsidebarClass'] = "content-right";
                break;
            case "content-right-sidebar":
                $layoutClasses['sidebarPositionClass'] = "sidebar-right";
                $layoutClasses['contentsidebarClass'] = "content-left";
                break;
            case "content-detached-left-sidebar":
                $layoutClasses['sidebarPositionClass'] = "sidebar-detached sidebar-left";
                $layoutClasses['contentsidebarClass'] = "content-detached content-right";
                break;
            case "content-detached-right-sidebar":
                $layoutClasses['sidebarPositionClass'] = "sidebar-detached sidebar-right";
                $layoutClasses['contentsidebarClass'] = "content-detached content-left";
                break;
            default:
                $layoutClasses['sidebarPositionClass'] = "";
                $layoutClasses['contentsidebarClass'] = "";
        }

        return $layoutClasses;
    }
  public static function logs($module,$mode,$log)
  {
    $userid =  Auth::guard('admin')->user()->id;
    $l = new Logs;
    $l->userid = $userid;
    $l->module = $module;
    $l->mode = $mode;
    $l->log = "";
    $l->save();
    $id = $l->id;
    FileAttachments::writeLog($id,$log);
 //   Logs::create(array("userid"=>$userid,"module"=>$module,"mode"=>$mode,"log"=>$log));
  }
  public static function isValid($userid,$module="")
  {
    if($module==""){
      $route = Route::currentRouteName();
    } else {
      $route = $module;
    }
   
    $isValid=false;
    if($userid == "admin")
    {
      $isValid=true;
    }
    else
    {
      $cnt = UserPerms::where('optid',$route)->where('userid',$userid)->count();
      if($cnt > 0) $isValid=true;
    }
    return $isValid;
 
  }
  public static function userDetails($params)
  {
    
   
    $opt['colspan'] = isset($params['colspan']) ?  $params['colspan'] :  3;
    $opt['label'] = isset($params['label']) ? $params['label'] : "";
    $opt['value'] = isset($params['value']) ? $params['value'] : "";
    $opt['span'] = isset($params['span']) ?  $params['span'] : "";
    $html = "";
    if($opt['colspan'] == 12) $html = "<div class='row'>";
    $html .= '<div class="col-md-'.$opt['colspan'].'"><div class="form-group">';
    if($opt['label'])  $html .=  '<label><strong>'.$opt['label'].'</strong></label><br>';
    if($opt['span'] != "") $html .= '<span id="'.$opt['span'].'">';
    $cnt = Admin::where('id',$opt['value'])->count();
    $data['name'] = "";
    $data['emp_code'] = "";
    $data['email'] = "";
    $data['mobile'] = "";
    $data['dept'] = 0;
    $data['location'] = 0;
    if($cnt > 0)
    {
      $results = Admin::where('id',$opt['value'])->first();
      $data['name'] = $results->name;
      $data['emp_code'] = $results->emp_code;
      $data['email'] = $results->email;
      $data['mobile'] = $results->mobile;
      $data['dept'] = $results->dept;
      $data['location'] = $results->location;
    }
    $html .= "<i class='fa fa-user'></i>&nbsp;".$data['name']." (".$data['emp_code'].")";
    if($data['email'] != "") $html .= "<br><i class='fa fa-envelope'></i>&nbsp;".$data['email'];
    if($data['mobile'] != "") $html .= "<br><i class='fa fa-phone'></i>&nbsp;".$data['mobile'];
    if($data['dept'] != 0) 
    {
      $html .= "<br><i class='fa fa-building'></i>&nbsp;".Department::getDepartmentName($data['dept']);
    }
    if($data['location'] != 0) 
    {
      $html .= "<br><i class='fa fa-globe'></i>&nbsp;".Locations::getLocationName($data['location']); 
    }
    if($opt['span'] != "") $html .= "</span>";
    $html .= "</div></div>";
    if($opt['colspan'] == 12) $html .= "</div>";
    return $html;

  }

  public static function adminMenu()
  {
    $userid =  Auth::guard('admin')->user()->email;
     
    $lstParentOpts = Opts::where('parent','MAIN')->where('status','=',0)->orderBy('ord')->get();
    $lstUserOpts = array();
 
    
   # if($userid==env("ADMIN_USERID"))
   # {
      $lstUserOpts = Opts::where('status','=',0)->orderBy('ord')->get();
   # }
   # else
  #  {
      // $lstUserOpts = UserPerms::join('opts','opts.optid','=','user_perms.optid')
      //           ->where('userid','=',$userid)->orderBy('ord')
      //                   ->select('opts.*')->get();
      // $results = array();
      // foreach($lstParentOpts as $row){
      //   $cnt = UserPerms::join('opts','opts.optid','=','user_perms.optid')
      //           ->where('userid','=',$userid)->where('opts.parent','=',$row->optid)
      //           ->count();
      //   if($cnt > 0){
      //     array_push($results,$row);
      //   }
      // }
      // $lstParentOpts = $results;
  #  }
    $lstMenu['lstParentOpts'] = $lstParentOpts;
    $lstMenu['lstUserOpts'] = $lstUserOpts;
    return $lstMenu;
  }
    public static function updatePageConfig($pageConfigs){
        $demo = 'custom';
        if(isset($pageConfigs)){
            if(count($pageConfigs) > 0){
                foreach ($pageConfigs as $config => $val){
                    Config::set('custom.'.$demo.'.'.$config, $val);
                }
            }
        }
    }
  public static function adminLoginInfo()
  {
    $profileImage = Auth::guard('admin')->user()->img;
    if($profileImage == "")
    {
      $gender = Auth::guard('admin')->user()->gender;
      $profileImage="male.png";
      if(strtoupper($gender) == "FEMALE")
      {
        $profileImage = "female.png";
      }
    }
    return view('widgets.admin-login-info',compact('profileImage'))->render();
  }
  public static function adminNotifications()
  {
    $lstNotifications = array();
    $cnt = count($lstNotifications);
    // $cnt = AdminNotifications::getTotalNotifications();
    // $cnt = Notifications::count();
    // $lstNotifications = Notifications::orderBy('cdate')->limit(10)->get();
    return view('widgets.admin-notifications',compact('cnt','lstNotifications'))->render();
  }
    public static function favorites()
    {
      $userid =  Auth::guard('admin')->user()->email;
        $lstFavorites = Favorites::join('opts','opts.optid','favorites.optid')->select('opts.*','favorites.*')->where('userid',$userid)->get();
        $route = Route::currentRouteName() ;
        $pageid=$route;
        return view('widgets.favorites',compact('lstFavorites','route','pageid'))->render();
    }
    public static function close($opts)
    {
      $a = explode(" ",$opts);
      $html = "";
      foreach($a as $c){
        $html .= "</".$c.">";
      }
      return $html;
    }
    public static function attachment($params = array())
    {
      $opt['colspan'] = isset($params['colspan']) ?  $params['colspan'] :  12;
      $opt['id'] = isset($params['id']) ? $params['id'] : "";
      $opt['module'] = isset($params['module']) ? $params['module'] : "";
      $opt['value'] = isset($params['value']) ? $params['value'] : "";
      $opt['label'] = isset($params['label']) ? $params['label'] : "";
      $opt['delete'] = isset($params['delete']) ? $params['delete'] : "";
      $output="";
      $filePresent=0;
      // print_r($opt);
      if($opt['module'] != "")
      {
        $results = FileAttachments::getDetails($opt);
        if($results['type']=="IMAGE")
        {
          $output = "<img src='".$results['url']."' class='img-fluid' alt=''/><br/>".$results['filename'];
          $filePresent=1;
        }
        if($results['type']=="PDF")
        {
          $output = "<a href='".$results['url']."' target='_new'>".$results['filename']."</a>";
          $filePresent=1;
        }
        if($results['type']=="OTHERS")
        {
          $output = $results['filename']."<a href='".$results['url']."' target='_new'><i class='fa fa-download'></i></a>";
          $filePresent=1;
        }
        if($results['type']=="NONE")
        {
          $output = "No attachments/image";
        }
      }
      $html = '<div class="col-md-'.$opt['colspan'].'">';
      $html .= "<label>";
      if($opt['label'] != "") $html .= $opt['label'];
      if(strtoupper($opt['delete']) == "YES" && $filePresent==1) $html .= "<a href='Javascript:void(0)' data-id='".$opt['id']."' class='lnkDeleteAttachment'><i class='fa fa-trash-o'></i></a>";
      $html .= "</label><br>";
      $html .= $output;
      $html .= "</div>";
      return $html;
    }
    public static function form($params = array())
    {
        $opt['name'] = isset($params['name']) ?  $params['name'] :  "frm";
        $opt['class'] = isset($params['class']) ? $params['class'] : "";
        $opt['action'] = isset($params['action']) ? $params['action'] : "";
        $opt['validate'] = isset($params['validate']) ? $params['validate'] : "";
        $opt['method'] = isset($params['method']) ? $params['method'] : "POST";
        $opt['target'] = isset($params['target']) ? $params['target'] : "";
        if($opt['validate'] == "Yes") $opt['class'] = $opt['class']." frmValidate";

        $html = view('widgets.form',compact('opt'))->render();
        return $html;
    }
    public static function startPage($params = array())
    {
      $breadcrumbs = $params['bc'];
      $opts['typ'] = isset($params['typ']) ?  $params['typ'] :  "TABLE";
      $opts['caption'] = isset($params['caption']) ?  $params['caption'] :  "";

      $html = view('widgets.breadcrumb',compact('breadcrumbs'))->render();
      $html .= view('widgets.startpage',compact('opts'))->render();

      return $html;
    }
     
    public static function closePage()
    {
      $html = '</div></div></div></div></div></section></div>';
      return $html;
    }
    public static function button($params = array())
    {
      $opt['colspan'] = isset($params['colspan']) ?  $params['colspan'] :  "";
      $opt['name'] = isset($params['name']) ? $params['name'] : "";
      $opt['class'] = isset($params['class']) ? $params['class'] : "btn-primary";
      $opt['label'] = isset($params['label']) ? $params['label'] : "";
      $opt['type'] = isset($params['type']) ? $params['type'] : "button";
      $opt['icon'] = isset($params['icon']) ? $params['icon'] : "";
      $opt['id'] = isset($params['id']) ? $params['id'] : "";
      $opt['data'] = isset($params['data']) ? $params['data'] : array();
      if($opt['id'] == "") $opt['id'] = $opt['name'];
      if($opt['icon'] != "") $opt['label'] = "<i class='fa ".$opt['icon']."'></i>&nbsp;".$opt['label'];

      $html = "";
      if($opt['colspan'] != "") $html = '<div class="col-md-'.$opt['colspan'].'">';
      $html .=  '<button type="'.$opt['type'].'" class="btn mr-1 mb-1 '.$opt['class'].'" name="'.$opt['name'].'" id="'.$opt['id'].'"';
      if(count($opt['data']) > 0)
      {
        foreach($opt['data'] as $ky=>$val):
          $html .= ' data-'.$ky.'="'.$val.'"';
        endforeach;
      }
      $html .= '>'.$opt['label'].'</button>';
      if($opt['colspan'] != "") $html .= '</div>';
      return $html;
    }
    public static function linkButton($params = array())
    {
      $opt['colspan'] = isset($params['colspan']) ?  $params['colspan'] :  "";
      $opt['name'] = isset($params['name']) ? $params['name'] : "";
      $opt['class'] = isset($params['class']) ? $params['class'] : "btn-primary";
      $opt['label'] = isset($params['label']) ? $params['label'] : "";
      $opt['url'] = isset($params['url']) ? $params['url'] : "Javascript:void(0)";
      $opt['icon'] = isset($params['icon']) ? $params['icon'] : "";
      $opt['id'] = isset($params['id']) ? $params['id'] : "";
      $opt['target'] = isset($params['target']) ? $params['target'] : "";
      $opt['data'] = isset($params['data']) ? $params['data'] : array();
      if($opt['id'] == "") $opt['id'] = $opt['name'];
      if($opt['icon'] != "") $opt['label'] = "<i class='fa ".$opt['icon']."'></i>&nbsp;".$opt['label'];

      $html = "";
      if($opt['colspan'] != "") $html = '<div class="col-md-'.$opt['colspan'].'">';
      $html .=  '<a href="'.$opt['url'].'" class="btn mr-1 mb-1 '.$opt['class'].'" ';
      if(count($opt['data']) > 0)
      {
        foreach($opt['data'] as $ky=>$val):
          $html .= ' data-'.$ky.'="'.$val.'"';
        endforeach;
      }
      if($opt['target'] != "'") $html .= " target='".$opt['target']."' ";
      $html .= '>'.$opt['icon']." ".$opt['label'].'</a>';
      if($opt['colspan'] != "") $html .= '</div>';
      return $html;
    }
    public static function textbox($params = array())
    {
      $html = "";
      $opt['colspan'] = isset($params['colspan']) ?  $params['colspan'] :  3;
      $opt['label'] = isset($params['label']) ? $params['label'] : "";
      $opt['name'] = isset($params['name']) ? $params['name'] : "";
      $opt['class'] = isset($params['class']) ? $params['class'] : "";
      $opt['value'] = isset($params['value']) ? $params['value'] : "";
      $opt['typ'] = isset($params['typ']) ? $params['typ'] : "text";
      $opt['max'] = isset($params['max']) ? $params['max'] : "";
      $opt['required'] = isset($params['required']) ? $params['required'] : "";
      $opt['placeholder'] = isset($params['placeholder']) ? $params['placeholder'] : "";
      $opt['max'] = isset($params['max']) ? $params['max'] : "";
      if($opt['placeholder'] == "") $opt['placeholder'] = $opt['label'];
      $opt['id'] = isset($params['id']) ? $params['id'] : "";
      if($opt['id']=="") $opt['id'] = $opt['name'];
      if($opt['colspan'] == 12) $html = '<div class="row">';
      $html .= '<div class="col-md-'.$opt['colspan'].' col-12"><div class="form-group">';


      switch(strtoupper($opt['typ'])):
        case "TEXTAREA":
          $html .= '<fieldset class="form-group">';
          if($opt['label'] != "") $html .= '<label for="'.$opt['id'].'">'.$opt['label'].'</label>';
          $html .= '<textarea name="'.$opt["name"].'" id="'.$opt["id"].'" class="form-control '.$opt["class"].'" placeholder="'.$opt['placeholder'].'">';
          $html .= $opt['value'];
          $html .= "</textarea>";
          break;
        case "FILE":
          $html .= '<fieldset class="form-group">';
          if($opt['label'] != "") $html .= '<label for="'.$opt['id'].'">'.$opt['label'].'</label>';
          $html .= '<div class="custom-file">';
          $html .= '<input type="file" class="custom-file-input '.$opt['class'].'" id="'.$opt['id'].'" name="'.$opt['name'].'"/>';
          $html .= '<label class="custom-file-label" for="'.$opt['id'].'">Choose file</label>';
          $html .= '</div></fieldset>';
          break;
        case "DATE":
          if($opt['label'] != "") $html .= '<label for="'.$opt['id'].'">'.$opt['label'].'</label>';
          $html .= '<input type="text" name="'.$opt["name"].'" id="'.$opt["id"].'"';
          $html .= ' class="form-control  pickadate-months-year '.$opt['class'].'" placeholder="'.$opt['placeholder'].'" value="'.$opt['value'].'"';
          if($opt['required'] != "") $html .= " required";
          $html .= '/>';
          break;
        case "NUMBER":
          if($opt['label'] != "") $html .= '<label for="'.$opt['id'].'">'.$opt['label'].'</label>';
          $html .= '<input type="number" name="'.$opt["name"].'" id="'.$opt["id"].'"';
          $html .= ' class="form-control '.$opt['class'].'" placeholder="'.$opt['placeholder'].'" value="'.$opt['value'].'"';
          if($opt['required'] != "") $html .= " required";
          $html .= '/>';
          break;
        case "HTML":
          $html .= '<fieldset class="form-group">';
          if($opt['label'] != "") $html .= '<label for="'.$opt['id'].'">'.$opt['label'].'</label>';
          $html .= '<textarea name="'.$opt["name"].'" id="'.$opt["id"].'" class="htmlEditor form-control '.$opt["class"].'" placeholder="'.$opt['placeholder'].'">';
          $html .= $opt['value'];
          $html .= "</textarea>";
          break;
        default:
          if($opt['label'] != "") $html .= '<label for="'.$opt['id'].'">'.$opt['label'].'</label>';
          $html .= '<input type="'.$opt["typ"].'" name="'.$opt["name"].'" id="'.$opt["id"].'"';
          $html .= ' class="form-control '.$opt['class'].'" placeholder="'.$opt['placeholder'].'" value="'.$opt['value'].'"';
          if($opt['required'] != "") $html .= "required";
          if($opt['max'] != "") $html .= " maxlength='".$opt['max']."'";
          $html .= '/>';
          break;
      endswitch;

      $html .= '</div></div>';
      if($opt['colspan'] == 12) $html .= '</div>';

      if(strtoupper($opt['typ'])=="HTML") 
      {
       // $html .= "<script>$(document).ready(function(){ var quill = new Quill('#".$opt['id']."',{modules: {toolbar: '#toolbar'},theme: 'snow'});});</script>";
      }
      return $html;
    }
    public static function hidden($params)
    {
      $opt['name'] = isset($params['name']) ?  $params['name'] :  "frm";
      $opt['id'] = isset($params['id']) ?  $params['id'] :  "";
      $opt['value'] = isset($params['value']) ? $params['value'] : "";
      if($opt['id']=="") $opt['id'] = $opt['name'];
      $html = '<input type="hidden" name="'.$opt['name'].'" id="'.$opt['id'].'" value="'.$opt['value'].'"/>';
      return $html;
    }
    public static function selectStatus($params)
    {
        $opt['colspan'] = isset($params['colspan']) ?  $params['colspan'] :  12;
        $opt['name'] = isset($params['name']) ? $params['name'] : "";
        $opt['id'] = isset($params['id']) ? $params['id'] : "";
        $opt['class'] = isset($params['class']) ? $params['class'] : "";
        $opt['label'] = isset($params['label']) ? $params['label'] : "";
        $opt['value'] = isset($params['value']) ? $params['value'] : "0";
        if($opt['id'] == "") $opt['id'] = $opt['name'];
        $html = '<div class="col-12 col-md-'.$opt['colspan'].'"><div class="form-group">';
        if($opt['label'] != "") $html .= '<label>'.$opt['label'].'</label>';
        $html .= '<select name="'.$opt['name'].'" id="'.$opt['id'].'" class="form-control '.$opt['class'].'">';
        $html .= '<option value="0" ';
        if($opt['value'] == 0) $html .= " selected";
        $html .= '>Active</option>';
        $html .= '<option value="1"';
        if($opt['value'] == 1) $html .= " selected";
        $html .= '>Suspend</option>';
        $html .= '</select>';
        $html .= '</div></div>';
        return $html;
    }
    public static function selectNumber($params)
    {
      $opt['colspan'] = isset($params['colspan']) ?  $params['colspan'] :  12;
      $opt['name'] = isset($params['name']) ? $params['name'] : "";
      $opt['id'] = isset($params['id']) ? $params['id'] : "";
      $opt['class'] = isset($params['class']) ? $params['class'] : "";
      $opt['label'] = isset($params['label']) ? $params['label'] : "";
      $opt['value'] = isset($params['value']) ? $params['value'] : "0";
      $opt['from'] = isset($params['from']) ? $params['from']:0;
      $opt['to'] = isset($params['to']) ? $params['to']  : 10;
      $opt['from'] = intval($opt['from']);
      $opt['to'] = intval($opt['to']);
      if($opt['id'] == "") $opt['id'] = $opt['name'];
      $html = '<div class="col-12 col-md-'.$opt['colspan'].'"><div class="form-group">';
      if($opt['label'] != "") $html .= '<label>'.$opt['label'].'</label>';
      $html .= '<select name="'.$opt['name'].'" id="'.$opt['id'].'" class="form-control '.$opt['class'].'">';
      for($ctr=$opt['from'];$ctr<=$opt['to'];$ctr++)
      {
        $html .= '<option value="'.$ctr.'"';
        if($opt['value'] == $ctr) $html .= " selected";
        $html .=">";
        $html .= trim($ctr);
        $html .= '</option>';
      }
      $html .= '</select></div></div>';
      return $html;
    }
  public static function selectList($params)
  {
    $opt['colspan'] = isset($params['colspan']) ?  $params['colspan'] :  12;
    $opt['name'] = isset($params['name']) ? $params['name'] : "";
    $opt['id'] = isset($params['id']) ? $params['id'] : "";
    $opt['class'] = isset($params['class']) ? $params['class'] : "";
    $opt['label'] = isset($params['label']) ? $params['label'] : "";
    $opt['key'] = isset($params['key']) ? $params['key'] : "";
    $opt['val'] = isset($params['val']) ? $params['val'] : "";
    $opt['blank'] = isset($params['blank']) ? $params['blank'] : "";
    $opt['value'] = isset($params['value']) ? $params['value'] : "";
    $opt['lookup'] = isset($params['lookup']) ? $params['lookup'] : "";
    $opt['lookupcol'] = isset($params['lookupcol']) ? $params['lookupcol'] : "";
    $opt['attach'] = isset($params['attach']) ? $params['attach'] : false;
    $opt['data-ref']=isset($params['data-ref']) ? $params['data-ref'] : false;
    $opt['multiple'] = isset($params['multiple']) ? $params['multiple'] : "";
    if($opt['id']=="") $opt['id'] = $opt['name'];
    $html = '<div class="col-12 col-md-'.$opt['colspan'].'"><div class="form-group">';
    if($opt['label'] != "") $html .= '<label for="'.$opt['id'].'">'.$opt['label'].'</label>';
    if($opt['attach']) $attach='data-attach='.$opt['attach']; else $attach='';
    $html .= '<select '.$attach.' name="'.$opt['name'].'" id="'.$opt['id'].'" class="select2 form-control '.$opt['class'].'"';
    if($opt['multiple'] != "") $html .= ' multiple="multiple"';
    $html .= '">';
    if($opt['data-ref']) $opt['blank'] = "Yes";
    if($opt['blank'] == "Yes") $html .= '<option id="blank" value="" disabled selected></option>';
    foreach($params['options'] as $r):
      $sel = $opt['value'] == $r[$opt['key']] ? " selected" : "";
      $b=0;
      if($opt['lookup'] != "")
      {
        if($r[$opt['lookupcol']] == $opt['lookup']) $b=1;
      }
      else
      {
        $b=1;
      }
      $m='';
      if($opt['data-ref']) $m="data-ref=".$r[$opt['data-ref']];
      $b=1;
      if($b==1) $html .= '<option '.$m.' '.$sel.' value="'.trim($r[$opt['key']]).'">'.$r[$opt['val']].'</option>';
    endforeach;
    $html .= '</select></div></div>';
    return $html;
  }
  public static function chip($params)
  {
    $html = "";
    $opt['badge'] = isset($params['badge']) ? $params['badge'] : "primary";
    $opt['message'] = isset($params['message']) ? $params['message'] : "";
    $opt['urlClass'] = isset($params['urlClass']) ? $params['urlClass'] : "";
    $opt['urlID'] = isset($params['urlID']) ? $params['urlID'] : "";
    if($opt['message']){
      $html = '<div class="row"><div class="col-md-12"><div class="chip chip-'.$opt['badge'].' mr-1">';
      $html .= '<div class="chip-body"><span class="chip-text">';
      if($opt['urlID'] != "")
      {
        $html .= '<a style="color:white;" href="Javascript:void(0)" data-id="'.$opt['urlID'].'" class="'.$opt['urlClass'].'">';
      }
      $html .= $opt['message'];
      if($opt['urlID'] != "")
      {
        $html .= '</a>';
      }
      $html .= '</span></div></div></div></div>';
    }
    return $html;
  }
  public static function select($params)
  {
      $opt['colspan'] = isset($params['colspan']) ?  $params['colspan'] :  12;
      $opt['name'] = isset($params['name']) ? $params['name'] : "";
      $opt['id'] = isset($params['id']) ? $params['id'] : "";
      $opt['class'] = isset($params['class']) ? $params['class'] : "";
      $opt['label'] = isset($params['label']) ? $params['label'] : "";
      $opt['blank'] = isset($params['blank']) ? $params['blank'] : "";
      $opt['value'] = isset($params['value']) ? $params['value'] : "";
      $opt['multiple'] = isset($params['multiple']) ? $params['multiple'] : "";

      if($opt['id']=="") $opt['id'] = $opt['name'];
      if($opt['multiple'] != "") $opt['multiple'] = " multiple";
      $html = '<div class="col-12 col-md-'.$opt['colspan'].'"><div class="form-group">';
      if($opt['label'] != "") $html .= '<label>'.$opt['label'].'</label>';
      $html .= '<select name="'.$opt['name'].'" id="'.$opt['id'].'" class="select2  form-control '.$opt['class'].'"';
      if($opt['multiple'] != "") $html .= ' multiple="multiple"';
      $html .= '>';
      if($opt['blank'] == "Yes") $html .= '<option value=""></option>';
      foreach($params['options'] as $ky=>$val):
        $sel = $opt['value'] == $ky ? " selected" : "";
        $html .= '<option '.$sel.' value="'.$ky.'">'.$val.'</option>';
      endforeach;
      $html .= '</select>';

      $html .= '</div></div>';
      return $html;
  }
  public static function display($params)
  {
    $opt['colspan'] = isset($params['colspan']) ?  $params['colspan'] :  3;
    $opt['label'] = isset($params['label']) ? $params['label'] : "";
    $opt['value'] = isset($params['value']) ? $params['value'] : "";
    $opt['span'] = isset($params['span']) ?  $params['span'] : "";
    $html = "";
    if($opt['colspan'] == 12) $html = "<div class='row'>";
    $html .= '<div class="col-md-'.$opt['colspan'].'"><div class="form-group">';
    if($opt['label'])  $html .=  '<label><strong>'.$opt['label'].'</strong></label><br>';
    if($opt['span'] != "") $html .= '<span id="'.$opt['span'].'">';
    $html .= $opt['value'];
    if($opt['span'] != "") $html .= "</span>";
    $html .= "</div></div>";
    if($opt['colspan'] == 12) $html .= "</div>";
    return $html;
  }
  public static function checkbox($params)
  {
    $opt['colspan'] = isset($params['colspan']) ?  $params['colspan'] :  3;
    $opt['label'] = isset($params['label']) ? $params['label'] : "";
    $opt['value'] = isset($params['value']) ? $params['value'] : "";
    $opt['name'] = isset($params['name']) ? $params['name'] : "";
    $opt['id'] = isset($params['id']) ? $params['id'] : "";
    $opt['selected'] = isset($params['selected']) ? $params['selected'] : "";
    if($opt['id'] == "") $opt['id'] = $opt['name'];
    $html = '<div class="col-md-'.$opt['colspan'].' col-12"><div class="form-group">';
    $html .= '<fieldset class="checkbox"><div class="vs-checkbox-con vs-checkbox-primary">';
    $html .= '<input type="checkbox" name="'.$opt['name'].'" id="'.$opt['id'].'" value="'.$opt['value'].'"';
    if($opt['value'] == $opt['selected']) $html .= " checked";
    $html .= '><span class="vs-checkbox"><span class="vs-checkbox--check"><i class="vs-icon feather icon-check"></i></span></span>';
    $html .= '<span class="">'.$opt['label'].'</span></div></fieldset></div></div>';
    return $html;
  }
  public static function listLocations($params)
  {
    $opt['colspan'] = isset($params['colspan']) ?  $params['colspan'] :  12;
    $opt['name'] = isset($params['name']) ? $params['name'] : "";
    $opt['id'] = isset($params['id']) ? $params['id'] : "";
    $opt['class'] = isset($params['class']) ? $params['class'] : "";
    $opt['label'] = isset($params['label']) ? $params['label'] : "";
    $opt['blank'] = isset($params['blank']) ? $params['blank'] : "";
    $opt['value'] = isset($params['value']) ? $params['value'] : "";
    $opt['multiple'] = isset($params['multiple']) ? $params['multiple'] : "";
    $multiple="";
    if($opt['multiple'] == "") $multiple= "multiple";
    $lstLocations = Locations::orderBy('name')->get();
    if($opt['id']=="") $opt['id'] = $opt['name'];
    $html = '<div class="col-12 col-md-'.$opt['colspan'].'"><div class="form-group">';
    if($opt['label'] != "") $html .= '<label>'.$opt['label'].'</label>';
    $html .= '<select '.$multiple.' name="'.$opt['name'].'" id="'.$opt['id'].'" class="select2  form-control '.$opt['class'].'">';
    if($opt['blank'] == "Yes") $html .= '<option value=""></option>';
    foreach($lstLocations as $row)
    {
      if($row['typ'] == "BU")
      {
        $html .= "<optgroup label='".$row['name']."'>";
        foreach($lstLocations as $crow)
        {
          if($crow['parent'] == $row['id'] && $crow['typ'] =="REGION")
          {
            $html .= "<optgroup label='&nbsp;&nbsp;&nbsp;&nbsp;".$crow['name']."'>";
            foreach($lstLocations as $srow)
            {
              if($srow['parent'] == $crow['id'] && $srow['typ'] == "CENTER")
              {
                $html .= "<option value='".$srow['id']."'";
                if($opt['value'] == $srow['id']) $html .= " selected";
                $html .= ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$srow['name']."</option>";
              }
            }
            $html .= "</optgroup>";
          }
        }
        $html .= "</optgroup>";
      }
    }
     
    $html .= '</select>';

    $html .= '</div></div>';
    return $html;
  }

  public static function showAttachment($imgResults,$mode,$ctr,$last)
  {
    return view('widgets.fileAttachment',compact('imgResults','mode','ctr','last'));
  }
  public static function gallery($params)
  {
    //if($params['mode']=="EDIT"){
      $lstSettings = AttachmentSettings::where('module',$params['module'])->first();
      $lstGallery = FileAttachments::getGallery($params['id'],$params['module']);
      $id = $params['id'];
      return view('widgets.gallery',compact('id','lstGallery','params','lstSettings'));
   // }

  }
  public static function accordion($params)
  {
    $html = '<div class="collapse-border-item collapse-header card collapse-bordered">
              <div class="card-header" id="heading"'.$params['id'].' data-toggle="collapse" role="button" data-target="#'.$params['id'].'" aria-expanded="false" aria-controls="'.$params['id'].'">';
    $html .= '<span class="lead collapse-title">'.$params['label'].'</span>';
    $html .= '</div>';
    $html .= '<div id="'.$params['id'].'" class="collapse" aria-labelledby="heading"'.$params['id'].' data-parent="#'.$params['parent'].'">';
    $html .= '<div class="card-body">';
    return $html;
  }
  public static function closeAccordion()
  {
    $html = '</div></div></div>';
    return $html;
  }

  public static function dateTimePicker($params)
  {
    $opt['colspan'] = isset($params['colspan']) ?  $params['colspan'] :  12;
    $opt['name'] = isset($params['name']) ? $params['name'] : "";
    $opt['placeholder'] = isset($params['placeholder']) ? $params['placeholder'] : "";
    $opt['required'] = isset($params['required']) ? $params['required'] : "";
    $opt['class'] = isset($params['class']) ? $params['class'] : "";
    $opt['label'] = isset($params['label']) ? $params['label'] : "";
    $opt['value'] = isset($params['value']) ? $params['value'] : "";
    $opt['hname'] = isset($params['hname']) ? $params['hname'] : "";
    $opt['mname'] = isset($params['mname']) ? $params['mname'] : "";
    $opt['hvalue'] = isset($params['hvalue']) ? $params['hvalue'] : "";
    $opt['mvalue'] = isset($params['mvalue']) ? $params['mvalue'] : "";
    $html = '<div class="col-12 col-md-'.$opt['colspan'].'"><div class="form-group">';
    if($opt['label'] != "") $html .= '<label>'.$opt['label'].'</label>';
    $html .= '<div class="row"><div class="col-md-8"><label>Select Date</label>';
    $html .= '<input type="text" name="'.$opt["name"].'" id="'.$opt["name"].'"';
    $html .= ' class="form-control  pickadate-months-year '.$opt['class'].'" placeholder="'.$opt['placeholder'].'" value="'.$opt['value'].'"';
    if($opt['required'] != "") $html .= " required";
    $html .= '/>';
    $html .= '</div><div class="col-md-2"><label>Hour</label>';
    $html .= '<select name="'.$opt['hname'].'" id="'.$opt['hname'].'" class="form-control '.$opt['class'].'">';
    for($ctr=0;$ctr<=23;$ctr++)
    {
      $sctr=$ctr;
      if($ctr < 10) $sctr = "0".$sctr;
      $sel = $sctr == $opt['hvalue'] ? " selected" : "";
      $html .= "<option value='".$sctr."' ".$sel.">".$sctr."</option>";
    }
    $html .= '</select></div><div class="col-md-2"><label>Minutes</label>';
    $html .= '<select name="'.$opt['mname'].'" id="'.$opt['mname'].'" class="form-control '.$opt['class'].'">';
    for($ctr=0;$ctr<=59;$ctr=$ctr+5)
    {
      $sctr=$ctr;
      if($ctr < 10) $sctr = "0".$sctr;
      $sel = $sctr == $opt['mvalue'] ? " selected" : "";
      $html .= "<option value='".$sctr."' ".$sel.">".$sctr."</option>";
    }
    $html .= '</select></div></div>';

     
    

    $html .= '</div></div>';
    return $html;
  }
  public static function responsiveTableEx($cols)
  {
    $html = '<script>
      $( document ).ready(function() {
        $(".dataTable").dataTable({"order": [[0, "desc"]]});
      });
      </script>
      <div class="row"><div class="col-md-12"><div class="table responsive">
      <table class="table table-striped"><thead><tr>';
    foreach($cols as $c)
    {
      $html .= '<th>'.$c.'</th>';
    }
    $html .= '</tr></thead></tbody>';
    return $html;
  }
  public static function responsiveTable($cols)
  {
    $html = '<div class="row"><div class="col-md-12"><div class="table responsive">';
    $html .= '<table class="table table-striped dataex-html5-selectors"><thead><tr>';
    foreach($cols as $c)
    {
      $html .= '<th>'.$c.'</th>';
    }
    $html .= '</tr></thead></tbody>';
    return $html;
  }
  public static function closeResponsiveTable()
  {
    $html = '</tbody></table></div></div></div>';
    return $html;
  }
}
