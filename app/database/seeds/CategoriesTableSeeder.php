<?php

class CategoriesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('t_categories')->delete();
		$data = array('Drupal', 'Joomla', 'Wordpress');
		$desc = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s";
		foreach($data as $item) {
			Category::create([
				'name' => $item,
				'description' => $desc
			]);
		}
	}

}