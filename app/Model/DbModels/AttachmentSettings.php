<?php

namespace App\Model\DbModels;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class AttachmentSettings extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "attachments_settings";
    protected $fillable = [
        'module', 'location','filesize','allowed_type' ,'caption','btnAdd','btnSave'
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
