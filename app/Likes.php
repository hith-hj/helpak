<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    protected $table ='likes';
    protected $primarykey='id';
    public $timestamp='true';
    protected $fillable = ['user_id','user_name','post_id','post_type',];

    public function service(){
        return $this->belongsTo('App\Service');
    }
}
