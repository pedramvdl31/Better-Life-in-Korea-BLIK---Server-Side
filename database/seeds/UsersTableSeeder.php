<?php

use Illuminate\Database\Seeder;


class UsersTableSeeder extends Seeder
{
    public function run()
    {
    	DB::table('users')->insert([
		    [
		        'id' => '1',
		        'username' => 'pedram',
		        'email' => 'pedramkhoshnevis@gmail.com',
		        'roles' => '1',
		        'password' => bcrypt('110110')
		    ]
		 ]);
    	DB::table('users')->insert([
		    [
		        'id' => '2',
		        'username' => 'example',
		        'email' => 'example@example.com',
		        'roles' => '5',
		        'password' => bcrypt('110110')
		    ]
		 ]);
    	DB::table('users')->insert([
		    [
		        'id' => '3',
		        'username' => 'example2',
		        'email' => 'example2@example.com',
		        'roles' => '5',
		        'password' => bcrypt('110110')
		    ]
		 ]);
    }
}
