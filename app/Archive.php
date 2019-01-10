<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'date'
    ];

    public function channel()
    {
        return $this->belongsTo('App\Channel');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }
}
