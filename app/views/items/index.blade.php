@extends('users.index')

@section('content-title')
List Messages
@stop

@section('content')
<div class="box">
	<div class="box-body">
		@if( count($items) > 0 )
		<table class="table table-bordered">
			<tr>
				<th>ID</th>
				<th>Title</th>
				<th>Update date</th>
				<th>Status</th>
				<th>View</th>
			</tr>
			@foreach($items as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->title}}</td>
				<td>{{$item->created_at}}</td>
				<td>		
					<?php $status = $item->message->first()->status->name; ?>
					<span class="btn btn-{{Status::getClass($status)}}">{{$status}}</span>
				</td>
				<td>{{link_to_route('items.show', "Send Message", array($item->id), array('class' => 'btn btn-primary') )}}</td>
			</tr>
			@endforeach
		</table>

		{{$items->links()}}

		@else
			<p>Not found any request!</p>
		@endif

	</div>
</div>
@stop