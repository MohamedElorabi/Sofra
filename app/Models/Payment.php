<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model 
{

    protected $table = 'payments';
    public $timestamps = true;
    protected $fillable = array('note', 'amount');

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}