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

        <li class="treeview">

            @if(Sentry::getUser()->inGroup(Sentry::findGroupByName('supporter')) ) 
                <a href="#">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Supporters</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('supporters/index')}}" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Dashboard</a></li>
                </ul>

            @elseif(Sentry::getUser()->inGroup(Sentry::findGroupByName('user')) )
                 <a href="#">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Members</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('users/index')}}" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Dashboard</a></li>
                    <li><a href="{{url('users/items')}}" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> List items</a></li>
                </ul>
            @endif
                
        </li>

        <li>
            @if( ! Sentry::check() )
                <a href="{{URL::route('users.login')}}">
                    <i class="fa fa-user"></i> <span>Login</span>
                </a>
            @else 
                <a href="{{URL::route('users.logout')}}">
                    <i class="fa fa-user"></i> <span>Logout</span>
                </a>
            @endif
            <a href="{{URL::route('items.create')}}">
                <i class="fa fa-comment-o"></i> <span>Send Request</span>
            </a>
        </li>

        

    </ul>
</section>