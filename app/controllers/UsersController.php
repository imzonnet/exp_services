<?php

class UsersController extends \BaseController {

	protected $user;

	public function __construct() {
		$this->user = Sentry::getUser();
	}
	/**
	 * Display a listing of users
	 *
	 * @return Response
	 */
	public function getIndex()
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
	* View list items
	*/
	public function getItems() {
		$items = Item::where('user_id','=',$this->user->id)->orderBy('id', 'desc')->get();
		return View::make('items.index', compact('items'));
	}
	
	/**
	* Show item detail
	*/
	public function getItemsShow($id) {
		$item = Item::find($id);
		if($this->user->id != $item->user_id) {
			return Redirect::route('users.index');
		}
		$messages = $item->message;
		return View::make('items.show', compact('item','messages'));
	}

}
