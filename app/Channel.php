<?php

namespace App;

use function compact;
use function dd;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;
use function optional;

class Channel extends Model
{
    protected $fillable = ['precautionary_point', 'emergency_point', 'periodicity'];

    public function current()
    {
        return $this->hasOne(Current::class);
    }

    public function archives()
    {
        return $this->hasMany(Archive::class);
    }

    public function latestArchives()
    {
        return $this->archives()->limit(15)->latest('date');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }

    public function getUrlAttribute()
    {
        return route('channels.show', compact('this'));
    }

    static function getId(Request $request, $post_id) {
        $sensor_id = Sensor::getId($request);

        if (Channel::where([['post_id', $post_id], ['sensor_id', $sensor_id]])->exists() == true) {
            $channel_id = Channel::where([['post_id', $post_id], ['sensor_id', $sensor_id]])->first()->id;
        } else {
            $channel = Channel::make();

            $channel->periodicity = 60;
            $channel->post_id = $post_id;
            $channel->sensor_id = $sensor_id;
            $channel->precautionary_point = 10;
            $channel->emergency_point = 11;

            $channel->save();

            $channel_id = $channel->id;
        }

        return $channel_id;
    }

    public function getGraphAttribute()
    {
        $lava = new Lavacharts;

        $graph = $lava->DataTable();

        $graph->addDateColumn('Date')->addNumberColumn($this->sensor->name)->addNumberColumn('Аварийная уставка')->addNumberColumn('Предупредительная уставка');

        \Lava::LineChart('graph' . $this->id, $graph, [
            'title' => $this->sensor->name,
            'legend' => [
                'position' => 'top'
            ]
        ]);

        return $graph;
    }
}