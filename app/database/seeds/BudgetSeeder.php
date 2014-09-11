<?php

class BudgetSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('cs_budgets')->delete();
		
		$amount = array("10-100", "100-200", "200-500", "500-1000", "1000-2000", "> 2000");
		foreach($amount as $price) {
			$bg = new Budget();
			$bg->price = $price;
			$bg->save();
		}
	}

}
