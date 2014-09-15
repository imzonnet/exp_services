@extends('users.index')

@section('content-title')
Send Request
@stop

@section('content')
<div class="request-head">
	<h3>{{$item->title}}</h3>
	<div class="content">
		{{$item->requirement}}
	</div>
</div>

<div class="messages clearfix">
	<div class="messages-wrap">
		<div class="col-md-2">
			<ul class="list-unstyled">
				<li>User: </li>
				<li></li>
			</ul>
		</div>	
		<div class="col-md-10">
world
		</div>
	</div>

</div>
<p class="clearfix"></p>
<div class="form-message controller">
	
	{{Form::open(array('action' => array('SupportersController@postItems',$item->id), 'files' => true))}}
	
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
