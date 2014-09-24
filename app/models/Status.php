<?php

class Status extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = "cs_status";

	public $timestamps = false;
	
	public function message() {
		return $this->hasMany('message');
	}

	public static function getList() {
		$status = Status::all();
		$data = array();
		foreach ($status as $stt) {
			$data[$stt->id] = $stt->name;
		}
		return $data;
	}
}