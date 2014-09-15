@extends('users.index')

@section('content-title')
List Messages
@stop

@section('content')

<table class="table table-bordered">
	<tr>
		<th>ID</th>
		<th>Title</th>
		<th>Update date</th>
		<th>View</th>
	</tr>
	@foreach($items as $item)
	<tr>
		<td>{{$item->id}}</td>
		<td>{{$item->title}}</td>
		<td>{{$item->created_at}}</td>
		<td>{{link_to_route('items.show', "Messages", array($item->id), array('class' => 'btn btn-info') )}}</td>
	</tr>
	@endforeach
</table>
{{$items->links()}}
@stop