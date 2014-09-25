<?php

class ThemesController extends \BaseController {

	/**
	* path folder upload file
	*/
	private $path = "public/uploads/themes";

	/**
	 * Display a listing of themes
	 *
	 * @return Response
	 */
	public function index()
	{
		$themes = Theme::orderBy('id', 'desc')->paginate(10);

		return View::make('themes.index', compact('themes'));
	}

	/**
	 * Show the form for creating a new theme
	 *
	 * @return Response
	 */
	public function create()
	{
		$data['category'] = Category::getList();
		$data['powerful'] = Powerful::getList();

		return View::make('themes.create', $data);
	}

	/**
	 * Store a newly created theme in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'name' => 'required',
			'description' => 'required',
			'thumbnail' => 'required|image',
			'powerful_id' => 'required',
			'category_id' => 'required',
		);
		$validator = Validator::make($data = Input::except('images'), $rules);
		
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		/**
		* Convert list id powerful to json
		*/
		$data['powerful_id'] = json_encode($data['powerful_id']);

		/**
		* Upload theme thunbnail
		*/
		$tb_name = md5(time() . Input::file('thumbnail')->getClientOriginalName()) . '.' . Input::file('thumbnail')->getClientOriginalExtension();
		Input::file('thumbnail')->move($this->path, $tb_name);
		$tb_path = $this->path . '/' . $tb_name;
		$data['thumbnail'] = $tb_path;

		//create new theme
		$theme = Theme::create($data);
		//create theme images
		if( Input::has('theme_images') ) {
			$theme_images = Input::get('theme_images');
			foreach($theme_images as $image) {
				$idata = array(
					'image' => $image,
					'theme_id' => $theme->id
				);
				ThemeImage::create($idata);
			}
		}
		return Redirect::route('admin.themes.index')->with('message', 'Item had created!');
	}

	/**
	 * Display the specified theme.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$theme = Theme::findOrFail($id);

		return View::make('themes.show', compact('theme'));
	}

	/**
	 * Show the form for editing the specified theme.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$theme = Theme::find($id);

		return View::make('themes.edit', compact('theme'));
	}

	/**
	 * Update the specified theme in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$theme = Theme::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Theme::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$theme->update($data);

		return Redirect::route('themes.index');
	}

	/**
	 * Remove the specified theme from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Theme::destroy($id);

		return Redirect::route('themes.index');
	}

	/**
	* Ajax upload images
	*/
	public function ajaxImages() {
		if( Request::ajax() ) {

			$rules = ['images[]' => 'image'];

			$validator = Validator::make($data = Input::all(), $rules);
			
			if( $validator->fails() || is_null(Input::file('images')) ) {
				return Response::json(array('success' => false, 'data' => 'The file must be an image.'));
			}
			$images = Input::file('images');
			$dataImg = array();
			foreach ($images as $image) {
				$name = md5( time() . $image->getClientOriginalName() ) . '.' . $image->getClientOriginalExtension();
				$image->move($this->path, $name);
				$dataImg[] = $this->path . '/' . $name;
			}
			return Response::json(array('success' => true, 'data' => $dataImg));
		}
	}
	/**
	* Ajax remove images
	*/
	public function ajaxRemoveImages() {
		$path = Input::get('path');
		if(file_exists($path)) {
			unlink($path);
			return Response::json(array('success' => true));
		} else {
			return Response::json(array('success' => false));
		}
	}
}
