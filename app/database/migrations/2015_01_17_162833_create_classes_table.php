<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('auth')->create('classes', function($table) {
			$table->increments('id');
			$table->string('class');
			$table->tinyInteger('period')->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// delete all user tables first since they reference ids in the classes table
		$ignoreTables = array('users', 'migrations', 'classes');
		$toIgnore = "";
		forEach($ignoreTables as $table) {
			$toIgnore .= "TABLE_NAME != '$table' and ";
		}
		$otherTables = DB::connection('auth')
			->select("select TABLE_NAME from INFORMATION_SCHEMA.TABLES where ".$toIgnore."TABLE_SCHEMA ='hms'");
		foreach($otherTables as $descriptor) {
			Schema::connection('auth')->drop($descriptor->TABLE_NAME);
		}

		Schema::connection('auth')->drop('classes');
	}

}
