<?php

class Item extends Eloquent {

	protected $table = "cs_items";

	public function message() {
		return $this->hasMany('message');
	}

	public function user() {
		return $this->belongsTo('user');
	}

	public function service() {
		return $this->belongsTo('service');
	}

	public function budget() {
		return $this->belongsTo('budget');
	}
}