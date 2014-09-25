<?php

class Order extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 't_orders';

	public $timestamps = false;
	
	// Don't forget to fill this array
	protected $fillable = [];

}