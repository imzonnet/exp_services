<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>@yield('title', "AdminLTE" ) | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        @section('style')
        <!-- bootstrap 3.0.2 -->
        {{HTML::style("public/css/bootstrap.min.css")}}
        <!-- font Awesome -->
        {{HTML::style("public/css/font-awesome.min.css")}}
        <!-- Ionicons -->
        {{HTML::style("public/css/ionicons.min.css")}}
        <!-- Theme style -->
        {{HTML::style("public/css/AdminLTE.css")}}

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        @show
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        @section('header')
            @include('layouts.header')
        @show

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                @section('sidebar')
                    @include('layouts.sidebar')
                @show
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>@yield('content-title','Blank page<small>it all starts here</small>')</h1>
                    @yield('breadcrumb')
                </section>
                @if( $errors->has() )
                <section id="messages" class="container">
                    <div class="alert alert-danger">
                        <button data-dismiss="alert" class="close" type="button">×</button>
                        <ul>
                            @foreach( $errors->all() as $error )
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                @endif
                <!-- Main content -->
                <section class="content">
                @yield('content')

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        @section('javascript')
        <!-- jQuery 2.0.2 -->
        {{HTML::script("http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js")}}
        <!-- Bootstrap -->
        {{HTML::script("public/js/bootstrap.min.js")}}
        <!-- AdminLTE App -->
        {{HTML::script("public/js/AdminLTE/app.js")}}
        <!-- AdminLTE for demo purposes -->
        {{HTML::script("public/js/AdminLTE/demo.js")}}
        @show
    </body>
</html>
