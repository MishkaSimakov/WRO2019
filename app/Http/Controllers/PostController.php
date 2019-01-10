<?php

namespace App\Http\Controllers;

use a;
use App\Archive;
use App\Channel;
use App\Current;
use App\Post;
use App\Sensor;
use App\Unit;
use function compact;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function max;
use function min;
use function var_dump;
use function view;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $channels = Channel::all()->where('id', $post->id);

        foreach ($channels as $channel) {
            $archives = Archive::all()->where('channel_id', $channel->id);
        }

        return view('posts.show', compact('archives', 'post'));
    }
}