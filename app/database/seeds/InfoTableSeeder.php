<?php

class InfoTableSeeder extends Seeder {

	public function run()
	{
		DB::connection('info')->table('students')->delete();
		DB::connection('info')->table('parents')->delete();
		DB::connection('info')->table('teachers')->delete();

		DB::connection('info')->table('students')->insert(array(
			array(
				'id' => DB::connection('auth')->table('users')->where('username', '25JohnD')->first()->id,
				'firstname' => 'John',
				'lastname' => 'Davis',
				'email' => '25John-doesntexistD@students.harker.org',
				'phone' => '555-617-9225',
				'zipcode' => 94087,
				'city' => 'Los Altos',
				'state' => 'California',
				'grade' => 2,
				'Advisor' => DB::connection('auth')->table('users')->where('type', 'teacher')->first()->id
			)
		));
		DB::connection('info')->table('parents')->insert(array(
			array(
				'id' => DB::connection('auth')->table('users')->where('username', 'aParent')->first()->id,
				'firstname' => 'Mom',
				'lastname' => 'Davis',
				'email' => 'theDavisMom@gmail.com',
				'phone' => '555-516-5745',
				'zipcode' => 94087,
				'city' => 'Los Altos',
				'state' => 'California',
			),
			array(
				'id' => DB::connection('auth')->table('users')->where('username', 'aParent2')->first()->id,
				'firstname' => 'Dad',
				'lastname' => 'Davis',
				'email' => 'ddad@gmail.com',
				'phone' => '555-516-5745',
				'zipcode' => 94087,
				'city' => 'Los Altos',
				'state' => 'California',
			)
		));
		DB::connection('info')->table('teachers')->insert(array(
			array(
				'id' => DB::connection('auth')->table('users')->where('username', 'teacherX')->first()->id,
				'firstname' => 'Teacher',
				'lastname' => 'Rehcaet',
				'email' => 'nosuchteacher@harker.org',
				'phone' => '555-516-5745',
				'zipcode' => 94087,
				'city' => 'Los Altos',
				'state' => 'California',
			)
		));
	}

}
