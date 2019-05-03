<?php

use App\Sensor;
use Faker\Generator as Faker;

$factory->define(Sensor::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['температура', 'Давление', 'Радиоактивность', 'Загазованность', 'Уровень воды']),
        'min_value' => $faker->randomFloat(null, 0, 50),
        'max_value' => $faker->randomFloat(null, 50, 100),
        'units' => $faker->word(),
        'model' => 'BH1750',
    ];
});
