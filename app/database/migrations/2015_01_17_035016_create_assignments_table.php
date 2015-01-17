<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentsTable extends Migration {

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
		$otherTables = DB::connection('assignments')
			->select("select TABLE_NAME from INFORMATION_SCHEMA.TABLES where TABLE_NAME != 'migrations' and TABLE_SCHEMA ='hmsassignments'");
		$categories = array();
		$assignments = array();
		$dones = array();
		foreach($otherTables as $descriptor) {
			$name = $descriptor->TABLE_NAME;
			if(starts_with($name, "categories")) $categories[] = $name;
			else if(starts_with($name, "assignments")) $assignments[] = $name;
			else if(starts_with($name, "done")) $dones[] = $name;
		}
		foreach(array_merge($dones, $assignments, $categories) as $name) {
			Schema::connection('assignments')->drop($name);
		}
	}

}
