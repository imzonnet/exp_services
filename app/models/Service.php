<?php

class Service extends Eloquent {

	protected $table = "cs_service_types";

	public $timestamps = false;

	public function item() {
		return $this->hasMany('item');
	}

	public static function getList() {
		$services = Service::all();
		$data = array();
		foreach ($services as $service) {
			$data[$service->id] = $service->name;
		}
		return $data;
	}
}