<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Redos extends Model
{
    protected $table ='redos';
    protected $primarykey='id';
    public $timestamp='true';
    protected $fillable = ['post_user_id','redo_user_id','post_id','post_type',];
}
