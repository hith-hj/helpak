<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table ='messages';
    protected $primarykey='id';
    public $timestamp='true';
    protected $fillable = ['sender_id','reciver_id','message','status',];
}
