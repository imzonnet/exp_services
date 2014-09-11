@extends('layouts.layout')

@section('content-title')
Login page
@stop

@section('content')
<div id="login-form" class="form-box">
<h1>Member Login</h1>
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

@stop
