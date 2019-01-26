<?php

namespace App;

use function compact;
use Illuminate\Database\Eloquent\Model;
use function optional;
use function route;
use function var_dump;

class Post extends Model
{
    public function channels()
    {
        return $this->hasMany(Channel::class);
    }

    public function archives()
    {
        return $this->hasManyThrough(Archive::class, Channel::class);
    }

    public function currents()
    {
        return $this->hasManyThrough(Current::class, Channel::class);
    }

    public function current()
    {
        return $this->currents->first();
    }

    public function getUrlAttribute()
    {
        return route('posts.show', compact('this'));
    }

    public function getCurrentAttribute()
    {
        return $this->getCurrent();
    }

    public function getCurrent()
    {
        return optional($this->current());
    }
}
