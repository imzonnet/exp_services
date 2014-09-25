<?php

class Powerful extends \Eloquent {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 't_powerful';

	// Don't forget to fill this array
	protected $fillable = ['name', 'icon', 'description'];

	public $timestamps = false;

	/**
	* Relationship with table t_themes
	*/
	public function theme() {
		return $this->belongsTo('theme');
	}
}