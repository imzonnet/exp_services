<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('SentrySeeder');
		$this->call('BudgetSeeder');
		$this->call('ServiceTypeSeeder');
		$this->call('StatusSeeder');
		$this->call('PowerfulTableSeeder');
		$this->call('CategoriesTableSeeder');
	}

}