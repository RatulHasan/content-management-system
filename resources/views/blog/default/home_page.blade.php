@extends('blog.default.index')
@section('post_content')

    @foreach($all_posts as $posts)
        {{--@if($posts->post_type=='blog')--}}
        <article class="post">
            <div class="post-media">
                @if($posts->post_image!=null)
                        <div class="figure fade-in text-center figcaption-middle">
                            <a class="figure-image" href="corporate-standard-post.html"> <img alt="The know how of branding" src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/blog011.jpg') }}">
                                <div class="figure-overlay">
                                    <div class="figure-overlay-container">
                                        <div class="figure-caption"> <span class="figure-overlay-icons">
                                                    <i class="icon-link"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                    </div>
                @endif
            </div>
            <header class="post-head small-screen-center">
                <h1 class="post-title">The importance of SEO</h1>
                <div class="post-details"> <span class="post-date">
                                    <i class="icon-clock"></i> September 25, 2014
                                </span> <span class="post-author">  <i class="icon-head"></i>
                                    <a href="corporate-about-us.html">Constantourakis Harris</a>
                                </span> <span class="post-category">
                                    <i class="icon-clipboard"></i>
                                    <a href="corporate-no-sidebar.html" rel="tag">Mobile</a>,
                                    <a href="corporate-about-us.html" rel="tag">Reviews</a>
                                </span> <span class="post-link">
                                    <i class="icon-speech-bubble"></i>
                                    <a href="corporate-no-sidebar.html" title="Comment on The importance of SEO">2 comments</a>
                                </span> </div>
            </header>
            <div class="post-body">
                {!! html_entity_decode($posts->post_content) !!}
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="small-screen-center post-extras">
                        <div class="post-tags"> <a href="corporate-no-sidebar.html" rel="tag">commandment</a> <a href="corporate-no-sidebar.html" rel="tag">lord</a> </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-right small-screen-center post-share">
                        <ul class="social-icons social-sm social-simple social-circle">
                            <li>
                                <a href="#" target="_blank" data-iconcolor="#00acee"> <i class="fa fa-twitter"></i> </a>
                            </li>
                            <li>
                                <a href="#" target="_blank" data-iconcolor="#dd1812"> <i class="fa fa-google-plus"></i> </a>
                            </li>
                            <li>
                                <a href="#" target="_blank" data-iconcolor="#3b5998"> <i class="fa fa-facebook"></i> </a>
                            </li>
                            <li>
                                <a href="#" target="_blank" data-iconcolor="#C92228"> <i class="fa fa-pinterest"></i> </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </article>
        {{--@endif--}}

    @endforeach

@endsection