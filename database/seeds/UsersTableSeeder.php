<?php

use Illuminate\Database\Seeder;


class UsersTableSeeder extends Seeder
{
    public function run()
    {
    	DB::table('users')->insert([
		    [
		        'id' => '2',
		        'username' => 'pedram',
		        'email' => 'pedramkhoshnevis@gmail.com',
		        'roles' => '1',
		        'password' => bcrypt('110110')
		    ]
		 ]);
    }
}
