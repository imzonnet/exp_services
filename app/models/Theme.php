<?php

class Theme extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 't_themes';

	// Don't forget to fill this array
	protected $fillable = [];

	/**
	* Relationship with table t_theme_images
	*/
	public function themeImage() {
		return $this->hasMany('themeImage');
	}
	/**
	* Relationship with table t_theme_logs
	*/
	public function themeLog() {
		return $this->hasMany('themeLog');
	}
	/**
	* Relationship with table t_powerful
	*/
	public function powerful() {
		return $this->belongsTo('powerful');
	}
	/**
	* Relationship with table t_categories
	*/
	public function category() {
		return $this->belongsTo('category');
	}
}