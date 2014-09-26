@extends('exp.layout')

@section('title')
{{$theme->name}}
@stop

@section('exp-content')

<div class="product-wrap">
	<div class="product-header">
		<div class="col-md-5">
			<h3 class="product-title">{{$theme->name}}</h3>
		</div>
		<div class="col-md-4">
			<ul class="list-unstyled">
				<li>Release Date: {{$theme->created_at}}</li>
				<li>Version: {{$theme->version}}</li>
				<li>Download: 0</li>
			</ul>
		</div>
		<div class="col-md-3">
			<div class="btn btn-lg btn-warning">
				<h2>${{$theme->price}}</h2>
			</div>
		</div>
	</div>
	<div class="product-body">
		{{$theme->description}}
	</div>
	<div class="product-detail">
		<div class="product-feature col-md-4">
			{{$theme->description}}
		</div>
		<div class="product-images col-md-8">
			<div id="product-theme-images" class="carousel slide" data-ride="carousel">
				<!-- Wrapper for slides -->
				<div class="carousel-inner">
				@foreach($theme_images as $key => $image)
					<div class="item {{ $key == 0 ? 'active' : '' }}">
						<img src="{{asset($image->image)}}" alt="{{$image->name}}" title="{{$image->name}}">
						<div class="carousel-caption">
						{{$image->name}}
						</div>
					</div>
				@endforeach
				</div>

				<!-- Controls -->
				<a class="left carousel-control" href="#product-theme-images" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
				</a>
				<a class="right carousel-control" href="#product-theme-images" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
			</div>
		</div>
		
	</div>
	<div class="product-powerful">
		<div class="col-md-4">
			<div class="powerfulltext">
			@foreach($powerful as $item)
				<div class="info">
					<h3><img width="56" height="85" border="0" style="float: left; border: 0;" src="{{asset($item->icon)}}">{{$item->name}}</h3>
					<p>{{$item->description}}</p>
				</div>
			@endforeach
			</div>
		</div>
		<div class="col-md-8">
			{{HTML::image(asset($theme->thumbnail), $theme->name)}}
		</div>
	</div>
</div>
	
@stop