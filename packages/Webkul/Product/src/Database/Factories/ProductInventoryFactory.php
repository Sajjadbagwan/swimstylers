<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Swim\Inventory\Models\InventorySource;
use Swim\Product\Models\Product;
use Swim\Product\Models\ProductInventory;

$factory->define(ProductInventory::class, function (Faker $faker) {
    return [
        'qty'                 => $faker->numberBetween(1, 20),
        'product_id'          => function () {
            return factory(Product::class)->create()->id;
        },
        'inventory_source_id' => function () {
            return factory(InventorySource::class)->create()->id;
        },
    ];
});