<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table ='comments';
    protected $primarykey='id';
    public $timestamp='true';
    protected $fillable = ['user_id','user_name','post_id','post_type','content',];
}
