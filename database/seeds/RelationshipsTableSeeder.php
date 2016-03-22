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
    }
}
