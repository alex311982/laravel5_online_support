<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

	public function run()
	{
        DB::table('users')->truncate();

		\App\User::create([
			'name' => 'Admin User',
			'username' => 'admin_user',
			'email' => 'admin@admin.com',
			'password' => bcrypt('admin'),
			'confirmed' => 1,
            'admin' => 1,
            'country_id' => rand(1, 3),
			'confirmation_code' => md5(microtime() . env('APP_KEY')),
		]);

		\App\User::create([
			'name' => 'Test User',
			'username' => 'test_user',
			'email' => 'user@user.com',
			'password' => bcrypt('user'),
			'confirmed' => 1,
            'country_id' => rand(1, 3),
			'confirmation_code' => md5(microtime() . env('APP_KEY')),
		]);

        \App\User::create([
                'name' => 'Test User 2',
                'username' => 'test_user_2',
                'email' => 'user2@user.com',
                'password' => bcrypt('user'),
                'confirmed' => 1,
                'country_id' => rand(1, 3),
                'confirmation_code' => md5(microtime() . env('APP_KEY')),
            ]);


    }

}
