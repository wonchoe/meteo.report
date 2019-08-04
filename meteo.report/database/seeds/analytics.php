<?php

use Illuminate\Database\Seeder;

class analytics extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $faker = Faker::create();
    	foreach (range(1,10) as $index) {
	        DB::table('analytics')->insert([
	            'date' => date('Y-m-d', strtotime('-'.$index.' day', strtotime($date_raw))),
	            'response' => inttostr(randomrange(100,500)),
	            'area' => $Faker::city,
                    'updated_at' => date('Y-m-d', strtotime('-'.$index.' day', strtotime($date_raw))),
                    'created_at'  => date('Y-m-d', strtotime('-'.$index.' day', strtotime($date_raw)))
	        ]);
	}
    }
}
