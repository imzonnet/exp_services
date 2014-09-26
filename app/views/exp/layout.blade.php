<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>@yield('title', "Home" ) | Home</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <!-- jQuery 2.1.1 -->
        {{HTML::script("http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js")}}
        @section('style')
        <!-- bootstrap 3.0.2 -->
        {{HTML::style("public/frontend/css/bootstrap.min.css")}}
        <!-- font Awesome -->
        {{HTML::style("public/frontend/css/font-awesome.min.css")}}
        <!-- Ionicons -->
        {{HTML::style("public/frontend/css/ionicons.min.css")}}
        <!-- Theme style -->
        {{HTML::style("public/frontend/css/AdminLTE.css")}}
        {{HTML::style("public/frontend/css/style.css")}}

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        @show
    </head>
    <body class="@yield('body-class', 'default')">
        <div class="wrapper">
        <!-- header logo: style can be found in header.less -->
            @section('header')
                @include('exp.header')
            @show
            <section id="exp-banner" class="exp-section">
                <div class="exp-container">
                    <div class="row">
                        @yield('exp-banner')
                    </div>
                </div>
            </section>

            <section id="exp-intro" class="exp-section">
                <div class="container">
                    <div class="row">
                    @yield('exp-intro')
                    </div>
                </div>
            </section>
            
            <section id="exp-content" class="exp-section">
                <div class="container">
                    <div class="row">
                    @yield('exp-content')
                    </div>
                </div>
            </section>

            <section id="exp-bottom" class="exp-section">
                <div class="container">
                    <div class="row">
                    @section('exp-bottom')
                    <div class="region region-bottom-first col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="block">
                            <h3 class="block-title">Block Tite</h3>
                            <div class="block-content">
                                <p>We are the top marketing agency of 2013 with more than 15 years of experience with more than 2000 clients.</p>
                            </div>
                        </div>
                    </div>
                    <div class="region region-bottom-second col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="block">
                            <h3 class="block-title">Block Tite</h3>
                            <div class="block-content">
                                <p>We are the top marketing agency of 2013 with more than 15 years of experience with more than 2000 clients.</p>
                            </div>
                        </div>
                    </div>
                    <div class="region region-bottom-third col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="block">
                            <h3 class="block-title">Block Tite</h3>
                            <div class="block-content">
                                <p>We are the top marketing agency of 2013 with more than 15 years of experience with more than 2000 clients.</p>
                            </div>
                        </div>
                    </div>
                    <div class="region region-bottom-fourth col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="block">
                            <h3 class="block-title">Block Tite</h3>
                            <div class="block-content">
                                <p>We are the top marketing agency of 2013 with more than 15 years of experience with more than 2000 clients.</p>
                            </div>
                        </div>
                    </div>
                    @show
                    </div>
                </div>
            </section>

            <section id="exp-footer" class="exp-section">
                <div class="container">
                    <div class="row">
                    @section('exp-footer')
                    <div class="region region-copyright col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="block">
                            <div class="block-content">
                                <p style="margin: 0;">Copyright &copy; 2014 Exp Services</p>
                            </div>
                        </div>
                        
                    </div>
                    <div class="region region-socials-bottom col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="block">
                            <div class="block-content">
                                <div class="pull-right social-icons">
                                    <ul class="unstyled list-inline">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @show
                    </div>
                </div>
            </section>
        </div>
        @section('javascript')
        <!-- Bootstrap -->
        {{HTML::script("public/backend/js/bootstrap.min.js")}}
        @show
    </body>
</html>
