<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Current;
use App\Post;
use App\Sensor;
use App\Status;
use App\Untrusted_post;
use Illuminate\Http\Request;
use function route;
use function view;

class CurrentController extends Controller
{
    public function index()
    {
        $statuses = Status::all();
        $channels = Channel::all();
        $posts = Post::all();
        $sensors = Sensor::all();

        return view('create', compact('statuses', 'channels', 'posts', 'sensors'));
    }

    public function create(Request $request)
    {
        $current = Current::make();

        $current->channel_id = $request->channel;
        $current->value = $request->value;
        $current->date = $request->date;
        $current->longitude = $request->longitude;
        $current->latitude = $request->latitude;
        $current->status_id = Status::where('name', $request->status)->get()->first()->id;

        $current->save();

        return redirect(route('create'));
    }

    public function upload(Request $request)
    {
        $post_id = Post::getId($request);

        if ($post_id !== null) {
            $channel_id = Channel::getId($request, $post_id);

            $current = Current::make();

            $current->channel_id = $channel_id;
            $current->value = $request->value;
            $current->date = $request->date;
            $current->longitude = $request->longitude;
            $current->latitude = $request->latitude;

            /*$current->status_id = 6;

            if ($request->longitude == 200) {
                $current->status_id = 5;
            }


            if (Channel::where('id', $channel_id)->first()->emergency_point < $request->value) {
                $current->status_id = 1;
            } elseif (Channel::where('id', $channel_id)->first()->precautionary_point < $request->value) {
                $current->status_id = 3;
            }

            if ((Channel::where('id', $channel_id)->first()->sensor->max_value < $request->value) || (Channel::where('id', $channel_id)->first()->sensor->min_value > $request->value)) {
                $current->status_id = 4;
            }*/

            foreach (Status::all() as $status) {
                eval($status->code);
            }

            $current->save();
        }
    }

    public function date() {
        date_default_timezone_set('Europe/Moscow');

        $date = date('Y m d H i s');

        return $date;
    }
}
