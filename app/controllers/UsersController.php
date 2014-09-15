<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of users
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
				return Redirect::route('supporters.index');
			} else if( $user->inGroup(Sentry::findGroupByName('user')) ){
				return Redirect::route('users.index');
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
	/**
	 * Show the form for creating a new user
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users.create');
	}

	/**
	 * Store a newly created user in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), User::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		User::create($data);

		return Redirect::route('users.index');
	}

	/**
	 * Display the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::findOrFail($id);

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
		$user = User::find($id);

		return View::make('users.edit', compact('user'));
	}

	/**
	 * Update the specified user in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::findOrFail($id);

		$validator = Validator::make($data = Input::all(), User::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$user->update($data);

		return Redirect::route('users.index');
	}

	/**
	 * Remove the specified user from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		User::destroy($id);

		return Redirect::route('users.index');
	}
}
