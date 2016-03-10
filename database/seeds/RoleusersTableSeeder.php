<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class RoleusersTableSeeder extends Seeder
{
    public function run()
    {
		DB::table('role_user')->insert([
		    [
		        'id' => '1',
		        'role_id' => '1',
		        'user_id' => '1'
		    ]
		]);
    }
}
