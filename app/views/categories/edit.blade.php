@extends('layouts.layout')

@section('content-title')
Categories Manager
@stop

@section('content')

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Edit <strong>{{ $category->name }}</strong></h3>
	</div>
	<div class="box-body">
		{{ Form::model($category, array('route' => array('admin.categories.update', $category->id), 'method' => 'PUT')) }}
			<div class="form-group">
				{{Form::label('name', 'Name')}}
				{{Form::text('name', Input::old('name'), ['class' => 'form-control'])}}
			</div>
			<div class="form-group">
				{{Form::label('description', 'Description')}}
				{{Form::textarea('description', Input::old('description'), ['class' => 'form-control'])}}
			</div>
			<div class="form-group">
				{{Form::submit('Update', ['class' => 'btn btn-primary'])}}
			</div>

		{{ Form::close() }}
	</div>
</div>

@stop