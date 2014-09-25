@extends('layouts.layout')

@section('title')
Add new theme
@stop

@section('content')

<div class="box box-success">
	<div class="box-header">
		<h3 class="box-title">Add New theme</h3>
	</div>
	<div class="box-body">
		{{ Form::open(array('route' => 'admin.themes.store', 'method' => 'post', 'files' => true, 'id' => 'formTheme')) }}
			<div class="form-group">
				{{Form::label('name', 'Name')}}
				{{Form::text('name', Input::old('name'), ['class' => 'form-control'])}}
			</div>

			<div class="form-group">
				{{Form::label('thumbnail', 'Thumbnail')}}
				{{Form::file('thumbnail')}}
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

			<div class="form-group">
				{{Form::label('', 'Images')}}
				{{Form::file('images[]', array('multiple'=>true, 'id' => 'images'))}}
			</div>

			<div class="form-group">
				{{Form::submit('Add new', ['class' => 'btn btn-primary'])}}
			</div>

		{{ Form::close() }}
		<div id="#dvPreview"></div>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#images').change(function(){
			var formData = new FormData();
			formData.append("_token", "{{csrf_token()}}");
			for(var i = 0; i < $(this).get(0).files.length; i++) {
				formData.append('images[]', $(this).get(0).files[i]);
			}

			if (typeof (FileReader) != "undefined") {
                $("#dvPreview").show();
                $("#dvPreview").append("<img />");
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#dvPreview img").attr("src", e.target.result);
                }
                console.log(reader.readAsDataURL($(this).get(0).files[0]));
            } else {
                alert("This browser does not support FileReader.");
            }

			$.ajax({
			    type: 'post',
			    url: '{{URL::action("ThemesController@ajaxImages")}}',
			    data: formData,
			    enctype: 'multipart/form-data',
			    processData: false,  // tell jQuery not to process the data
  				contentType: false,
			    success: function (data) {
		            console.log(data);
		    	}
	    	});

		});
		
	});

</script>

@stop