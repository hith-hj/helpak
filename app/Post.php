<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table ='posts';
    protected $primarykey='id';
    public $timestamp='true';
    protected $fillable=['user_id','user_name','user_role','content','type','address','phone','views','likes','comments','requestCount','requestNumber','file',
    ];

    public function user(){
        return $this->belongTo('App\User');
    }
}
