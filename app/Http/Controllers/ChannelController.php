<?php

namespace App\Http\Controllers;

use App\Channel;
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
}
