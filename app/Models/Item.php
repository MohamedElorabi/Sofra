<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    protected $table = 'items';
    public $timestamps = true;
    protected $fillable = array('image', 'name', 'description', 'price', 'duration', 'restaurant_id');

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}
