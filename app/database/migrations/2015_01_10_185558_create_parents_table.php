<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('info')->create('parents', function($table) {
			$table->increments('id');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('email');
			$table->char('phone', 12);
			$table->mediumInteger('zipcode');
			$table->string('city');
			$table->string('state');
			$table->char('stateabbr', 2);
		});
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down()
	{
		Schema::connection('info')->drop('parents');
	}

}
