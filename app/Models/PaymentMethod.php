<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model 
{

    protected $table = 'payment_methods';
    public $timestamps = true;

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

}