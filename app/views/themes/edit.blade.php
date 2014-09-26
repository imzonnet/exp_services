@extends('layouts.layout')

@section('content-title')
Edit 
@stop

@section('content')
<ul class="navigation list-inline">
	<li><a href="{{URL::route('admin.themes.index')}}" class="btn btn-primary">Back</a></li>
</ul>
<div class="box box-success">
	<div class="box-header">
		<h3 class="box-title">Edit theme</h3>
	</div>
	<div class="box-body">
		{{ Form::model($theme, array('route' => array('admin.themes.update', $theme->id), 'method' => 'PUT', 'files' => true, 'id' => 'formTheme')) }}
			<div class="form-group">
				{{Form::label('name', 'Name')}}
				{{Form::text('name', Input::old('name'), ['class' => 'form-control'])}}
			</div>

			<div class="form-group">
				{{Form::label('thumbnail', 'Thumbnail')}}
				<div class="clearfix">
					<div class="item-icon pull-left" style="margin-right: 10px;">
					 {{ HTML::image(asset($theme->thumbnail), 'Powerful icon', ['title' => $theme->name]) }}
					</div>
					<div class="file-form">
						{{Form::file('thumbnail', ['id' => 'thumbnail'])}}
					</div>
				</div>
			</div>

			<div class="form-group">
				{{Form::label('description', 'Description')}}
				{{Form::textarea('description', Input::old('description'), ['class' => 'form-control'])}}
			</div>

			<div class="form-group">
				{{Form::label('features', 'Features')}}
				{{Form::textarea('features', Input::old('features'), ['class' => 'form-control'])}}
			</div>

			<div class="form-group">
				{{Form::label('', 'Powerful')}}
				<ul class="list-unstyled">
				<?php $pdata = json_decode($theme->powerful_id); ?>
				@foreach($powerful as $key => $value)

					<li>
						<label><input type="checkbox" name="powerful_id[]" value="{{$key}}" {{in_array($key, $pdata) ? 'checked="checked"' : ""}} /> <span> {{$value}} </span></label>
					</li>
				@endforeach
				</ul>
			</div>

			<div class="form-group">
				{{Form::label('version', 'Version')}}
				{{Form::text('version', Input::old('version'), ['class' => 'form-control', 'placdeholder' => '1.0'])}}
			</div>

			<div class="form-group">
				{{Form::label('price', 'Price')}}
				<div class="input-group">
					<span class="input-group-addon">$</span>
					{{Form::text('price', Input::old('price'), ['class' => 'form-control', 'placdeholder' => '20'])}}
				</div>
			</div>
			
			<div class="form-group">
				{{Form::label('category_id', 'Category')}}
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-th"></i></span>
					{{Form::select('category_id', $category, Input::old('category_id'), ['class' => 'form-control'])}}
				</div>
			</div>

			<div id="image-popup" class="form-group">
				<div class="box box-danger">
					<div class="box-header">
						<h3 class="box-title">Upload theme images</h3>
					</div>
					<div class="box-body">
						<p>{{Form::file('images', array('multiple' => true, 'id' => 'images'))}}</p>
						<p><span id="btnUpload" class="btn btn-default">Click to upload images</span></p>
						<div id="grid-view">

							@foreach($theme_images as $image)
							<div class="grid-item col-md-3">
			            		<p><img src="{{asset($image->image)}}" class="image-item" /></p>
			            		<input type="hidden" name="theme_images[{{$image->id}}][url]" value="{{$image->image}}" />
			            		<p><input type="text" placeholder="Image name" class="form-control" name="theme_images[{{$image->id}}][name]" value="{{$image->name}}" /></p>
			            		<p class="text-center"><span class="btnDelete btn btn-danger" data-id="{{$image->id}}" data-path="{{$image->image}}">Delete</span></p>
		            		</div>
							@endforeach
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="box box-info">
					<div class="box-body">
				{{Form::label('changelogs', 'Change logs')}}
				{{Form::textarea('changelogs', Input::old('changelogs'), ['class' => 'form-control'])}}
					</div>
				</div>
			</div>
			<div class="form-group">
				{{Form::submit('Update', ['class' => 'btn btn-primary'])}}
			</div>

		{{ Form::close() }}

	</div>
</div>
<div id="theme-changelog" class="form-group">
	<div class="box box-warning">
		<div class="box-header">
			<h3 class="box-title">Change Logs</h3>
		</div>
		<div class="box-body">
			<ul class="timeline">
			    <!-- timeline item -->
			    @foreach($theme_logs as $log)
			    <li>
			        <!-- timeline icon -->
			        <i class="fa fa-refresh fa-spin bg-blue"></i>
			        <div class="timeline-item">

			            <h3 class="timeline-header"><i class="fa fa-clock-o"></i> {{$log->changed_date}}</h3>

			            <div class="timeline-body">
		                 	<pre>{{$log->description}}</pre>
			            </div>
			        </div>
			    </li>
			    @endforeach
			    <!-- END timeline item -->
			</ul>
		</div>
	</div>
</div>
<script type="text/javascript">

jQuery(document).ready(function($){

	$('#btnUpload').click(function(){
		$('#btnUpload').attr('disabled','disabled');

		var formData = new FormData();
		formData.append("_token", "{{csrf_token()}}");

		for(var i = 0; i < $('#images').get(0).files.length; i++) {
			formData.append('images[]', $('#images').get(0).files[i]);
		}

		$.ajax({
		    type: 'post',
		    url: '{{URL::action("ThemesController@ajaxImages")}}',
		    data: formData,
		    processData: false, 
			contentType: false,
		    success: function (data) {
		    	$('#image-popup .alert').remove();
	            if(data.success) {
	            	var html = "";
	            	$.each(data.data, function(key,val){
	            		html += '<div class="grid-item col-md-3">';
		            		html += '<p><img src="{{asset("'+val+'")}}" class="image-item" /></p>';
		            		html += '<input type="hidden" name="new_theme_images[' + key + '][url]" value="' + val + '" />';
		            		html += '<p><input type="text" class="form-control" name="new_theme_images[' + key + '][name]" value="{{$theme->name}}" /></p>';
		            		html += '<p class="text-center"><span class="btnDelete btn btn-danger" data-id="0" data-path="'+val+'">Delete</span></p>';
	            		html += '</div>';
	            	})
	            	$('#grid-view').html($('#grid-view').html() + html);
	            } else {
	            	$('#grid-view').before('<div class="alert alert-danger">' + data.data + '</div>');
	            }

	            $('#images').val("");
	            $('#btnUpload').removeAttr('disabled');
	    	}
    	});//$.ajax


	});//ajax upload images
	
	/**
	* Ajax remove images
	*/
	$(document).on('click', '.btnDelete', function(){
		var $_this = $(this);
		var formData = new FormData();

		formData.append("_token", "{{csrf_token()}}");
		formData.append("path", $(this).data('path'));
		formData.append("id", $(this).data('id'));

		if(confirm('Do you want delete this images')) {
			$.ajax({
			    type: 'post',
			    url: '{{URL::action("ThemesController@ajaxRemoveImages")}}',
			    data: formData,
			    processData: false, 
				contentType: false,
			    success: function (data) {
		    		console.log(data);
		    		$($_this).closest('.grid-item').fadeOut(300, function(){($(this).remove())});
				}
	    	});
		}
	});
	

});

</script>

@stop