<?php

class Powerful extends \Eloquent {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 't_powerful';

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}