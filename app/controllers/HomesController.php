<?php

class HomesController extends \BaseController {

	/**
	 * Display a listing of homes
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('homes.index');
	}

	/**
	 * Show the form for creating a new home
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('homes.create');
	}

	/**
	 * Store a newly created home in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Home::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Home::create($data);

		return Redirect::route('homes.index');
	}

	/**
	 * Display the specified home.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$home = Home::findOrFail($id);

		return View::make('homes.show', compact('home'));
	}

	/**
	 * Show the form for editing the specified home.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$home = Home::find($id);

		return View::make('homes.edit', compact('home'));
	}

	/**
	 * Update the specified home in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$home = Home::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Home::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$home->update($data);

		return Redirect::route('homes.index');
	}

	/**
	 * Remove the specified home from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Home::destroy($id);

		return Redirect::route('homes.index');
	}

}
