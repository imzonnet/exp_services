@extends('layouts.layout')

@section('content-title')
Powerful Manager
@stop

@section('content')

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Edit <strong>{{ $powerful->name }}</strong></h3>
	</div>
	<div class="box-body">
		{{ Form::model($powerful, array('route' => array('admin.powerful.update', $powerful->id), 'method' => 'PUT', 'files' => true)) }}
			<div class="form-group">
				{{Form::label('name', 'Name')}}
				{{Form::text('name', Input::old('name'), ['class' => 'form-control'])}}
			</div>
			<div class="form-group">
				{{Form::label('icon', 'Icon')}}
				<div class="clearfix">
					<div class="item-icon pull-left" style="margin-right: 10px;">
					 {{ HTML::image(Common::getPathImage($powerful->icon), 'Powerful icon', ['title' => $powerful->name]) }}
					</div>
					<div class="file-form">
						{{Form::file('icon')}}
					</div>
				</div>
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