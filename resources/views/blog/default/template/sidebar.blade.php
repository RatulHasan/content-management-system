@extends('blog.default.index')
@section('sidebar')

    <div class="sidebar-widget widget_search">
        <form action="{{ URL::to('blog/{slug}') }}" id="searchform" method="get" name="searchform">
            <div class="input-group">
                <input class="form-control" name="slug" placeholder="Search" type="text" value=""> <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit" value="Search">
                        <i class="fa fa-search"></i>
                    </button>
                </span> </div>
        </form>
    </div>
    <div class="sidebar-widget widget_text">
        <h3 class="sidebar-header">Find Us</h3>
        <div class="sidebar-widget widget_social">
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
                    <a data-iconcolor="#34526f" href=""> <i class="fa fa-tumblr"></i> </a>
                </li>
                <li>
                    <a data-iconcolor="#E62117" href=""> <i class="fa fa-youtube"></i> </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="sidebar-widget widget_categories" id="categories-5">
        <h3 class="sidebar-header">Categories</h3>
        <ul>
            @foreach($all_categories as $all_category)
                <li class="cat-item cat-item-6">
                    <a href="{{ URL::to("/category/$all_category->category_name") }}">{{ $all_category->category_name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="sidebar-widget widget_recent_entries">  
        <h3 class="sidebar-header">Recent Posts</h3>
        <ul>
            @foreach($recent_posts as $recent_post)
                <li class="clearfix">
                    <div class="post-icon">
                        <a href="{{ URL::to("/$recent_post->slug") }}" title="{{ $recent_post->post_title }}">  </a>
                    </div> <a href="{{ URL::to("/$recent_post->slug") }}" title="{{ $recent_post->post_title }}">{{ $recent_post->post_title }}</a> <small class="post-date">{{ date("F d, Y",strtotime($recent_post->created_at)) }}</small>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="sidebar-widget widget_tag_cloud">
        <h3 class="sidebar-header">Tags</h3>
        <div class="tagcloud">
            <ul>
                @foreach($all_tags as $all_tag)
                    <li>
                        <a href="{{ URL::to("/tag/$all_tag->tag_name") }}">{{ $all_tag->tag_name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection