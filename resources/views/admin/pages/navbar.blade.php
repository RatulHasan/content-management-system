        <!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{ asset('public/admin-panel/img/besofty.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>{{ ucwords(Session::get('user.name'))}}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="@if(Request::segment(2)=='dashboard')active @endif">
            <a href="{{URL::to('/admin/dashboard')}}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>

        <li class="@if(Request::segment(2)=='media')active @endif">
            <a href="{{URL::to('/admin/media')}}">
                <i class="fa fa-file-image-o"></i> <span>Media</span>
            </a>
        </li>

        <li class="@if(Request::segment(2)=='comments')active @endif">
            <a href="{{URL::to('/admin/comments')}}">
                <i class="fa fa-comment"></i> <span>Comments</span>
            </a>
        </li>

        <li class="@if(Request::segment(2)=='posts')active @endif">
            <a href="{{URL::to('/admin/posts')}}">
                <i class="fa fa-pencil"></i> <span>Posts</span>
            </a>
        </li>

        <li class="@if(Request::segment(2)=='pages')active @endif">
            <a href="{{URL::to('/admin/pages')}}">
                <i class="fa fa-folder-open-o"></i> <span>Pages</span>
            </a>
        </li>

        <li class="@if(Request::segment(2)=='menus')active @endif @if(Request::segment(2)=='customize')active @endif  @if(Request::segment(2)=='options')active @endif treeview">
            <a href="#">
                <i class="fa fa-paint-brush"></i> <span>Appearance</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li class="@if(Request::segment(2)=='customize')active @endif">
                    <a href="{{URL::to('/admin/customize')}}">
                        <i class="fa fa-circle-o"></i> <span>Themes</span>
                    </a>
                </li>
                <li class="@if(Request::segment(2)==='options')active @endif">
                    <a href="{{URL::to('/admin/options')}}">
                        <i class="fa fa-circle-o"></i> <span>Customize</span>
                    </a>
                </li>
                <li class="@if(Request::segment(2)=='menus')active @endif">
                    <a href="{{URL::to('/admin/menus')}}">
                        <i class="fa fa-circle-o"></i> <span>Menus</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="@if(Request::segment(2)=='users')active @endif">
            <a href="{{URL::to('/admin/users')}}">
                <i class="fa fa-users"></i> <span>Users</span>
            </a>
        </li>
    </ul>
</section>
<!-- /.sidebar -->
