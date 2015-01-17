<?php

use Illuminate\Database\Query\Expression;

class GradesSeeder extends Seeder {

	public function run()
	{
		$id = DB::connection('auth')->table('classes')->where('class', 'Spanish 2M')->pluck('id');
		Schema::connection('grades')->create("categories$id", function($table) {
			$table->increments('id');
			$table->string('name');
			$table->tinyInteger('weight');
		});
		Schema::connection('grades')->create("assignments$id", function($table) use($id) {
			$table->increments('id');
			$table->smallInteger('out')->unsigned();
			$table->string('name');
			$table->integer('category')->unsigned();
			$table->foreign('category')
				->references('id')
				->on("categories$id");
		});
		Schema::connection('grades')->create("grades$id", function($table) use($id) {
			$table->integer('studentId')->unsigned();
			$table->foreign('studentId')
				->references('id')
				->on(new Expression('hms.users'));
			$table->integer('assignment')->unsigned();
			$table->foreign('assignment')
				->references('id')
				->on("assignments$id");
			$table->smallInteger('grade')->unsigned();
		});

		DB::connection('grades')->table("categories$id")->insert(array(
			array(
				'name' => 'Tests',
				'weight' => 50
			),
			array(
				'name' => 'Quizzes',
				'weight' => 25
			),
			array(
				'name' => 'Homework',
				'weight' => 15
			),
			array(
				'name' => 'Classwork & Participation',
				'weight' => 10
			)
		));
		DB::connection('grades')->table("assignments$id")->insert(array(
			array(
				'out' => 100,
				'name' => 'Unidad 5 Etapa 3 Examen',
				'category' => DB::connection('grades')->table("categories$id")->where('name', 'Tests')->pluck('id')
			),
			array(
				'out' => 10,
				'name' => 'Imperativos',
				'category' => DB::connection('grades')->table("categories$id")->where('name', 'Homework')->pluck('id')
			)
		));
		DB::connection('grades')->table("grades$id")->insert(array(
			array(
				'studentId' => DB::connection('auth')->table('users')->where('username', '25JohnD')->pluck('id'),
				'assignment' => DB::connection('grades')->table("assignments$id")->where('name', 'Unidad 5 Etapa 3 Examen')->pluck('id'),
				'grade' => 91
			),
			array(
				'studentId' => DB::connection('auth')->table('users')->where('username', '25JohnD')->pluck('id'),
				'assignment' => DB::connection('grades')->table("assignments$id")->where('name', 'Imperativos')->pluck('id'),
				'grade' => 10
			)
		));
	}

}
