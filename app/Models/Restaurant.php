<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Restaurant extends Authenticatable
{

    protected $table = 'restaurants';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'city', 'block_id', 'category_id', 'password', 'status', 'min', 'delivery_cost', 'whatsup', 'restaurant_phone', 'image', 'api_token', 'pin_code', 'is_active');

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function block()
    {
        return $this->belongsTo('App\Models\Block');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable');
    }

    public function tokens()
    {
        return $this->morphMany('App\Models\Token', 'tokenable');
    }

    public function getTotalOrdersAmountAttribute($value)
    {
        $commissions = $this->orders()->where('status',  'delivered')->sum('total');
        return $commissions;
    }
    public function getTotalCommissionsAttribute($value)
    {
        $commissions = $this->orders()->where('status','delivered')->sum('commission');
        return $commissions;
    }
    public function getTotalPaymentsAttribute($value)
    {
        $payments = $this->payments()->sum('amount');
        return $payments;
    }


}
