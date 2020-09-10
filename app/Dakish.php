<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dakish extends Model
{
    protected $table='dakishes';
    protected $primarykey='id';
    public $timestamp='true';
    protected $fillable=['user_id','user_name','user_role','content','type','address','phone','views','likes','comments',];

}
