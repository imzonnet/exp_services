@extends('exp.layout')

@section('exp-banner')
    <p class="text-center">
        {{HTML::image(asset("public/frontend/img/slide/1.png"), "slide")}}
    </p>
@stop

@section('exp-intro')
    <h1 style="text-align: center; margin-top: 0px; font-family: 'Gotham bold';">JoomEXP Services</h1>
    <p style="text-align: center;">
        Are you looking for professional Joomla Templates and Extensions for your website? 
        <span style="font-family: Gotham bold;">Look no further!</span><br>
        <span style="font-family: Gotham bold;">JoomlaMan is here to help you!</span> 
        Choose from any of our Premium Joomla Templates and Extensions, <br> and bring your projects to life...
    </p>
@stop

@section('exp-content')
<div class="block block-products">
    @foreach($themes as $theme)
    <div class="product col-md-4 col-lg-4 col-sm-6 col-xs-12">
        <div class="product-header">
            <a href="{{URL::route( 'theme.show', array($theme->id, Str::slug($theme->name)) )}}" title="{{$theme->name}}">
            {{HTML::image(Common::getPathImage($theme->thumbnail), $theme->name)}}
                <div class="overlay"><i class="fa fa-search"></i></div>
            </a>
        <h4 class="product-title">
        {{link_to_route('theme.show', $theme->name, array($theme->id, Str::slug($theme->name)))}}
        </h4>
        </div>
    </div>
     @endforeach
</div>
@stop