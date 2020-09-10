<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table ='rates';
    protected $primarykey='id';
    public $timestamp='true';
    protected $dates = ['nextDateToAllow'];
    protected $fillable = ['rated_user_id','rating_user_id','rateCount','nextDateToAllowe'];
}
