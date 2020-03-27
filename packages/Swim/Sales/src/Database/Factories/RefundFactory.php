<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Swim\Sales\Models\Order;
use Swim\Sales\Models\Refund;

$factory->define(Refund::class, function (Faker $faker, array $attributes) {
    return [
        'order_id' => function () {
            return factory(Order::class)->create()->id;
        },
    ];
});

