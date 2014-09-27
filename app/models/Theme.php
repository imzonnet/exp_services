<?php

class Theme extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 't_themes';

	// Don't forget to fill this array
	protected $fillable = ['name', 'description', 'thumbnail', 'features', 'powerful_id', 'version', 'price', 'category_id'];

	/**
	* Relationship with table t_theme_images
	*/
	public function themeImage() {
		return $this->hasMany('ThemeImage');
	}
	/**
	* Relationship with table t_theme_logs
	*/
	public function themeLog() {
		return $this->hasMany('ThemeLog')->orderBy('id','desc');
	}
	/**
	* Relationship with table t_powerful
	*/
	public function powerful() {
		return $this->belongsTo('Powerful');
	}
	/**
	* Relationship with table t_categories
	*/
	public function category() {
		return $this->belongsTo('Category');
	}
}