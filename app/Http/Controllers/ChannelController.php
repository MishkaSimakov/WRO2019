<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Post;
use App\Sensor;
use function compact;
use Illuminate\Http\Request;
use function redirect;
use function route;
use function var_dump;
use function view;

class ChannelController extends Controller
{
    public function show(Channel $channel)
    {
        return view('channels.show', compact('channel'));
    }

    public function update(Request $request, Channel $channel)
    {
        $channel->sensor->update(['min_value' => $request->min]);
        $channel->sensor->update(['max_value' => $request->max]);
        $channel->sensor->update(['name' => $request->name]);

        return redirect(route('channels.show', $channel));
    }

    public function create(Request $request)
    {
        $channel = Channel::make();

        $channel->post_id =  Post::where('name', $request->post)->get()->first()->id;
        $channel->sensor_id = Sensor::where('name', $request->sensor)->get()->first()->id;
        $channel->precautionary_point = $request->precautionary_point;
        $channel->emergency_point = $request->emergency_point;

        $channel->save();

        return redirect(route('create'));
    }
}
