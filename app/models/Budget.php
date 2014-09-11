<?php

class Budget extends Eloquent {

	protected $table = "cs_budgets";

	public $timestamps = false;

	public function item() {
		return $this->hasMany('item');
	}
}