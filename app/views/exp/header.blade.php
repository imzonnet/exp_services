<section id="section-top-bar" class="exp-section">
	<div class="container">
		<div class="row">
			<!-- .region-top-left-->
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="block">
					<div class="block-content call-us">
						<ul class="unstyled list-inline">
							<li><i class="fa fa-phone"></i> +555.123.4567</li>
							<li><a href="#">News</a></li>
							<li><a href="#">Case Studies</a></li>
							<li><a href="#">F.A.Q</a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- END .region-top-left-->
			<!-- .region-top-right-->
			<div class="region region-top-right col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="pull-right social-icons">
					<ul class="unstyled list-inline">
						<li><a class="fa-button" href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a class="fa-button" href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a class="fa-button" href="#"><i class="fa fa-linkedin"></i></a></li>
						<li><a class="fa-button" href="#"><i class="fa fa-google-plus"></i></a></li>
						<li><a class="fa-button" href="#"><i class="fa fa-youtube"></i></a></li>
						<li><a class="fa-button" href="#"><i class="fa fa-dribbble"></i></a></li>
					</ul>
				</div>
			</div>
			<!-- END .region-top-right-->
		</div>
	</div>
</section>

<section id="section-header" class="exp-section">
	<div class="container">
		<div class="row">
			<!-- .region-logo-->
			<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
				<a class="site-logo" href="{{URL::route('home.index')}}" title="Exp Services">
					Exp Services
				</a>
			</div><!-- END .region-logo-->
			<!-- .region-navigation-->
			<?php if(Sentry::check()) $user = Sentry::getUser(); ?>
			<div class="region region-navigation col-xs-12 col-sm-12 col-md-7 col-lg-7">
				<div id="exp-dropdown" class="exp-menu exp-dropdown">
					<ul class="menu">
						<li><a href="#">Ticket System</a></li>
						<li><a href="#">Forum Support</a></li>
						@if( isset($user) )
						<li>
							<a href="#"><i class="fa fa-user"></i> Hello {{$user->first_name .' '. $user->last_name}}</a>
							<ul class="menu">
								<li><a href="{{URL::route('users.show',$user->id)}}">Profile</a></li>
								<li><a href="{{URL::route('items.index')}}">View Ticket</a></li>
								<li><a href="{{URL::route('users.logout')}}">Logout</a></li>
							</ul>
						</li>
						@else
						<li>
							<a href="{{URL::route('users.login')}}" id="userLogin"><i class="fa fa-user"></i> Login</a>
						</li>
						@endif
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="login-form-overlay"></div>
<div id="login-form" class="form-box box">
	<div class="box-header">
		<h3 class="box-title">Member Login</h3>
		<div class="pull-right box-tools">
            <button title="Remove" class="btn btn-info btn-sm" id="btnClose"><i class="fa fa-times"></i></button>
        </div>
	</div>
	<div class="box-body"> 
		{{Form::open(array('route' => 'users.login', 'method'=>'post'))}}
			<div class="form-group">
				{{Form::label('email', 'Email')}}
				{{Form::text('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'yourmail@mail.com'))}}
			</div>
			<div class="form-group">
				{{Form::label('password', 'Password')}}
				{{Form::password('password',array('class' => 'form-control', 'placeholder' => 'password'))}}
			</div>
			<div class="form-group">
				{{Form::submit('Login', array('class' => 'btn btn-primary'))}}
		        <p><a href="#">I forgot my password</a></p>
		        
			</div>
		{{Form::close()}}
	</div>
</div>
<script tyle="text/javascript">
jQuery(function($) {
	$('#userLogin').click(function(e) {
		$('#login-form, .login-form-overlay').fadeIn();
		e.preventDefault();
	});
	$('#btnClose').click(function(e) {
		$('#login-form, .login-form-overlay').fadeOut();
		e.preventDefault();
	})
});
</script>