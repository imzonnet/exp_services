@extends('layouts.layout')

@section('content-title')
Powerful Manager
@stop

@section('content')

<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Add New Powerful</h3>
		</div>
		<div class="box-body">
			{{ Form::open(array('route' => 'admin.powerful.store', 'method' => 'post', 'files' => true)) }}
				<div class="form-group">
					{{Form::label('name', 'Name')}}
					{{Form::text('name', Input::old('name'), ['class' => 'form-control'])}}
				</div>
				<div class="form-group">
					{{Form::label('icon', 'Icon')}}
					{{Form::file('icon')}}
				</div>
				<div class="form-group">
					{{Form::label('description', 'Description')}}
					{{Form::textarea('description', Input::old('description'), ['class' => 'form-control'])}}
				</div>
				<div class="form-group">
					{{Form::submit('Add new', ['class' => 'btn btn-primary'])}}
				</div>

			{{ Form::close() }}
		</div>
	</div>
</div>
<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">List Powerful</h3>
		</div>
		<div class="box-body">
			<table class="table table-bordered">
				<tr>
					<th>Icons</th>
					<th>Title</th>
					<th>Description</th>
					<th>Actions</th>
				</tr>
				@foreach($powerful as $item)
				<tr>
					<td class="item-icon">
					{{ HTML::image(Common::getPathImage($item->icon), 'Powerful icon', ['title' => $item->name]) }}
					</td>
					<td>{{ $item->name }}</td>
					<td>{{ $item->description }}</td>
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
			{{$powerful->links()}}
		</div>
	</div>
</div>

@stop