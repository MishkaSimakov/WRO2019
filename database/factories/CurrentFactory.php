<?php

use App\Archive;
use App\Channel;
use App\Current;
use App\Sensor;
use App\Status;
use Faker\Generator as Faker;

$factory->define(Current::class, function (Faker $faker) {
    return [
        'channel_id' => function () {
            return factory(Channel::class)->create()->id;
        },
        'value' => $faker->randomFloat(null, 0, 100),
        'date' => $faker->dateTime(),
        'longitude' => $faker->randomFloat(null, -50, 50),
        'latitude' => $faker->randomFloat(null, -50, 50),
        'status_id' => function () {
            return factory(Status::class)->create()->id;
        }
    ];
});
