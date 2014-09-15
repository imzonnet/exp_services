@extends('users.index')

@section('content-title')
View Messages
@stop

@section('content')
<h4>{{$item->title}}</h4>
<table class="table table-bordered">
	<tr>
		<th>ID</th>
		<th>User</th>
		<th>Status</th>
		<th>Comments</th>
		<th>Attachment</th>
		<th>Submit Date</th>
	</tr>
	@foreach($messages as $message)
	<tr>
		<td>{{$message->id}}</td>
		<td>{{User::find($message->id)->first_name}}</td>
		<td>{{Status::find($message->status_id)->name}}</td>
		<td>{{$message->comments}}</td>
		<td>{{$message->attachment}}</td>
		<td>{{$message->submit_date}}</td>
		
	</tr>
	@endforeach
</table>

@stop