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
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $channels = Channel::all()->where('id', $post->id);

        foreach ($channels as $channel) {
            $archives = Archive::all()->where('channel_id', $channel->id);
        }

        $lava = new Lavacharts; // See note below for Laravel

        $population = $lava->DataTable();

        $population->addDateColumn('Year')->addNumberColumn('Number of People')
            ->addRow(['2006', 623452])
            ->addRow(['2007', 685034])
            ->addRow(['2008', 716845])
            ->addRow(['2009', 757254])
            ->addRow(['2010', 778034])
            ->addRow(['2011', 792353])
            ->addRow(['2012', 839657])
            ->addRow(['2013', 842367])
            ->addRow(['2014', 873490]);

        $lava->AreaChart('Population', $population, [
            'title' => 'Population Growth',
            'legend' => [
                'position' => 'in'
            ]
        ]);

        return view('posts.show', compact('archives', 'post', 'population', 'lava'));
    }
}