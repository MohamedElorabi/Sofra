<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IO extends Model 
{

    protected $table = 'item_order';
    public $timestamps = true;
    protected $fillable = array('note', 'price');

}