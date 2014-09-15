<?php

class SupportersController extends \BaseController {

	protected $users;

	public function __construct() {
		if(Sentry::check())
			$this->user = Sentry::getUser();
	}
	/**
	 * Display a listing of supporters
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return View::make('supporters.index');
	}

	/**
	* Send request
	*/
	public function getItems($id) {
		$item = Item::find($id);
		$status = Status::getList();
		return View::make('supporters.send', compact('item', 'status'));	
	}
	/**
	* Send request
	*/
	public function postItems($id) {
		//validate the input
		$rules = array(
			'comments' => 'required|min:10',
			'status_id' => 'required|numeric',
		);

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();	
		}
	    //insert request
	    $itemData = Input::except('_token');
	    $itemData['item_id'] = $id;
	    $itemData['user_id'] = $this->user->id;
	    $itemData['submit_date'] = new Datetime;
	    if(!is_null(Input::file('attachment'))) {
	    	$ext = array('application/pdf','application/msword','application/vnd.ms-excel','text/plain');
			if(in_array(Input::file('attachment')->getMimeType(), $ext)) {
				$fileName =  time().Input::file('attachment')->getClientOriginalName();
				$destinationPath = 'public/upload';
				Input::file('attachment')->move($destinationPath, $fileName);
				$attach_path = $destinationPath . '/' . $fileName;
			}
		}
		if(isset($attach_path)) {
			$itemData['attachment'] = $attach_path;
		}

		$item = Message::create($itemData);

		return Redirect::action('SupportersController@getIndex')->with('message', 'Your request had been submited!');
	}
	
}
