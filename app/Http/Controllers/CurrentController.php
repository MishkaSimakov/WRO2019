<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Current;
use App\Post;
use App\Sensor;
use App\Status;
use App\Untrusted_post;
use function explode;
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
        $message = $request->message;
        $signature = $request->signature;

        $message2 = explode('|', $message);

        $mac_address = $message2[0];
        $sensor_name = $message2[1];
        $date = $message2[2];
        $value = $message2[3];
        $longitude = $message2[4];
        $latitude = $message2[5];

        $post_id = Post::getId($mac_address);

        $secretKey = Post::all()->where('id', $post_id)->first()->code();

        if (hash('md5', $message . $secretKey) == $signature) {
          if ($post_id !== null) {
                $channel_id = Channel::getId($sensor_name, $post_id);

                $current = Current::make();

                $current->channel_id = $channel_id;
                $current->value = $value;
                $current->date = $date;
                $current->longitude = $longitude;
                $current->latitude = $latitude;

                foreach (Status::all() as $status) {
                    eval($status->code);
                }

                $current->save();
            }
        }
    }

    public function date() {
        date_default_timezone_set('Europe/Moscow');

        $date = date('Y m d H i s');

        return $date;
    }
}
