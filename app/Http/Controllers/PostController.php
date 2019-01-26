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
use function dd;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Khill\Lavacharts\Lavacharts;
use function max;
use function min;
use function var_dump;
use function view;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::all();

        if ($request->name) {
            $posts = $posts->where('name', $request->name);
        }

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load('archives.channel.sensor');

        foreach ($post->channels as $channel) {
            $graph[$channel->id] = $channel->graph;
        }

        return view('posts.show', compact('post', 'lava'));
    }

    public function create(Request $request)
    {
        $post = Post::make();

        $post->name = $request->name;

        $post->save();

        return redirect(route('create'));
    }
}