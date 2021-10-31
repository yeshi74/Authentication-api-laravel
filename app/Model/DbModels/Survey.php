<?php
namespace App\Model\DbModels;
use Illuminate\Database\Eloquent\Model;
class Survey extends Model
{
    public $table = "survey";
    public $timestamps = true;
    protected $fillable = [
       'id','name','status','type','max_points'
    ];
}
