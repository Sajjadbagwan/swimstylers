<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Swim\Product\Models\Product;
use Swim\Sales\Models\Order;
use Swim\Sales\Models\OrderItem;

$factory->define(OrderItem::class, function (Faker $faker) {
    $now = date("Y-m-d H:i:s");

    $product = factory(Product::class, 'simple')->create();

    return [
        'sku'          => $product->sku,
        'type'         => $product->type,
        'name'         => $product->name,
        'price'        => $product->price,
        'base_price'   => $product->price,
        'total'        => $product->price,
        'base_total'   => $product->price,
        'product_id'   => $product->id,
        'qty_ordered'  => 1,
        'qty_shipped'  => 0,
        'qty_invoiced' => 0,
        'qty_canceled' => 0,
        'qty_refunded' => 0,
        'order_id'     => function () {
            return factory(Order::class)->create()->id;
        },
        'created_at'   => $now,
        'updated_at'   => $now,
        'product_type' => Product::class,
    ];
});



