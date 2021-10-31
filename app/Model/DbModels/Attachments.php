<?php

namespace App\Model\DbModels;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Attachments extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "attachments";
    protected $fillable = [
        'ref', 'module','parent_id','file_name','file_type','file_ext','caption','ord'
    ];
    public $timestamps = true;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

}
 