<?php

use Illuminate\Database\Query\Expression;

class AssignmentsSeeder extends Seeder {

	public function run()
	{
		$id = DB::connection('auth')->table('classes')->where('class', 'Spanish 2M')->pluck('id');
		Schema::connection('assignments')->create("categories$id", function($table) {
			$table->increments('id');
			$table->string('name');
			$table->enum('base', array('homework', 'classwork', 'assessments', 'projects'));
		});
		Schema::connection('assignments')->create("assignments$id", function($table) use($id) {
			$table->increments('id');
			$table->string('name');
			$table->date('start');
			$table->date('end');
			$table->string('body');
			$table->string('attachments'); //comma-separated
			$table->integer('category')->unsigned();
			$table->foreign('category')
				->references('id')
				->on("categories$id");
		});
		Schema::connection('assignments')->create("done$id", function($table) use($id) {
			$table->integer('studentId')->unsigned();
			$table->foreign('studentId')
				->references('id')
				->on(new Expression('hms.users'));
			$table->integer('assignment')->unsigned();
			$table->foreign('assignment')
				->references('id')
				->on("assignments$id");
		});

		DB::connection('assignments')->table("categories$id")->insert(array(
			array(
				'name' => 'Exámenes',
				'base'=> 'assessments'
			),
			array(
				'name' => 'Trabajo en clase',
				'base' => 'classwork'
			),
			array(
				'name' => 'Tarea',
				'base' => 'homework'
			),
			array(
				'name' => 'Proyectos',
				'base' => 'projects'
			)
		));
		DB::connection('assignments')->table("assignments$id")->insert(array(
			array(
				'name' => 'Revisar los imperativos',
				'start' => date('Y-m-d H:i:s', time()),
				'end' => date('Y-m-d H:i:s', time()+60*60*24),
				'body' => 'Vamos a practicar los imperativos.',
				'attachments' => '',
				'category' => DB::connection('assignments')->table("categories$id")->where('name', 'Trabajo en clase')->pluck('id')
			),
			array(
				'name' => 'Hoja de imperativos',
				'start' => date('Y-m-d H:i:s', time()+60*60*24),
				'end' => date('Y-m-d H:i:s', time()+2*60*60*24),
				'body' => 'Haga las páginas dos y tres de la hoja.',
				'attachments' => 'imperativos.doc',
				'category' => DB::connection('assignments')->table("categories$id")->where('name', 'Tarea')->pluck('id')
			)
		));
	}

}
