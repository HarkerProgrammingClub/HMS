<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;

class CreateParentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('info')->create('parents', function($table) {
			$table->integer('id')->unsigned();
			$table->foreign('id')
				->references('id')
				->on(new Expression('hms.users'));
			$table->string('firstname');
			$table->string('lastname');
			$table->string('email');
			$table->char('phone', 12);
			$table->mediumInteger('zipcode');
			$table->string('city');
			$table->string('state');
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
