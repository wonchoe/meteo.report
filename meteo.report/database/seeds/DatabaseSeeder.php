<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
    	foreach (range(1,50) as $index) {
	        DB::table('analytics')->insert([
	            'date' => date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")-$index, date("Y"))),
	            'response' => mt_rand(100,500),
	            'area' => $faker->city,
                    'updated_at' => date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")-$index, date("Y"))),
                    'created_at'  => date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")-$index, date("Y")))
	        ]);
        }
    }
}
