<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $table ='searches';
    protected $primarykey='id';
    public $timestamp='true';
    protected $fillable = ['title','content','type','dest_id',];

    public function setIndex($title,$content,$type,$dest_id){
        // dd(strlen($content));
        if(strlen($content) > 50 )
        {
            $strArray = explode(' ',$content);
            if(count($strArray)>8)
            {
                $strSlice = array_slice($strArray,0,8);
            } else {
                $strSlice = array_slice($strArray,0,4);
            }
            $finalContent = implode(" ",$strSlice);
            
        } else {
            $finalContent = $content;
        }
        $this->create([
            'title'=>$title,
            'content'=>$finalContent,
            'type'=>$type,
            'dest_id'=>$dest_id,
        ]);
        // dd($strArray,$strSlice,$finalContent);
    }
}
