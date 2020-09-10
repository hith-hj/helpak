<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hlsettings extends Model
{
    protected $table ='hl-settings';
    protected $primarykey='id';
    public $timestamp='true';
    protected $fillable = ['user_id','address','phone','can_see_mypost','can_see_myinfo',
                            'can_rate','can_send_message','can_see_myphone','can_see_myaddress'];
}
