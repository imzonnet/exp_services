@extends('layouts.layout')

@section('content-title')
Edit Profile
@stop

@section('content')

<div class="box">
	<div class="box-header">
		<i class="fa fa-th"></i>
	    <h3 class="box-title">Edit</h3>
	</div>
	<div class="box-body">
		{{Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT', 'files' => true))}}
		<div class="form-group">
			{{Form::label('email', 'Email: ' . $user->email)}}
			
		</div>
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
			{{Form::label('address', 'Address')}}
			{{Form::text('address', Input::old('address'), array('class' => 'form-control'))}}
		</div>
		<div class="form-group">
			{{Form::label('phone', 'Phone')}}
			{{Form::text('phone', Input::old('phone'), array('class' => 'form-control'))}}
		</div>
		<div class="form-group">
			{{Form::label('skype', 'Skype')}}
			{{Form::text('skype', Input::old('skype'), array('class' => 'form-control'))}}
		</div>
		<div class="form-group">
			{{Form::label('sex', 'Sex')}}
			{{Form::select('sex', ['male' => 'Male', 'female' => 'Female', 'nope' => 'Nope'], Input::old('sex'), array('class' => 'form-control'))}}
		</div>
		<div class="form-group clearfix">
			<div class="user-avatar col-md-2">
            	<img src="{{isset($user) && !empty($user->avatar) ? $user->avatar : Asset('public/img/avatar.png')}}" class="img-circle" alt="User Image" />
			</div>		
			<div class="user-avatar col-md-2">
				{{Form::label('avatar', 'Avatar')}}
				{{Form::file('avatar')}}
			</div>
		</div>
		<div class="form-group">
			{{Form::label('profile', 'Description')}}
			{{Form::textarea('profile', Input::old('profile'), array('class' => 'form-control'))}}
		</div>

		<hr />
		<fieldset>
			<div class="form-group">
				{{Form::label('old_password', 'Old Password')}}
				{{Form::password('old_password', array('class' => 'form-control'))}}
			</div>
			<div class="form-group">
				{{Form::label('password', 'New Password')}}
				{{Form::password('password', array('class' => 'form-control'))}}
			</div>
			<div class="form-group">
				{{Form::label('password_confirmation', 'Confirm Password')}}
				{{Form::password('password_confirmation', array('class' => 'form-control'))}}
			</div>
		</fieldset>

		<div class="form-group">
			{{Form::submit("Save", array('class' => 'btn btn-primary'))}}
		</div>
		{{Form::close()}}
	</div>

</div>




@stop