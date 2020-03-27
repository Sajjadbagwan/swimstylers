<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Swim\Core\Models\Channel;
use Swim\Customer\Models\Customer;
use Swim\Master\Models\Branch;

$factory->define(Branch::class, function (Faker $faker) {
    $lastOrder = DB::table('branch_master')
            ->orderBy('id', 'desc')
            ->select('id')
            ->first()
            ->id ?? 0;


    //$customer = factory(Customer::class)->create();

    return [
        'branch_name'              => 'Default',
        'branch_desc'              => 'Default',
        'branch_image'             => 'Default',
        
    ];
});

/*$factory->state(Branch::class, 'pending', [
    'status' => 'pending',
]);

$factory->state(Branch::class, 'completed', [
    'status' => 'completed',
]);

$factory->state(Branch::class, 'closed', [
    'status' => 'closed',
]);*/
