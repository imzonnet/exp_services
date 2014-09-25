@extends('layouts.layout')

@section('title')
Add new theme
@stop

@section('content')

<div class="box box-success">
	<div class="box-header">
		<h3 class="box-title">Add New theme</h3>
	</div>
	<div class="box-body">
		{{ Form::open(array('route' => 'admin.themes.store', 'method' => 'post', 'files' => true)) }}
			<div class="form-group">
				{{Form::label('name', 'Name')}}
				{{Form::text('name', Input::old('name'), ['class' => 'form-control'])}}
			</div>

			<div class="form-group">
				{{Form::label('thumbnail', 'Thumbnail')}}
				{{Form::file('thumbnail')}}
			</div>

			<div class="form-group">
				{{Form::label('description', 'Description')}}
				{{Form::textarea('description', Input::old('description'), ['class' => 'form-control'])}}
			</div>

			<div class="form-group">
				{{Form::label('features', 'Features')}}
				{{Form::textarea('features', Input::old('features'), ['class' => 'form-control'])}}
			</div>

			<div class="form-group">
				{{Form::label('', 'Powerful')}}
			
			</div>

			<div class="form-group">
				{{Form::label('version', 'Version')}}
				{{Form::text('version', Input::old('version'), ['class' => 'form-control'])}}
			</div>

			<div class="form-group">
				{{Form::label('price', 'Price')}}
				{{Form::text('price', Input::old('price'), ['class' => 'form-control'])}}
			</div>
			
			<div class="form-group">
				{{Form::label('category_id', 'category')}}
				{{Form::select('category_id', $category, Input::old('category_id'), ['class' => 'form-control'])}}
			</div>

			<div class="form-group">
				{{Form::label('', 'Images')}}
				{{Form::file('images[]', array('multiple'=>true))}}
			</div>

			<div class="form-group">
				{{Form::submit('Add new', ['class' => 'btn btn-primary'])}}
			</div>

		{{ Form::close() }}
	</div>
</div>

@stop