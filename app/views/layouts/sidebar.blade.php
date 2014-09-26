<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
    <?php if(Sentry::check()) $user = Sentry::getUser(); ?>
        <div class="pull-left image">
            <img src="{{isset($user) && !empty($user->avatar) ? Asset($user->avatar) : Asset('public/images/avatar.png')}}" class="img-circle" alt="Avatar" />
        </div>
        <div class="pull-left info">
            <p>Hello, {{ isset($user) ? $user->first_name .' '. $user->last_name : "Guest"}}</p>
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
        @if( isset($user) )
            <li>
                <a href="{{URL::route('users.index')}}">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- action for group Administer -->
            @if( $user->inGroup(Sentry::findGroupByName('administer')) )

            <li class="treeview active">
                 <a href="#">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Themes Maneger</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::route('admin.themes.index')}}" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> All themes</a></li>
                    <li><a href="{{URL::route('admin.themes.create')}}" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Add new</a></li>
                </ul>
            </li>

            <li class="treeview active">
                 <a href="#">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Option Maneger</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::route('admin.categories.index')}}" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Categories</a></li>
                    <li><a href="{{URL::route('admin.powerful.index')}}" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Powerful</a></li>
                </ul>
            </li>

            @endif
            <!-- end action for group Administer-->

            <!-- action for all user -->
            <li class="treeview active">
                 <a href="#">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Services</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::route('items.index')}}" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> List items</a></li>
                    <li><a href="{{URL::route('items.create')}}" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Send Request</a></li>
                </ul>
            </li>
            
            <li class="treeview active">
                 <a href="#">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Profile</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::route('users.show', $user->id)}}" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Setting</a></li>
                </ul>
            </li>

        @endif
        
        <li>
            @if( !isset($user) )
                <a href="{{URL::route('users.login')}}">
                    <i class="fa fa-user"></i> <span>Login</span>
                </a>
                <a href="{{URL::route('items.create')}}">
                    <i class="fa fa-comment-o"></i> <span>Send Request</span>
                </a>
            @else 
                <a href="{{URL::route('users.logout')}}">
                    <i class="fa fa-user"></i> <span>Logout</span>
                </a>
            @endif
        </li>

        

    </ul>
</section>