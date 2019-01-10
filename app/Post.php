<?php

namespace App;

use function compact;
use Illuminate\Database\Eloquent\Model;
use function route;
use function var_dump;

class Post extends Model
{
    public function channel()
    {
        return $this->hasMany('App\Channel');
    }
    public function getUrlAttribute()
    {
        return route('posts.show', compact('this'));
    }
}
