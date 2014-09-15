@extends('users.index')

@section('content-title')
Send Request
@stop

@section('content')

<div class="form-message controller">
	
	{{Form::open(array('route' => 'messages.doSend', 'files' => true))}}
	@if(!Sentry::check())
		<div class="row">
			<div class="form-group col-md-6 col-lg-6 col-sm-12 col-xs-12">
				{{Form::label('first_name', 'First name')}}
				{{Form::text('first_name', Input::old('first_name'), array('class' => 'form-control'))}}
			</div>
			<div class="form-group col-md-6 col-lg-6 col-sm-12 col-xs-12">
				{{Form::label('last_name', 'Last name')}}
				{{Form::text('last_name', Input::old('last_name'), array('class' => 'form-control'))}}
			</div>
		</div>

		<div class="form-group">
			{{Form::label('email', 'Email')}}
			{{Form::text('email', Input::old('email'), array('class' => 'form-control'))}}
		</div>
	@endif
		<div class="form-group">
			{{Form::label('title', 'Title')}}
			{{Form::text('title', Input::old('title'), array('class' => 'form-control'))}}
		</div>

		<div class="form-group">
			{{Form::label('service_type_id', 'Service type')}}
			{{Form::select('service_type_id', $services, Input::old('service_type_id'), array('class' => 'form-control'))}}
		</div>

		<div class="form-group">
			{{Form::label('requirement', 'Requirement')}}
			{{Form::textarea('requirement', Input::old('requirement'), array('class' => 'form-control'))}}
		</div>

		<div class="form-group">
			{{Form::label('link', 'Link')}}
			{{Form::text('link', Input::old('link'), array('class' => 'form-control'))}}
		</div>

		<div class="form-group">
			{{Form::label('attachment', 'Attachment')}}
			{{Form::file('attachment')}}
		</div>

		<div class="form-group">
			{{Form::label('info', 'Info')}}
			{{Form::textarea('info', Input::old('info'), array('class' => 'form-control'))}}
		</div>

		<div class="form-group">
			{{Form::label('budget_id', 'Budget')}}
			{{Form::select('budget_id', $budgets, Input::old('budget_id'), array('class' => 'form-control'))}}
		</div>
		<div class="form-group">
			{{Form::label('deliver_in', 'Deliver in')}}
			{{Form::text('deliver_in', Input::old('deliver_in'), array('class' => 'form-control'))}}
		</div>

		<div class="form-group">
			{{Form::submit('SEND!', array('class' => 'btn btn-primary'))}}
		</div>

	{{Form::close()}}

</div>


@stop
