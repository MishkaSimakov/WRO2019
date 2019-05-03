<?php

use App\Channel;
use App\Post;
use App\Sensor;
use Faker\Generator as Faker;

$factory->define(Channel::class, function (Faker $faker) {
    return [
        'post_id' => function () {
            return 1;
        },
        'sensor_id' => function () {
            return factory(Sensor::class)->create()->id;
        },
        'precautionary_point' => $faker->randomFloat(null, 0, 50),
        'emergency_point' => $faker->randomFloat(null, 50, 100),
        'periodicity' => 100,
    ];
});
