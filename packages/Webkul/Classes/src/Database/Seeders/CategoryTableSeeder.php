<?php

namespace Swim\Classes\Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class ClassesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('classes')->delete();

        $now = Carbon::now();

        DB::table('classes')->insert([
            ['id' => '1','class_name' => 'swimming pool 1','start_date' => NULL,'number_of_weeks' => '5','number_of_weeks_notrun' => '1','start_time' => '14','instructor_id' => '1','price'=>'3.99','class_level'=> '1', 'created_at' => $now, 'updated_at' => $now]
        ]);

        DB::table('classes_translations')->insert([
            ['id' => '1','class_name' => 'Root','start_date' => 'root','number_of_weeks' => '','meta_title' => '','meta_description' => '','meta_keywords' => '','instructor_id' => '1','locale' => 'en']
        ]);
    }
}