<?php

class Message extends Eloquent {

	protected $table = "cs_message";

	public $timestamps = false;

	public function user() {
		return $this->belongsTo('user');
	}
	
	public function item() {
		return $this->belongsTo('item');
	}

	public function status() {
		return $this->belongsTo('status');
	}
}