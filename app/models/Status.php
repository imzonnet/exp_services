<?php

class Status extends Eloquent {

	protected $table = "cs_status";

	public $timestamps = false;

	public function message() {
		return $this->hasMany('message');
	}

}