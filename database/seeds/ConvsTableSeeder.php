<?php

use Illuminate\Database\Seeder;


class ConvsTableSeeder extends Seeder
{
    public function run()
    {
    	DB::table('convs')->insert([
		    [
		        'id' => '1',
		        'user_one' => '1',
		        'user_two' => '2',
		        'status' => '1',
		    ]
		 ]);
    	DB::table('convs')->insert([
		    [
		        'id' => '2',
		        'user_one' => '1',
		        'user_two' => '3',
		        'status' => '1',
		    ]
		 ]);
    }
}
