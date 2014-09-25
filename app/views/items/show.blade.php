@extends('users.index')

@section('content-title')
{{$item->title}}
@stop

@section('content')
<div class="request-head box box-danger">
	<div class="box-header">
	    <i class="fa fa-th"></i>
	    <h3 class="box-title">{{$item->title}}</h3>
	</div>
	<div class="box-body">
		<div class="chat-requirement">
			<h4>Requirement</h4>
			{{$item->requirement}}
		</div>
		<hr />
		<div class="chat-info">
			<h4>Info</h4>
			{{$item->info}}
		</div>
	</div>
	<div class="box-footer">
		<div class="col-md-6">
			<ul>
				<li>Link: {{link_to($item->link, 'View link')}}</li>
				<li>Attachment: {{link_to($item->attachment, 'View attach')}}</li>
				<li>Budget: $ {{Budget::find($item->budget_id)->price}}</li>
				<li>Service: {{Service::find($item->service_type_id)->name}}</li>
			</ul>
		</div>
		<div class="col-md-6">

		</div>
		<div class="clearfix"></div>
	</div>
</div>
<hr />
<div class="request-head box box-danger">
	<div class="box-header">
	    <i class="fa fa-th"></i>
	    <h3 class="box-title">List messages</h3>
	</div>

	<div id="chat-box" class="box-body chat">
	@if( count($messages) > 0 )
		@foreach($messages as $message)
	 	<div class="item">
	 		<?php $user = User::find($message->user_id); ?>
	        <img class="online" alt="user image" src="{{Asset($user->avatar)}}">
	        <div class="message">
	            <a class="name" href="#">
	                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{$message->submit_date}}</small>
	                {{$user->first_name .' '. $user->last_name}}
	            </a>
	            {{$message->comments}}
	        </div>

	        @if(!empty($message->attachment))
	        <div class="attachment">
	            <h4>Attachments:</h4>
	            <p class="filename">
	                {{link_to_asset(asset($message->attachment), 'Click to download', array('class' => 'btn btn-warning'))}}
	            </p>
	        </div><!-- /.attachment -->
			@endif

	    </div><!-- /.item -->
	    <!-- chat item -->
	
		@endforeach
	@else 
		<p>Not found message!</p>
	@endif

	</div><!--end #chat-box -->
</div>

<hr />
<div class="box box-success">
	<div class="box-header">
	    <i class="fa fa-th"></i>
	    <h3 class="box-title">Send messages</h3>
	</div>
	<div class="box-body">
		{{Form::open(array('action' => array('ItemsController@postMessages',$item->id), 'files' => true))}}
		
			<div class="form-group">
				{{Form::label('comments', 'Comments')}}
				{{Form::textarea('comments', Input::old('comments'), array('class' => 'form-control'))}}
			</div>

			<div class="form-group">
				{{Form::label('attachment', 'Attachment')}}
				{{Form::file('attachment')}}
			</div>

			<div class="form-group">
				{{Form::label('status_id', 'Status')}}
				{{Form::select('status_id', $status, Input::old('status_id'), array('class' => 'form-control'))}}
			</div>

			<div class="form-group">
				{{Form::submit('SEND!', array('class' => 'btn btn-primary'))}}
			</div>

		{{Form::close()}}

	</div>
</div>
@stop