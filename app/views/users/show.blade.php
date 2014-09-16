@extends('layouts.layout')

@section('content-title')
Profile
@stop
@section('content')

<div class="box">
	<div class="box-header">
	    <i class="fa fa-th"></i>
	    <h3 class="box-title">View Profile</h3>
	</div>
	<div class="box-body">
		<div class="user-avatar col-md-2 col-lg-2">
			<p><img class="img-circle" src="{{isset($user) && !empty($user->avatar) ? Asset($user->avatar) : asset('public/img/avatar.png')}}" /></p>
			<p>{{ $user->first_name .' '. $user->last_name }}</p>
		</div>
		<div class="user-detail col-md-10 col-lg-10">
			<ul class="list-unstyled">
				<li><strong>Name: </strong> {{ $user->first_name .' '. $user->last_name }}</li>
				<li><strong>Email: </strong> {{ $user->email}}</li>
				<li><strong>Address: </strong> {{ $user->address}}</li>
				<li><strong>Phone: </strong> {{ $user->phone}}</li>
				<li><strong>Skype: </strong> {{ $user->skype}}</li>
				<li><strong>Sex: </strong> {{ $user->sex}}</li>
				<li><strong>Profile: </strong> {{ $user->profile}}</li>
			</ul>
		</div>
		<div class="user-process">
			<ul class="list-unstyled list-inline">
				<li><a href="{{URL::route('users.edit',$user->id)}}" class="btn btn-success">Edit Profile</a></li>
			</ul>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

@stop
