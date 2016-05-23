<?php

use Illuminate\Database\Seeder;


class RelationshipsTableSeeder extends Seeder
{
    public function run()
    {
    	DB::table('relationships')->insert([
		    [
		        'id' => '1',
		        'user_one' => '2',
		        'user_two' => '1',
		        'action' => '1',
		        'status' => '1',
		    ]
		 ]);
    	DB::table('relationships')->insert([
		    [
		        'id' => '2',
		        'user_one' => '1',
		        'user_two' => '3',
		        'action' => '3',
		        'status' => '1',
		    ]
		 ]);
    }
}
