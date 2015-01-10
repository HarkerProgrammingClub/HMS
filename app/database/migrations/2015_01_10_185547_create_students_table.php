<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('info')->create('students', function($table) {
			$table->increments('id');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('email');
			$table->char('phone', 12);
			$table->mediumInteger('zipcode');
			$table->string('city');
			$table->string('state');
			$table->char('stateabbr', 2);
			$table->string('parents'); //comma-separated
			$table->tinyInteger('grade');
			$table->integer('advisor'); //refers to advisor id in teachers table
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('info')->drop('students');
	}

}
