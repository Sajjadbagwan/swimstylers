<?php

namespace Swim\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Swim\User\Models\Role;
use DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->delete();

        DB::table('roles')->delete();

        DB::table('roles')->insert([
                'id' => 1,
                'name' => 'Administrator',
                'description' => 'Administrator rolem',
                'permission_type' => 'all'
            ]);
    }
}