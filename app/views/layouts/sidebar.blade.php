<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="img/avatar3.png" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
            <p>Hello, {{Sentry::check() ? Sentry::getUser()->first_name .' '. Sentry::getUser()->last_name : "Guest"}}</p>
        </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search..."/>
            <span class="input-group-btn">
                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
            </span>
        </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li>
            <a href="{{URL::route('home.index')}}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
            <a href="{{URL::route('items.create')}}">
                <i class="fa fa-comment-o"></i> <span>Send Request</span>
            </a>
            @if( ! Sentry::check() )
                <a href="{{URL::route('users.login')}}">
                    <i class="fa fa-user"></i> <span>Login</span>
                </a>
            @else

                @if(Sentry::getUser()->inGroup(Sentry::findGroupByName('supporter')) ) 

                <a href="{{URL::route('users.login')}}">
                    <i class="fa fa-user"></i> <span>Check Request</span>
                </a>

                @elseif(Sentry::getUser()->inGroup(Sentry::findGroupByName('user')) )
                <a href="{{URL::route('items.index')}}">
                    <i class="fa fa-user"></i> <span>List Request</span>
                </a>
                @endif
                
                <a href="{{URL::route('users.logout')}}">
                    <i class="fa fa-user"></i> <span>Logout</span>
                </a>

            @endif
        </li>
    </ul>
</section>