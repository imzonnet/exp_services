@extends('users.index')

@section('content-title')
Send Request
@stop

@section('content')
<h3>{{$item->title}}</h3>
<div class="form-message controller">
	
	{{Form::open(array('action' => array('SupportersController@postSend',$item->id), 'files' => true))}}
	
		<div class="form-group">
			{{Form::label('comments', 'Comments')}}
			{{Form::textarea('comments', Input::old('comments'), array('class' => 'form-control'))}}
		</div>

		<div class="form-group">
			{{Form::label('attachment', 'Attachment')}}
			{{Form::file('attachment')}}
		</div>

		<div class="form-group">
			{{Form::label('status_id', 'Status')}}
			{{Form::select('status_id', $status, Input::old('status_id'), array('class' => 'form-control'))}}
		</div>

		<div class="form-group">
			{{Form::submit('SEND!', array('class' => 'btn btn-primary'))}}
		</div>

	{{Form::close()}}

</div>


@stop
