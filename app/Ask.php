<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ask extends Model
{
    protected $table='asks';
    protected $primarykey='id';
    public $timestamp='true';
    protected $fillable=['post_id','post_type','sender_id','reciver_id','status','type','message','post',];

}
