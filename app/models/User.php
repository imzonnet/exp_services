<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Cartalyst\Sentry\Users\Eloquent\User {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	/**
	* Relationship with table cs_items
	*/
	public function item() {
		return $this->hasMany('Item');
	}

	/**
	* Relationship with table cs_messages
	*/
	public function message() {
		return $this->hasMany('Message');
	}

	/**
	* Relationship with table t_powerful
	*/
	public function order() {
		return $this->hasMany('Order');
	}
	/**
	* Generate random password
	* @return stirng
	*/
	public function scopeGeneratePassword() {
		return substr(md5(rand(1000, 99999)), 15, 10);
	}
}
