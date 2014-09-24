<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
	/**
	* Protected csrf
	*
	*/
	public function __construct()
	{
	    $this->beforeFilter('csrf', array('on' => array('post', 'delete', 'put')));
	    $this->beforeFilter('ajax', array('on' => array('delete', 'put')));
	}

}
