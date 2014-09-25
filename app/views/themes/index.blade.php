@extends('layouts.layout')

@section('content-title')
Themes Manager
@stop

@section('content')
<ul class="navigation list-inline">
	<li><a href="{{URL::route('admin.themes.create')}}" class="btn btn-primary">Add New</a></li>
</ul>
<div class="box">
	<div class="box-body">
		<table class="table table-bordered">
			<tr>
				<th>Thumbnail</th>
				<th>Title</th>
				<th>Category</th>
				<th>Version</th>
				<th>Price</th>
				<th>Date</th>
				<th>Actions</th>
			</tr>
			@foreach($themes as $item)
			<tr>
				<td>{{ HTML::image(asset($item->thumbnail), $item->name, ['class' => 'theme-thumbnail']) }}</td>
				<td>{{ $item->name }}</td>
				<td>{{ $item->category->name }}</td>
				<td>{{ $item->version }}</td>
				<td>{{ $item->price }}</td>
				<td>{{ $item->created_at }}</td>

				<td>
					<div class="btn-group-vertical">
					{{ link_to_route('admin.powerful.edit', "Edit", array($item->id), array('class' => 'btn btn-info') ) }}
					{{ Form::model( $item, array('route' => array('admin.powerful.destroy', $item->id), 'method' => 'delete') ) }}
						{{ Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("You are about to permanently delete the selected items.\n \'Cancel\' to stop, \'OK\' to delete.")']) }}
					{{ Form::close() }}
					</div>
				</td>
			</tr>
			@endforeach
		</table>
		{{$themes->links()}}
	</div>
</div>

@stop