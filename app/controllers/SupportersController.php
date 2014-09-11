<?php

class SupportersController extends \BaseController {

	/**
	 * Display a listing of supporters
	 *
	 * @return Response
	 */
	public function index()
	{
		$supporters = Supporter::all();

		return View::make('supporters.index', compact('supporters'));
	}

	/**
	 * Show the form for creating a new supporter
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('supporters.create');
	}

	/**
	 * Store a newly created supporter in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Supporter::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Supporter::create($data);

		return Redirect::route('supporters.index');
	}

	/**
	 * Display the specified supporter.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$supporter = Supporter::findOrFail($id);

		return View::make('supporters.show', compact('supporter'));
	}

	/**
	 * Show the form for editing the specified supporter.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$supporter = Supporter::find($id);

		return View::make('supporters.edit', compact('supporter'));
	}

	/**
	 * Update the specified supporter in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$supporter = Supporter::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Supporter::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$supporter->update($data);

		return Redirect::route('supporters.index');
	}

	/**
	 * Remove the specified supporter from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Supporter::destroy($id);

		return Redirect::route('supporters.index');
	}

}
