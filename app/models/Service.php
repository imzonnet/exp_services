<?php

class Service extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = "cs_service_types";

	public $timestamps = false;

	/**
	* Relationship with table cs_items
	*/
	public function item() {
		return $this->hasMany('Item');
	}

	public function scopeGetList() {
		$services = Service::all();
		$data = array();
		foreach ($services as $service) {
			$data[$service->id] = $service->name;
		}
		return $data;
	}
}