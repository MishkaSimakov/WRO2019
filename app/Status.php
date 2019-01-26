<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['name', 'color'];

    public function getUrlAttribute()
    {
        return route('statuses.show', compact('this'));
    }
}
