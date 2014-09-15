@extends('layouts.layout')

@section('content-title')
List Messages
@stop

@section('content')

@if(Session::has('message')) 
<div class="alert alert-success">
	{{Session::get('message')}}
</div>
@endif

<table class="table table-bordered">
	<tr>
		<th>ID</th>
		<th>Title</th>
		<th>Update date</th>
		<th>Email</th>
		<th>View</th>
	</tr>
	@foreach($items as $item)
	<tr>
		<td>{{$item->id}}</td>
		<td>{{$item->title}}</td>
		<td>{{$item->created_at}}</td>
		<td>{{User::find($item->user_id)->email}}</td>
		<td>{{link_to_action('SupportersController@getSend', "Contact", array($item->id), array('class' => 'btn btn-info') )}}</td>
	</tr>
	@endforeach
</table>
{{$items->links()}}
@stop