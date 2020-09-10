<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table='chats';
    protected $primarykey='id';
    public $timestamp='true';
    protected $fillable=['firstPart','secondPart','msgsCount','status',];
}
