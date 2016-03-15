<?php

use Illuminate\Database\Seeder;


class AdsTableSeeder extends Seeder
{
    public function run()
    {
    	for ($i=0;$i<=11;$i++) { 
	    	DB::table('ads')->insert([
			    [
			        'id' => $i,
			        'user_id' => '1',
			        'cat_id' => '1',
			        'subcat_id' => '1',
			        'title' => 'Lorem ipsum dolor',
			        'city' => 'seoul',
			        'description' => '"Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, "',
			        'file_srcs' => '[{"image":{"name":"fMFws_1458051477.jpeg"}}]',
			        'status' => 1
			    ]
			 ]);
    	}

    }
}
