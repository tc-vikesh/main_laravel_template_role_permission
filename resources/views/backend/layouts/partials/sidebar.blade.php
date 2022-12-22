 <!-- sidebar menu area start -->
 @php
     $usr = Auth::user();
 @endphp
 <div class="sidebar-menu">
    <div class="sidebar-header  bg-white">
        <div class="logo">
            <a href="{{ route('admin.dashboard') }}">
                <!-- <h2 class="text-white">Admin</h2>  -->
                <div class="text-center ">
                <img src="{{ asset('backend/assets/images/logo.png') }}" class="responsive" />
                </div>
            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">

                   
                    <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}"><i class="ti-dashboard"></i> <span>Dashboard</span></a></li>

                    @if ($usr->can('admin.roles.create') || $usr->can('admin.roles.view') ||  $usr->can('admin.roles.edit') ||  $usr->can('admin.roles.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                            Roles & Permissions
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.roles.create') || Route::is('admin.roles.index') || Route::is('admin.roles.edit') || Route::is('admin.roles.show') ? 'in' : '' }}">
                            @if ($usr->can('admin.roles.index'))
                                <li class="{{ Route::is('admin.roles.index')  || Route::is('admin.roles.edit') ? 'active' : '' }}"><a href="{{ route('admin.roles.index') }}">All Roles</a></li>
                            @endif
                            @if ($usr->can('admin.roles.create'))
                                <li class="{{ Route::is('admin.roles.create')  ? 'active' : '' }}"><a href="{{ route('admin.roles.create') }}">Create Role</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    
                    @if ($usr->can('admin.users.create') || $usr->can('admin.users.view') ||  $usr->can('admin.users.edit') ||  $usr->can('admin.users.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user"></i><span>
                            Admins
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.users.create') || Route::is('admin.users.index') || Route::is('admin.users.edit') || Route::is('admin.users.show') ? 'in' : '' }}">
                            
                            @if ($usr->can('admin.users.index'))
                                <li class="{{ Route::is('admin.users.index')  || Route::is('admin.users.edit') ? 'active' : '' }}"><a href="{{ route('admin.users.index') }}">All Admins</a></li>
                            @endif

                            @if ($usr->can('admin.users.create'))
                                <li class="{{ Route::is('admin.users.create')  ? 'active' : '' }}"><a href="{{ route('admin.users.create') }}">Create Admin</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->