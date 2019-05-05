<?php

namespace App\Http\Controllers;

use App\Archive;
use App\Channel;
use App\Current;
use App\Post;
use App\Sensor;
use App\Status;
use App\Unit;
use App\Untrusted_post;
use Carbon\Carbon;
use function compact;
use function dd;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function json_encode;
use Khill\Lavacharts\Lavacharts;
use function max;
use function min;
use function rand;
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
        if ($request->user_id) {
            $posts = $posts->where('user_id', $request->user_id);
        }

        return view('posts.index', compact('posts'));
    }

    public function load(Request $request) {
            $channel_id = $request->get('channel_id');

            $channel = Channel::all()->where('id', $channel_id)->first();

            if ($request->get('time') == 'all') {
                $archives = $channel->archives()->latest('date')->get();
            } else {
                $archives = $channel->archives()->where('date', '>', Carbon::now()->subDays($request->get('time')))->latest('date')->get();
            }

            //dd($archives);

            $html = '';

            if ($archives->count() == 0) {
                $html = '<li class="list-group-item">
                            <h2>
                                Нет данных за этот период
                            </h2>
                          </li>';
            } else {
                foreach ($archives as $archive) {
                    $html .= '<li class="list-group-item ' . $archive->status->issue . '">
                            <a href = "' . $archive->status->url . '">
                            <h2 style = "color: ' . $archive->status->color . '" title = "' . $archive->status->name . '">
                                ' . $archive->value . $archive->channel->sensor->units . '
                                <time>' . $archive->date->format('d-m-Y H:i:s') . '</time>
                            </h2>
                            </a>
                          </li>';
                }
            }

        echo json_encode($html);
    }

    public function show(Post $post)
    {
        //$post->load('channels.sensor');

        foreach ($post->channels as $channel) {
            $graph[$channel->id] = $channel->graph;
        }

        return view('posts.show', compact('post'));
    }

    public function adding()
    {
        return view('posts.adding');
    }

    public function confirm(Request $request)
    {
        $untrusted_post = Untrusted_post::all()->where('mac_address', $request->mac)->first();

        if (!$untrusted_post) {
            return redirect(route('posts.adding'));
        }

        if ($untrusted_post->code == $request->code) {
            Untrusted_post::destroy($untrusted_post->id);

            $post = Post::make();

            $post->name = $request->name;
            $post->mac_address = $request->mac;
            $post->code = $request->code;
            $post->user_id = Auth::user()->id;

            $post->default_longitude = 42.205;
            $post->default_latitude = 47.516;

            $post->save();
        } else {
            return redirect(route('posts.adding'));
        }

        return redirect(route('posts.show', compact('post')));
    }

    public function edit(Post $post, Request $request) {
        $post->update(['name' => $request->name]);
        $post->update(['default_latitude' => $request->latitude]);
        $post->update(['default_longitude' => $request->longitude]);

        return redirect(route('posts.show', $post));
    }

    public function add_untrusted(Request $request)
    {
        $post = Untrusted_post::make();

        $post->code = $request->code;
        $post->mac_address = $request->mac_address;

        $post->save();

        return redirect(route('home'));
    }
}