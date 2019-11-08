<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model 
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('text', 'contact', 'commission', 'facebook_url', 'twitter_url', 'instgram_url', 'about_us', 'terms');

}