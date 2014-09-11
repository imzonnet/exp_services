<?php

class ServiceTypeSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('cs_service_types')->delete();
		
		$services = array("Theme", "Project", "Fix Bug");
		foreach($services as $service) {
			$sv = new Service();
			$sv->name = $service;
			$sv->description = "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s";
			$sv->save();
		}
	}

}
