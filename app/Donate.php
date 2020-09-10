<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donate extends Model
{
    protected $table='donates';
    protected $primarykey='id';
    public $timestamp='true';
    protected $fillable = [ 'user_id','user_name','title', 'body' , 'type'  ];
}
