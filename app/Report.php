<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table="reports";
    protected $primarykey='id';
    public $timestamp='true';
    protected $fillable = ['reporter_id','reported_id','type','report'];
}
