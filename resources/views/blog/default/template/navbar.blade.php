@extends('blog.default.index')
@section('navbar')
<div class="container">
    <div class="navbar-header"> <button class="navbar-toggle collapsed" data-target=".main-navbar" data-toggle="collapse" type="button">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ URL::to('/') }}">
            <?php
            if(!empty($header_image) && ($autoload=='yes')) {
            ?>
            <img style=" height: 50%" src="{{ asset("public/$header_image") }}"/>
            <?php
            }else {
            ?>
                {{ $blogname }} <small>{{ $blogdescription }}</small>
            <?php
            }
            ?>
        </a> </div>
    <div class="nav-container">
        <nav class="collapse navbar-collapse main-navbar logo-navbar navbar-right">
            <div class="menu-container">
                <ul class="nav navbar-nav" id="menu-main">
                    @foreach($all_navbar as $navbar)
                        @if($navbar->is_menu_show=='yes')
                            @if($navbar->parent_id==NULL || $navbar->parent_id=='0')
                                <li class="menu-item @if(Request::segment(1)=="$navbar->slug")active @endif "> <a href="{{ URL::to("$navbar->slug") }}">{{ $navbar->post_title }} </a>
                                </li>
                            @elseif($navbar->parent_id=='sub-menu')
                                <li class="menu-item dropdown"> <a class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" href="#" aria-expanded="true">{{ $navbar->post_title }} <i class="fa fa-chevron-down"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-left ">
                                        @foreach($child_menu as $child)
                                            @if($navbar->post_id==$child->parent_id)
                                                <li class="menu-item"> <a href="{{ URL::to("$child->slug") }}"> {{ $child->post_title }}</a> </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endif
                    @endforeach
                </ul>
            </div>

            {{--
                FOR SEARCH
            --}}
            <div class="menu-sidebar">
                <div class="sidebar-widget widget_search" id="search-5">
                    <div class="top-search">
                        <form action="{{ URL::to('blog/search_anything') }}" method="get" name="searchform">
                            <div class="input-group">
                                <input class="form-control" name="search" placeholder="Search" type="text"> <span class="input-group-btn">
                                        <button class="btn btn-primary" type="submit" value="Search">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                            </div>
                        </form>
                        <a class="search-trigger"></a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
    <script>
        $(document).ready(function() {
            $(".nav a").on("click", function(){
                $(".nav").find(".active").removeClass("active");
                $(this).parent().addClass("active");
            });
        });
    </script>
@endsection