<?php

class Item extends Eloquent {

	protected $table = "cs_items";

   	protected $fillable = array('id', 'title', 'requirement', 'link', 'info', 'budget_id', 'deliver_in', 'service_type_id', 'user_id', 'attachment' );

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