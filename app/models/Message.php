<?php

class Message extends Eloquent {

	protected $table = "cs_messages";

	public $timestamps = false;

	protected $fillable = array('comments','attachment','item_id', 'user_id', 'status_id', 'submit_date');

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