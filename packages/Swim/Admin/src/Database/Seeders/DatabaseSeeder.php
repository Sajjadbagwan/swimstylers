<?php

namespace Swim\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Swim\Category\Database\Seeders\DatabaseSeeder as CategorySeeder;
use Swim\Attribute\Database\Seeders\DatabaseSeeder as AttributeSeeder;
use Swim\Core\Database\Seeders\DatabaseSeeder as CoreSeeder;
use Swim\User\Database\Seeders\DatabaseSeeder as UserSeeder;
use Swim\Customer\Database\Seeders\DatabaseSeeder as CustomerSeeder;
use Swim\Inventory\Database\Seeders\DatabaseSeeder as InventorySeeder;
use Swim\CMS\Database\Seeders\DatabaseSeeder as CMSSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(InventorySeeder::class);
        $this->call(CoreSeeder::class);
        $this->call(AttributeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(CMSSeeder::class);
    }
}