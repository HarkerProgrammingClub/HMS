<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Nothing
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$otherTables = DB::connection('grades')
			->select("select TABLE_NAME from INFORMATION_SCHEMA.TABLES where TABLE_NAME != 'migrations' and TABLE_SCHEMA ='hmsgrades'");
		$categories = array();
		$assignments = array();
		$grades = array();
		foreach($otherTables as $descriptor) {
			$name = $descriptor->TABLE_NAME;
			if(starts_with($name, "categories")) $categories[] = $name;
			else if(starts_with($name, "assignments")) $assignments[] = $name;
			else if(starts_with($name, "grades")) $grades[] = $name;
		}
		foreach(array_merge($grades, $assignments, $categories) as $name) {
			Schema::connection('grades')->drop($name);
		}
	}

}
