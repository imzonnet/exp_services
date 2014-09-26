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
	
	/**
	* Get list categories
	* @return array()
	*/
	public function scopeGetAll() {
		$data = array();
		$items = Category::all();
		foreach ($items as $item) {
			$data[$item->id] = $item->name;
		}
		return $data;
	}
}