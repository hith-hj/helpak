<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\create;
use Event;

class Service extends Model
{
    protected $table='services';
    protected $primarykey='id';
    public $timestamp='true';
    protected $fillable=['user_id','user_name','user_role','content','type','address','phone','views','likes','comments',];

    // protected static function boot()
    // {
    //     parent::boot();
    //     Service::Created(function ($model){
    //        event(new create($model));
    //     });
    // }

    public function likes(){
        return $this->hasMany('App\Likes');
    }

    public function comments(){
        return $this->hasMany('App\Comments');
    }
}
