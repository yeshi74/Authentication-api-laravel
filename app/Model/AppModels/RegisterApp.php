<?php

namespace App\Model\AppModels;

use App\Model\DbModels\Users;
use App\Model\DbModels\Gallery;
use App\Model\DbModels\ProfileImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterApp
{

  public static function getProfileImage()
    {
        $userid = Auth::user()->id;
        $cnt = Users::count();
         if($cnt > 0){
            $results = Users::select('id', 'name','image')->get();
            foreach($results as $row):
                $a['id'] = $row->id;
                $a['name'] = $row->name;
                $a['image'] = $row->image;
            endforeach;
            return $a;
        } else {
            $out['status'] = 'fail';
            $out['message'] = 'No leads available yet.';
        }
    }

public static function uploadFile($file,$label)
{
  $path = public_path() .'/users/'; 
  $fileName="";  
  $fileName = $label. '.' . $file->getClientOriginalExtension();            
  $file->move($path, $fileName);

  return $fileName;

}

public static function uploadImage(Request $request)
{
    $userid = Auth::user()->id;
    $arr = $request->all();
        $request->validate([
            'image' => 'required',  //for test purpose, format is ignored
        ]);

        $attachment = new Gallery();
        if($file = $request->file('image')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('gallery/', $name);
            $path =$name;
            $arr['image']=$path;
        }
        $attachment->user_id = $userid;
        $attachment->fill($arr);
        $attachment->save();
}

public static function uploadProfile(Request $request)
{
    $userid = Auth::user()->id;
    $arr = $request->all();
        $request->validate([
            'image' => 'required',   //for test purpose, format is ignored
        ]);

        $attachment = new ProfileImage();
        if($file = $request->file('image')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('profile/', $name);
            $path =$name;
            $arr['image']=$path;
        }
        $attachment->user_id = $userid;
        $attachment->fill($arr);
        $attachment->save();
}

}