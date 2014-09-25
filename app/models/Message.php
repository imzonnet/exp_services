<?php

class Message extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = "cs_messages";

	public $timestamps = false;

	protected $fillable = array('comments','attachment','item_id', 'user_id', 'status_id', 'submit_date');

	/**
	* Relationship with table users
	*/
	public function user() {
		return $this->belongsTo('user');
	}
	
	/**
	* Relationship with table cs_items
	*/
	public function item() {
		return $this->belongsTo('item');
	}

	/**
	* Relationship with table cs_status
	*/
	public function status() {
		return $this->belongsTo('status');
	}
}