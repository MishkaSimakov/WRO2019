<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public function current()
    {
        return $this->hasOne('App\Current');
    }

    public function archive()
    {
        return $this->hasMany('App\Archive');
    }
    
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
    public function sensor()
    {
        return $this->belongsTo('App\Sensor');
    }

    public function getUrlAttribute()
    {
        return route('channels.show', compact('this'));
    }
}