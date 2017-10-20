@extends('blog.default.index')
@section('top_bar')

    <div class="container">
        <div class="top top-left">
            <div class="sidebar-widget text-left small-screen-center widget_text">
                <div class="textwidget">
                    <b>Contact us</b> | <i class="fa fa-envelope"></i>&nbsp; <a href="mailto:ratuljh@gmail.com">ratuljh@gmail.com</a> </div>
            </div>
            <div class="sidebar-widget text-left small-screen-center widget_text">
                <div class="textwidget"> <a href="tel:+8801915170777"> <i class="fa fa-phone"></i> &nbsp; +8801915170777 </a></div>
            </div>
        </div>
        <div class="top top-right">
            <div class="sidebar-widget text-right small-screen-center widget_social">
                <ul class="unstyled inline social-icons social-simple social-normal">
                    <li>
                        <a data-iconcolor="#3b5998" href=""> <i class="fa fa-facebook"></i> </a>
                    </li>
                    <li>
                        <a data-iconcolor="#00acee" href=""> <i class="fa fa-twitter"></i> </a>
                    </li>
                    <li>
                        <a data-iconcolor="#5FB0D5" href=""> <i class="fa fa-linkedin"></i> </a>
                    </li>
                    <li>
                        <a data-iconcolor="#E45135" href=""> <i class="fa fa-google-plus"></i> </a>
                    </li>
                    <li>
                        <a data-iconcolor="#E62117" href=""> <i class="fa fa-youtube"></i> </a>
                    </li>
                </ul>
            </div>
            @if(Session::has('user'))
                <b>Hello <a href="{{ URL::to('/admin/dashboard') }}" title="Dashboard">{{ Session::get('user.name')}}</a></b>
                 | <a href="{{ URL::to('admin/destroy') }}">
                    <i class="fa fa-power-off"></i> Logout
                </a>
            @else
                <a href="{{ URL::to('/admin/login') }}"> Login </a> /
                <a href="{{ URL::to('/admin/register') }}"> Register </a>
            @endif
        </div>
    </div>

@endsection