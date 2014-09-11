<?php

class Service extends Eloquent {

	protected $table = "cs_service_types";

	public $timestamps = false;

	public function item() {
		return $this->hasMany('item');
	}
}