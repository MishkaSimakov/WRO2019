<?php

namespace App;

use function compact;
use function dd;
use Illuminate\Database\Eloquent\Model;
use Khill\Lavacharts\Lavacharts;

class Channel extends Model
{
    public function current()
    {
        return $this->hasOne(Current::class);
    }

    public function archives()
    {
        return $this->hasMany(Archive::class);
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

    public function getGraphAttribute()
    {
        $lava = new Lavacharts;

        $graph = $lava->DataTable();

        $graph->addDateColumn('Date')->addNumberColumn($this->sensor->name);

        foreach ($this->archives as $archive) {
            $graph->addRow([$archive->date, $archive->value]);
        }

        \Lava::AreaChart('graph' . $this->id, $graph, [
            'title' => $this->sensor->name,
            'legend' => [
                'position' => 'in'
            ]
        ]);

        return $graph;
    }
}