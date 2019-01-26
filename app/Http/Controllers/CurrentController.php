<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Current;
use App\Post;
use App\Sensor;
use App\Status;
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
}
