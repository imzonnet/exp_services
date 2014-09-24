<?php

class Budget extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = "cs_budgets";

	public $timestamps = false;

	public function item() {
		return $this->hasMany('item');
	}

	public static function getList() {
		$budgets = Budget::all();
		$data = array();
		foreach ($budgets as $budget) {
			$data[$budget->id] = $budget->price;
		}
		return $data;
	}
}