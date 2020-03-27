<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Swim\Tax\Models\TaxMap;
use Swim\Tax\Models\TaxRate;
use Swim\Tax\Models\TaxCategory;

$factory->define(TaxMap::class, function (Faker $faker) {
    return [
        'tax_category_id' => function () {
            return factory(TaxCategory::class)->create()->id;
        },
        'tax_rate_id' => function () {
            return factory(TaxRate::class)->create()->id;
        },
    ];
});
