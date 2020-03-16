<?php

use Faker\Generator as Faker;
use Webkul\Classes\Models\Classes;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Classes::class, function (Faker $faker, array $attributes) {

    return [
        'status'    => 1,
        'position'  => $faker->randomDigit,
        'parent_id' => 1,
    ];
});

$factory->state(Classes::class, 'inactive', [
    'status' => 0,
]);
