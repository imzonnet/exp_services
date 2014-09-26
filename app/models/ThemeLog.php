<?php

class ThemeLog extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 't_theme_logs';
	
	public $timestamps = false;

	// Don't forget to fill this array
	protected $fillable = ['description', 'state', 'theme_id', 'changed_date'];
	
	/**
	* Relationship with table t_themes
	*/
	public function theme() {
		return $this->belongsTo('theme');
	}
}