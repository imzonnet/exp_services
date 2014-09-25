<?php

class Status extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = "cs_status";

	public $timestamps = false;
	
	/**
	* Relationship with table cs_messages
	*/
	public function message() {
		return $this->hasMany('message');
	}

	/**
	* Get list status
	* @return array
	*/
	public function scopeGetList() {
		$status = Status::all();
		$data = array();
		foreach ($status as $stt) {
			$data[$stt->id] = $stt->name;
		}
		return $data;
	}
	/**
	* Get classes of a status
	* @var string
	* @return string
	*/
	public function scopeGetClass($status) {
		$class = "info";
		switch (strtolower($status)) {
			case 'waiting':
				$class = "info";
				break;
			case 'pending':
				$class = "waring";
				break;
			case 'solved':
				$class = "success";
				break;
			
			default:
				$class = "info";
				break;
		}
	}
}