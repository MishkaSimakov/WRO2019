<?php

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => 'admin',
        'email' => 'msimakov661@gmail.com',
        'password' => Hash::make('MishA2005'),
        'isAdmin' => true,
    ];
});
