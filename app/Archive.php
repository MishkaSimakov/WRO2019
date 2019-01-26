<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    protected $fillable = ['channel_id', 'value', 'date', 'longitude', 'latitude', 'status_id'];

    protected $dates = [
        'created_at',
        'updated_at',
        'date'
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
