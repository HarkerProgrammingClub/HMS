<?php

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::connection('auth')->table('users')->delete();

		DB::connection('auth')->table('users')->insert(array(
			array(
				'username' => '25JohnD',
				'password' => Hash::make('Password'),
				'type' => 'student'
			),
			array(
				'username' => 'TeacherX',
				'password' => Hash::make('teacher!'),
				'type' => 'teacher'
			),
			array(
				'username' => 'aParent',
				'password' => Hash::make('pAsWoRd'),
				'type' => 'parent'
			),
			array(
				'username' => 'aParent2',
				'password' => Hash::make('pAsWoRd'),
				'type' => 'parent'
			),
			array(
				'username' => 'admin',
				'password' => Hash::make('wordPass'),
				'type' => 'admin'
			),
			array(
				'username' => 'SuperAdmin',
				'password' => Hash::make('anotherPassword'),
				'type' => 'superadmin'
			)
		));

		$otherTables = DB::connection('auth')
			->select("select TABLE_NAME from INFORMATION_SCHEMA.TABLES where TABLE_NAME != 'users' and TABLE_NAME != 'migrations' and TABLE_SCHEMA ='hms'");
		foreach($otherTables as $descriptor) {
			DB::connection('auth')->statement('drop table '.$descriptor->TABLE_NAME);
		}
		$users = DB::connection('auth')->table('users')
			->select('id', 'type')
			->get();
		$student = 0;
		foreach($users as $descriptor) {
			$tableName = 'user'.$descriptor->id;
			if($descriptor->type == 'student') $student = $descriptor->id;
			if($descriptor->type == 'student' || $descriptor->type == 'teacher') {
				Schema::connection('auth')->create($tableName, function($table) {
					$table->string('class');
					$table->tinyInteger('period');
				});
				DB::connection('auth')->table($tableName)->insert(array(
					array(
						'class' => 'Spanish 2M',
						'period' => 1
					)
				));
			} else if($descriptor->type == 'parent') {
				Schema::connection('auth')->create($tableName, function($table) {
					$table->integer('student');
				});
				DB::connection('auth')->table($tableName)->insert(array(
					array(
						'student' => $student
					)
				));
			}
		}
	}

}
