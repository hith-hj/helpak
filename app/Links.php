<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    protected $table ='links';
    protected $primarykey='id';
    public $timestamp='true';
    protected $fillable = ['first','second','link_on','link_type','post_type','rate',];

}
