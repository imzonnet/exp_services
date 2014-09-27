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
		return $this->belongsTo('Theme');
	}

	/**
	* Get all powerful
	* @return array()
	*/
	public function scopeGetAll() {
		$data = array();
		$items = Powerful::all();
		foreach ($items as $item) {
			$data[$item->id] = $item->name;
		}
		return $data;
	}
	/**
	* Get list powerful from a id
	* @var array()
	* @return array()
	*/
	public static function getList($arg) {
		$id = json_decode($arg);
		$data = Powerful::whereIn('id', $id)->get();
		return $data;
	}
}