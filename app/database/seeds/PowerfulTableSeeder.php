<?php

class PowerfulTableSeeder extends Seeder {

	public function run()
	{
		DB::table('t_powerful')->delete();
		$data = array('HTML 5', 'CSS3', 'Custom Typography', 'Responsive Design', 'Custom Fonts');
		$desc = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s";
		foreach($data as $item) {
			Powerful::create([
				'name' => $item,
				'icon' => 'public/images/icon.png',
				'description' => $desc
			]);
		}
	}

}