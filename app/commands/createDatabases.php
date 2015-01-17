<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class createDatabases extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'db:create';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Creates all of the databases you will need';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		forEach(Config::get('database.connections') as $c) {
			if(starts_with($c['database'], "hms")) {
				$this->info('creating database "'.$c['database'].'"');
				DB::statement('create SCHEMA IF NOT EXISTS '.$c['database']);
			}
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
		);
	}

}
