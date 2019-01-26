<?php

namespace App;

use function dd;
use Illuminate\Database\Eloquent\Model;

class Current extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Current $current) {
            Current::where('channel_id', $current->channel->id)->delete();
        });

        static::created(function (Current $current) {
            $current->makeArchive();
        });
    }

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

    public function makeArchive()
    {
        Archive::create([
            'channel_id' => $this->channel_id,
            'value' => $this->value,
            'date' => $this->date,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'status_id' => $this->status_id,
        ]);
    }
}
