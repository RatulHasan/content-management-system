

        <!-- Logo -->
        <a href="{{ URL::to('/') }}" target="_blank" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>B</b>e</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Be</b>Softy</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="dropdown tasks-menu" style="margin-right: 5px">
                <a href="{{ URL::to('admin/destroy') }}">
                    <i class="fa fa-power-off"></i> Signout
                </a>
            </li>
        </ul>
    </div>

</nav>
