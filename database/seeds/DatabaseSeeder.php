<?php

use App\Archive;
use App\Channel;
use App\Current;
use App\Post;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $channels = factory(Channel::class, 3)->create();
//        $post = factory(Post::class, 1)->create();
//
//        foreach ($channels as $channel) {
//            factory(Current::class, 50)->create([
//                'channel_id' => $channel->id
//            ]);
//        }

        $admin = factory(User::class, 1)->create();
    }
}
