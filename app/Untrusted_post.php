<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Untrusted_post extends Model
{
    public function getConfirmUrlAttribute()
    {
        return route('posts.confirm', compact('this'));
    }
}