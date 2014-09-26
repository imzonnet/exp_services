@extends('layouts.layout')

@section('content-title')
Add new theme
@stop

@section('content')
<ul class="navigation list-inline">
	<li><a href="{{URL::route('admin.themes.index')}}" class="btn btn-primary">Back</a></li>
</ul>
<div class="box box-success">
	<div class="box-header">
		<h3 class="box-title">Add New theme</h3>
	</div>
	<div class="box-body">
		{{ Form::open(array('route' => 'admin.themes.store', 'method' => 'post', 'files' => true, 'id' => 'formTheme')) }}
			<div class="form-group">
				{{Form::label('name', 'Name')}}
				{{Form::text('name', Input::old('name'), ['class' => 'form-control', 'id' => 'name'])}}
			</div>

			<div class="form-group">
				{{Form::label('thumbnail', 'Thumbnail')}}
				{{Form::file('thumbnail', ['id' => 'thumbnail'])}}
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
				@foreach($powerful as $key => $value)
					<li>
						<label>{{Form::checkbox('powerful_id[]', $key)}} <span> {{$value}} </span></label>
					</li>
				@endforeach
				</ul>
			</div>

			<div class="form-group">
				{{Form::label('version', 'Version')}}
				{{Form::text('version', Input::old('version', '1.0'), ['class' => 'form-control', 'placdeholder' => '1.0'])}}
			</div>

			<div class="form-group">
				{{Form::label('price', 'Price')}}
				<div class="input-group">
					<span class="input-group-addon">$</span>
					{{Form::text('price', Input::old('price', '0.0'), ['class' => 'form-control', 'placdeholder' => '20'])}}
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
						<div id="grid-view"></div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>

			<div class="form-group">
				{{Form::submit('Add new', ['class' => 'btn btn-primary'])}}
			</div>

		{{ Form::close() }}

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
		            		html += '<input type="hidden" name="theme_images[' + key +'][url]" value="' + val + '" />';
		            		html += '<p><input type="text" class="form-control" name="theme_images[' + key +'][name]" value="' + $('#name').val() + '" />';
		            		html += '<p class="text-center"><span class="btnDelete btn btn-danger" data-path="'+val+'">Delete</span></p>';
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
		var path = $(this).data('path');
		var $_this = $(this);
		var formData = new FormData();
		console.log(path);

		formData.append("_token", "{{csrf_token()}}");
		formData.append("path", path);

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
	});

});

</script>

@stop