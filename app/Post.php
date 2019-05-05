<?php

namespace App;

use function compact;
use function dd;
use Illuminate\Database\Eloquent\Model;
use function optional;
use function route;
use function var_dump;
use Illuminate\Http\Request;

class Post extends Model
{
    protected $fillable = ['name', 'default_latitude', 'default_longitude'];

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

    static function getId($mac_address)
    {
        if (Post::where('mac_address', '=', $mac_address)->exists() == true) {
            $post_id = Post::where('mac_address', $mac_address)->first()->id;
        }

        return $post_id;
    }

    public function getIsGPSconnectedAttribute() {
        foreach ($this->channels as $channel) {
            if ($channel->current->status_id == 5) {
                return false;
            }
        }
    }
}
