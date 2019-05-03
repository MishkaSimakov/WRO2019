<?php

use App\Status;
use Faker\Generator as Faker;

$factory->define(Status::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'color' => $faker->colorName,
        'issue' => 'list-group-item-danger',
        'code' => '',
    ];
});
