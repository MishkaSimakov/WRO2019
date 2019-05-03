<?php

use App\Archive;
use App\Channel;
use App\Status;
use Faker\Generator as Faker;

$factory->define(Archive::class, function (Faker $faker) {
    return [
        'channel_id' => function () {
            return factory(Channel::class)->create()->id;
        },
        'value' => $faker->randomFloat(null, 0, 100),
        'date' => $faker->dateTime(),
        'longitude' => 50,
        'latitude' => 50,
        'status_id' => function () {
            return factory(Status::class)->create()->id;
        }
    ];
});
