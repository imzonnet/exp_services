<?php

class Item extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = "cs_items";

   	protected $fillable = array('id', 'title', 'requirement', 'link', 'info', 'budget_id', 'deliver_in', 'service_type_id', 'user_id', 'attachment' );

	/**
	* Relationship with table cs_messages
	*/
	public function message() {
		return $this->hasMany('message')->orderBy('id','desc');
	}

	/**
	* Relationship with table users
	*/
	public function user() {
		return $this->belongsTo('user');
	}

	/**
	* Relationship with table cs_service_types
	*/
	public function service() {
		return $this->belongsTo('service');
	}

	/**
	* Relationship with table cs_budgets
	*/
	public function budget() {
		return $this->belongsTo('budget');
	}
}