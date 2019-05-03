<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Post;
use App\Sensor;
use function compact;
use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;
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

    public function getChart(Request $request)
    {
        $channel = Channel::all()->where('id', $request->get('channel_id'))->first();

        $lava = new Lavacharts;

        $graph = $lava->DataTable();

        $graph->addDateColumn('Date')->addNumberColumn($channel->sensor->name)->addNumberColumn('Аварийная уставка')->addNumberColumn('Предупредительная уставка');

        foreach ($channel->archives as $archive) {
            $graph->addRow([$archive->date, $archive->value, $archive->channel->emergency_point, $archive->channel->precautionary_point]);
        }

        \Lava::LineChart('graph' . $channel->id, $graph, [
            'title' => $channel->sensor->name,
            'legend' => [
                'position' => 'top'
            ]
        ]);

        echo $graph->toJson();
    }

    public function update(Request $request, Channel $channel)
    {
        $channel->update(['precautionary_point' => $request->precautionary_point]);
        $channel->update(['emergency_point' => $request->emergency_point]);
        $channel->update(['periodicity' => $request->periodicity]);

        $channel->sensor->update(['min_value' => $request->min]);
        $channel->sensor->update(['max_value' => $request->max]);
        $channel->sensor->update(['units' => $request->units]);
        $channel->sensor->update(['name' => $request->name]);

        return redirect(route('channels.show', $channel));
    }

    public function getPeriodicity(Request $request) {
        if (Post::where('mac_address', $request->mac_address)->exists() == true) {
            $post_id = Post::where('mac_address', $request->mac_address)->first()->id;
            $sensor_id = Sensor::where('model', $request->sensor_name)->first()->id;

            $periodicity = Channel::where([
                ['post_id', '=', $post_id],
                ['sensor_id', '=', $sensor_id]
            ])->first()->periodicity;

            return $periodicity;
        } else {
            return 3600;
        }
    }
}
