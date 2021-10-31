<?php

namespace App\Model\AppModels;

use Illuminate\Database\Eloquent\Model;
use App\Model\DbModels\TokenRecords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
class TokenApp extends Model
{

    public static function list()
    {
        $tokens = TokenRecords::select( 'name' , 'docid', 'token', 'message')->get();
        return $tokens;
    }
    
    public static function SaveToken(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'docid' => 'required',
            'token' => 'required',

        ]);

        TokenRecords::create($request->all());
    }
  
}
