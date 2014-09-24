<?php

class PowerfulController extends \BaseController {

	/**
	 * Display a listing of powerful
	 *
	 * @return Response
	 */
	public function index()
	{
		$powerful = Powerful::all();

		return View::make('powerful.index', compact('powerful'));
	}

	/**
	 * Show the form for creating a new powerful
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('powerful.create');
	}

	/**
	 * Store a newly created powerful in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Powerful::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Powerful::create($data);

		return Redirect::route('powerful.index');
	}

	/**
	 * Display the specified powerful.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$powerful = Powerful::findOrFail($id);

		return View::make('powerful.show', compact('powerful'));
	}

	/**
	 * Show the form for editing the specified powerful.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$powerful = Powerful::find($id);

		return View::make('powerful.edit', compact('powerful'));
	}

	/**
	 * Update the specified powerful in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$powerful = Powerful::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Powerful::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$powerful->update($data);

		return Redirect::route('powerful.index');
	}

	/**
	 * Remove the specified powerful from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Powerful::destroy($id);

		return Redirect::route('powerful.index');
	}

}
