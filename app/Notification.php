<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use  Auth;

class Notification extends Model
{
    protected $table ='notifications';
    protected $primarykey='id';
    public $timestamp='true';
    protected $fillable = ['sender_id','reciver_id','object_id','object_type','content','viewed'];

    public function add($source,$dest,$object_id,$object_type,$content){
        if($dest !== Auth::user()->id)
        {
            return $this->create([
            'sender_id'=>$source,
            'reciver_id'=>$dest,
            'object_id'=>$object_id,
            'object_type'=>$object_type,
            'content'=>$content,
            'viewed'=>0,
            ]);
        }
        
    }
}
