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
		$themes = Theme::orderBy('id', 'desc')->paginate(8);

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
					'image' => $image['url'],
					'name' => $image['name'],
					'theme_id' => $theme->id
				);
				ThemeImage::create($idata);
			}
		}
		/**
		* Create theme logs
		* #Initial released.
		*/
		ThemeLog::create([
			'description' => '#Initial released.',
			'changed_date' => new Datetime,
			'theme_id' => $theme->id,
		]);

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
		$data['theme'] = Theme::find($id);
		$data['category'] = Category::getList();
		$data['powerful'] = Powerful::getList();
		$data['theme_images'] = Theme::find($id)->themeImage;
		$data['theme_logs'] = Theme::find($id)->themeLog;
		return View::make('themes.edit', $data);
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

		$rules = array(
			'name' => 'required',
			'description' => 'required',
			'thumbnail' => 'image',
			'powerful_id' => 'required',
			'category_id' => 'required'
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
		* Upload new theme thunbnail
		*/
		if( Input::hasFile('thumbnail') ) {
			//remove old theme thumbnail
			if(file_exists($theme->thumbnail)) unlink($theme->thumbnail);
			//create new theme thumbnail
			$tb_name = md5(time() . Input::file('thumbnail')->getClientOriginalName()) . '.' . Input::file('thumbnail')->getClientOriginalExtension();
			Input::file('thumbnail')->move($this->path, $tb_name);
			$tb_path = $this->path . '/' . $tb_name;
			$data['thumbnail'] = $tb_path;
		} else {
			unset($data['thumbnail']);
		}

		//create new theme
		$theme->update($data);
		
		//update list old theme images
		if( Input::has('theme_images') ) {
			$theme_images = Input::get('theme_images');
			foreach($theme_images as $key => $image) {
				$themeimage = ThemeImage::find($key);
				$idata = array(
					'image' => $image['url'],
					'name' => $image['name']	
				);
				
				$themeimage->update($idata);
			}
		}
		//create new theme images
		if( Input::has('new_theme_images') ) {
			$theme_images = Input::get('new_theme_images');
			foreach($theme_images as $image) {
				$idata = array(
					'image' => $image['url'],
					'name' => $image['name'],
					'theme_id' => $theme->id
				);
				ThemeImage::create($idata);
			}
		}

		//update theme change logs
		if( Input::has('changelogs') ) {
			$cdata = array(
				'description' => Input::get('changelogs'),
				'theme_id' => $theme->id,
				'changed_date' => new Datetime
			);
			ThemeLog::create($cdata);
		}
		return Redirect::route('admin.themes.index')->with('message', 'Item had updated!');

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

		return Redirect::route('admin.themes.index')->with('message', 'Item had delted!');
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
			if(Input::has('id')) {
				$img = ThemeImage::find(Input::get('id'));
				if( count($img) > 0 ) $img->delete();
			}
			return Response::json(array('success' => true));
		} else {
			return Response::json(array('success' => false));
		}
	}
}
