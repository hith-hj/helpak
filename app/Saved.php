<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saved extends Model
{
    protected $table ='saves';
    protected $primarykey='id';
    public $timestamp='true';
    protected $fillable = ['post_id','post_type','user_id','saver_id',];
}
