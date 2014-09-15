<?php

class ItemsController extends \BaseController {

	protected $user;
	/**
	* Get info current user
	*
	*/
	public function __construct() {
		if(Sentry::check()) {
			$this->user = Sentry::getUser();
		}
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if($this->user->inGroup(Sentry::findGroupByName('supporter'))) {
			$items = Item::orderBy('id', 'desc')->get();
		} else {
			$items = Item::where('user_id','=',$this->user->id)->orderBy('id', 'desc')->get();
		}
		return View::make('items.index', compact('items'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data = array();
		$data['budgets'] = Budget::getList();
		$data['services'] = Service::getList();
		return View::make('items.create', $data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//guest send request
		if(! Sentry::check() ) {
			$rules = array(
				'title' => 'required',
				'first_name' => 'required|min:3',
				'last_name' => 'required',
			  	'email' => 'required|email',
				'service_type_id' =>  'required|numeric',
				'requirement' => 'required',
				'link' => 'required|link',
				'info' => 'required',
				'budget_id' =>  'required',
				'deliver_in' => 'required|numeric',
			);
			$validator = Validator::make(Input::all(), $rules);
			//validate the input
			if($validator->fails()) {
				return Redirect::route('items.create')->withErrors($validator)->withInput();	
			}

			/**
			* Create account login for guest from email
			*/
			try
			{
			    // Create the user
			    $password = User::generatePassword();

			    $userData = array(
			        'email'     => Input::get('email'),
			        'password'  => $password,
			        'activated' => 1,
			        'first_name' => Input::get('first_name'),
			        'last_name' => Input::get('last_name'),
			    );
			    $user = Sentry::createUser($userData);
			    // Find the group using the group id
			    $userGroup = Sentry::findGroupByName('user');
			    // Assign the group to the user
			    $user->addGroup($userGroup);

			    //insert request
			    $itemData = Input::except('_token', 'first_name', 'last_name', 'email');
			    $itemData['user_id'] = $user->id;
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

				$item = Item::create($itemData);

				return Redirect::route('home.index')->with('message', 'Your request had been submited! Our has create your account. Please check your email and login with username, password for check your request.' . 'Email:'. $user->email . '/'.$password);
			    /**send mail **/
			    /*
    			Mail::send('emails.welcome', array('key' => 'value'), function($message)
				{
				    $message->to('vnzacky39@gmail.com', 'John Smith')->subject('Welcome!');
				});
				*/
			}
			catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
			{
			    return Redirect::route('items.create')->withErrors('Login field is required.')->withInput();
			}
			catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
			{
			    return Redirect::route('items.create')->withErrors('Password field is required.')->withInput();
			}
			catch (Cartalyst\Sentry\Users\UserExistsException $e)
			{
			    return Redirect::route('items.create')->withErrors('Email with this login already exists.')->withInput();
			}
			catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
			{
			    return Redirect::route('items.create')->withErrors('Group was not found.')->withInput();
			}

		} else { //member has login
			//current user
			$user = Sentry::getUser();
			//validate the input
			$rules = array(
				'title' => 'required',
				'service_type_id' =>  'required|numeric',
				'requirement' => 'required',
				'link' => 'required',
				'info' => 'required',
				'budget_id' =>  'required',
				'deliver_in' => 'required|numeric',
			);

			$validator = Validator::make(Input::all(), $rules);

			if($validator->fails()) {
				return Redirect::route('items.create')->withErrors($validator)->withInput();	
			}
		    //insert request
		    $itemData = Input::except('_token');
		    $itemData['user_id'] = $user->id;

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

			$item = Item::create($itemData);

			return Redirect::route('home.index')->with('message', 'Your request had been submited!');

		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$item = Item::find($id);
		if($this->user->id != $item->user_id) {
			return Redirect::route('items.index');
		}
		$messages = $item->message;
		return View::make('items.show', compact('item','messages'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
