<?php

use Illuminate\Database\Seeder;


class ConvMsgsTableSeeder extends Seeder
{
    public function run()
    {
    	DB::table('conv_msgs')->insert([
		    [
		        'id' => '1',
		        'user_id' => '1',
		        'conv_id' => '1',
		        'message' => 'hello example',
		        'status' => '1',
		    ]
		 ]);
    	DB::table('conv_msgs')->insert([
		    [
		        'id' => '2',
		        'user_id' => '2',
		        'conv_id' => '1',
		        'message' => 'hi coop',
		        'status' => '1',
		    ]
		 ]);
    	DB::table('conv_msgs')->insert([
		    [
		        'id' => '3',
		        'user_id' => '1',
		        'conv_id' => '1',
		        'message' => 'how are you example?',
		        'status' => '1',
		    ]
		 ]);
    	DB::table('conv_msgs')->insert([
		    [
		        'id' => '4',
		        'user_id' => '1',
		        'conv_id' => '1',
		        'message' => 'and hows life example?',
		        'status' => '1',
		    ]
		 ]);
    	DB::table('conv_msgs')->insert([
		    [
		        'id' => '5',
		        'user_id' => '2',
		        'conv_id' => '1',
		        'message' => 'good coop',
		        'status' => '1',
		    ]
		 ]);
    	DB::table('conv_msgs')->insert([
		    [
		        'id' => '6',
		        'user_id' => '2',
		        'conv_id' => '1',
		        'message' => 'how about you coop?',
		        'status' => '1',
		    ]
		 ]);
    	DB::table('conv_msgs')->insert([
		    [
		        'id' => '7',
		        'user_id' => '1',
		        'conv_id' => '1',
		        'message' => 'what???LOL ',
		        'status' => '1',
		    ]
		 ]);
    	DB::table('conv_msgs')->insert([
		    [
		        'id' => '8',
		        'user_id' => '1',
		        'conv_id' => '2',
		        'message' => 'Hello Example 2...',
		        'status' => '1',
		    ]
		 ]);
    	DB::table('conv_msgs')->insert([
		    [
		        'id' => '9',
		        'user_id' => '3',
		        'conv_id' => '2',
		        'message' => 'Hello Pedram',
		        'status' => '1',
		    ]
		 ]);
    }
}
