<?php

class StatusSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('cs_status')->delete();

		$status = array("Waiting", "Pending", "Solved");
		foreach($status as $stt) {
			$status = new Status();
			$status->name = $stt;
			$status->description = "Lorem Ipsum has been the dummy text ever since the 1500s";
			$status->save();
		}
	}

}
