@extends('layouts.layout')

@section('content-title')
Login page
@stop

@section('content')
<div id="login-form" class="form-box box">
	<div class="box-header">
		<h3 class="box-title">Member Login</h3>
	</div>
	<div class="box-body"> 
		{{Form::open(array('route' => 'users.login', 'method'=>'post'))}}
			<div class="form-group">
				{{Form::label('email', 'Email')}}
				{{Form::text('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'yourmail@mail.com'))}}
			</div>
			<div class="form-group">
				{{Form::label('password', 'Password')}}
				{{Form::password('password',array('class' => 'form-control', 'placeholder' => 'password'))}}
			</div>
			<div class="form-group">
				{{Form::submit('Login', array('class' => 'btn btn-primary'))}}
		        <p><a href="#">I forgot my password</a></p>
		        
			</div>
		{{Form::close()}}
	</div>
</div>

@stop
