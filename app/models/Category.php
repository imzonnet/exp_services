<?php

class Category extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 't_categories';
	
	public $timestamps = false;

	// Don't forget to fill this array
	protected $fillable = ['name', 'description'];

	/**
	* Relationship with table t_themes
	*/
	public function theme() {
		return $this->belongsTo('theme');
	}
}