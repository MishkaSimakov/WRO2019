<?php

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'mac_address' => 10,
        'default_latitude' => 10,
        'default_longitude' => 20,
        'user_id' => 1
    ];
});
