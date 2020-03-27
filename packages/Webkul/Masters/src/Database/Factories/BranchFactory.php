<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Webkul\Core\Models\Channel;
use Webkul\Customer\Models\Customer;
use Webkul\Masters\Models\Branch;

$factory->define(Branch::class, function (Faker $faker) {
    $lastOrder = DB::table('branch_master')
            ->orderBy('id', 'desc')
            ->select('id')
            ->first()
            ->id ?? 0;


   // $customer = factory(Customer::class)->create();

    return [
        'id'              => 1,
        'branch_name' => 'free_free',
        'branch_desc' => 'Free Shipping',
        'branch_image' => 'Free Shipping',
    ];
});
/*
$factory->state(Order::class, 'pending', [
    'status' => 'pending',
]);

$factory->state(Order::class, 'completed', [
    'status' => 'completed',
]);

$factory->state(Order::class, 'closed', [
    'status' => 'closed',
]);*/
