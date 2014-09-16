<?php

class UsersController extends \BaseController {

	protected $user;

	public function __construct() {
		$this->user = Sentry::getUser();
	}
	/**
	 * Display a index Member
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = Sentry::getUser();
		return View::make('users.index');
	}

	/**
	* Login
	*/
	public function login() {
		if( ! Sentry::check()) {
			return View::make('users.login');
		} else {
			return Redirect::route('home.index');
		}
	}
	/**
	* Process Login
	*/
	public function doLogin() {
		$rules = array(
			'email' => 'required|email',
			'password' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		//validate the input
		if($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		try {
			
			$data = array(
				'email' => Input::get('email'),
				'password' => Input::get('password'),
			);
			$user = Sentry::authenticate($data, false);
			//check group and redirect to group page
			if( $user->inGroup(Sentry::findGroupByName('supporter')) ) {
				return Redirect::action('SupportersController@getIndex');
			} else if( $user->inGroup(Sentry::findGroupByName('user')) ){
				return Redirect::action('UsersController@getIndex');
			}
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            return Redirect::route('users.login')->withInput(Input::except('password'))->withErrors("Login required");
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            return Redirect::route('users.login')->withInput(Input::except('password'))->withErrors("Password required");
        }
        catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
        {
            return Redirect::route('users.login')->withInput(Input::except('password'))->withErrors("Wrong Password");
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return Redirect::route('users.login')->withInput(Input::except('password'))->withErrors("Email not found");
        }
        catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
            return Redirect::route('users.login')->withInput(Input::except('password'))->withErrors("Not activated");
        }
	}
	/**
	* Sentry logout
	*
	*/
	public function logout() {
		Sentry::logout();
		return Redirect::route('home.index');
	}

	/*
	* Show profile users
	*/
	public function show($id) {
		if($this->user->id != $id) {
			return App::abort(404, 'Unauthorized action.');
		}
		$user = $this->user;
		return View::make('users.show', compact('user'));
	}
	/**
	 * Show the form for editing the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if($this->user->id != $id) {
			return App::abort(404, 'Unauthorized action.');
		}
		$user = User::find($id);

		return View::make('users.edit', compact('user'));
	}

	/**
	 * Update the specified home in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if($this->user->id != $id) {
			return App::abort(404, 'Unauthorized action.');
		}
		$user = User::findOrFail($id);
		$rules = array(
			'first_name' => 'required',
			'last_name' => 'required',
			'phone' => 'numeric'
		);

		$validator = Validator::make($data = Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		if( !is_null(Input::file('avatar')) ) {
	    	$ext = array('image/png', 'image/jpeg');
			if(in_array(Input::file('avatar')->getMimeType(), $ext)) {
				$fileName =  time().Input::file('avatar')->getClientOriginalName();
				$destinationPath = 'public/upload/profile';
				Input::file('avatar')->move($destinationPath, $fileName);
				$avatar_path = $destinationPath . '/' . $fileName;
			}
		}
		if(isset($avatar_path)) {
			$data['avatar'] = $avatar_path;
		}
		
		$user->update($data);

		return Redirect::route('users.show',$user->id)->with('message','Your profile had updated!');
	}


}