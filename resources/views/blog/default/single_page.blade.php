@extends('blog.default.index')
@section('post_content')

    @foreach($all_posts as $posts)
            <article class="post">
                <header class="post-head small-screen-center">
                    <h2 class="post-title"><a href="{{ URL::to("/$posts->slug") }}" rel="bookmark" title="{{ $posts->post_title }}">{{ $posts->post_title }}</a></h2>
                    <div class="post-details">
                        <span class="post-date">
                        <i class="icon-clock"></i>
                            {{ date('M d, Y', strtotime($posts->post_date)) }}
                        </span> <span class="post-author">
                        <i class="icon-head"></i>
                        <a href="{{ URL::to("/author/$posts->post_author") }}">
                            {{ $posts->post_author }}
                        </a>
                        </span>
                        @if($posts->post_category)
                        <span class="post-category">
                            <i class="icon-clipboard"></i>
                            <a href="{{ URL::to("category/$posts->post_category") }}" rel="tag">{{ $posts->post_category }}</a>
                        </span>
                        @endif
                        @if($posts->comment_count>0)
                        <span class="post-link">
                            <i class="icon-speech-bubble"></i>
                            <a href="#" title="Comment on The know how of branding">{{ $posts->comment_count }} comments
                            </a>
                        </span>
                        @endif
                    </div>
                </header>
                <div class="row">
                    @if($posts->post_image!=null)
                        <div class="post-media col-md-5 col-sm-5 col-xs-12">
                                <div class="figure fade-in text-center figcaption-middle">
                                    <a class="figure-image" href="corporate-standard-post.html"> <img alt="The know how of branding" src="{{ asset('public/front-end/assets/images/corporate/blog011.jpg') }}">
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
                        </div>
                    @endif

                    @if($posts->post_image)
                    <div class="col-md-7 col-sm-7 col-xs-12">
                    @endif
                    @if(!$posts->post_image)
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    @endif
                        <div class="post-body">
                            @if(Request::segment(1)==$posts->slug)
                                {!! html_entity_decode($posts->post_content) !!}
                            @else
                                @if(isset($posts->post_content))
                                    <?php
                                        if(strlen($posts->post_content)>500){
                                            $pos=strpos($posts->post_content, ' ', 200);
                                        }
                                    ?>
                                        {!! substr($posts->post_content,0,$pos ).'...' !!}
                                @endif
                            @endif

                        </div>
                    </div>
                        <style>
                            .post-footer {
                                background: rgba(0,0,0,.02);
                                padding: 7px 15px;
                                overflow: hidden;
                                line-height: 30px;
                            }
                            .post-footer .social-buttons {
                                float: left;
                            }
                            .post-footer .post-links {
                                float: right;
                                padding-left: 10px;
                                font-size: 16px;
                            }
                        </style>
                            <div class="post-footer">
                                <div class="social-buttons">
                                    <a class="btn btn-social-icon btn-facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url()."/".$posts->slug }}"
                                       target="_blank">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                    <a class="btn btn-social-icon btn-google" href="https://plus.google.com/share?url={{ Request::url()."/".$posts->slug }}"
                                       target="_blank">
                                        <i class="fa fa-google-plus"></i>
                                    </a>

                                </div>
                                <div class="post-links">
                                    @if(Request::segment(1)!=$posts->slug)
                                        <a href="{{ URL::to("/$posts->slug") }}" class="post-more">
                                            <i class="fa fa-file-text-o"></i> Read more
                                        </a>
                                    @endif
                                </div>
                            </div>
                </div>
            </article>

    @endforeach


            <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('public/admin-panel/css/AdminLTE.min.css') }}">
        <script>

            var popupSize = {
                width: 780,
                height: 550
            };

            $(document).on('click', '.social-buttons > a', function(e){

                var
                        verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
                        horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2);

                var popup = window.open($(this).prop('href'), 'social',
                        'width='+popupSize.width+',height='+popupSize.height+
                        ',left='+verticalPos+',top='+horisontalPos+
                        ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

                if (popup) {
                    popup.focus();
                    e.preventDefault();
                }

            });
        </script>

    @if(Request::segment(1)=='blog')
        <div class="text-center">
            {{ $all_posts->render() }}
        </div>

    <!-- nav-below -->
    <div class="comments padded" id="comments">
        <div class="comments-head">
            <h3>2 comments</h3><small>Join the
                conversation</small> </div>
        <ul class="comments-list comments-body media-list">
            <li class="media media-comment">
                <div class="media-avatar media-left">
                    <a href="corporate-about-us.html"> <img alt='team' class='img-circle' height='48' src='{{ asset('public/front-end/assets/images/corporate/team11-notinclude.jpg') }}' width='48'> </a>
                </div>
                <div class="media-body">
                    <div class="media-inner">
                        <div>
                            <h4 class="media-heading clearfix"> <strong>Proistakis Manos</strong> - June 13, 2014 <strong class="comment-reply pull-right"><a class='comment-reply-link' href='#'>
                                        reply</a></strong></h4>
                            <p>Money is important in life, but it’s more important to not be consumed by it. Remember that there’s more to life than just buying things. Go out and live.</p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="media media-comment">
                <div class="media-avatar media-left">
                    <a href="corporate-about-us.html"> <img alt='team' class='img-circle' height='48' src='{{ asset('public/front-end/assets/images/corporate/team11-notinclude.jpg') }}' width='48'> </a>
                </div>
                <div class="media-body">
                    <div class="media-inner">
                        <div id="comment-7">
                            <h4 class="media-heading clearfix"> <strong>Pantazis Christos</strong> - January 29, 2015 <strong class="comment-reply pull-right"><a class='comment-reply-link'
                                                                                                                                                                  href='team11-notinclude.jpg'>
                                        reply</a></strong></h4>
                            <p>And now, in the spirit of the season: start shopping. And for every dollar of Krusty merchandise you buy, I will be nice to a sick kid. For legal purposes, sick kids may include hookers with a cold.</p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="comment-respond" id="respond">
        <h3 class="comment-reply-title" id="reply-title">Leave a Reply <small><a href=
                                                                                 "/corporate/2014/09/25/the-importance-of-seo/#respond"
                                                                                 id="cancel-comment-reply-link" rel="nofollow" style=
                                                                                 "display:none;">Cancel reply</a></small></h3>
        <form class="comment-form" id="commentform" method="post" name="commentform">
            <p class="comment-notes"><span id="email-notes">Your email address will not be
                            published.</span> Required fields are marked <span class="required">*</span></p>
            <div class="row">
                <div class="form-group col-md-4"> <label for="author">Your name
                        *</label><input class="input-block-level form-control" id="author" name="author" type="text" value=""> </div>
                <div class="form-group col-md-4"> <label for="email">Your email
                        *</label><input class="input-block-level form-control" id="email" name="email" type="text" value=""> </div>
                <div class="form-group col-md-4"> <label for="url">Website</label><input class="input-block-level form-control" id="url" name="url" type="text" value=""> </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12"> <label for="comment">Your message</label> <textarea class="input-block-level form-control" id="comment" name="comment" rows="5">
                                    </textarea> </div>
            </div>
            <p class="form-submit"> <input class="btn btn-primary" id="submit" name="submit" type="submit" value="Post Comment"> <input id='comment_post_ID' name='comment_post_ID' type='hidden' value='148'>
                <input id='comment_parent' name='comment_parent'
                       type='hidden' value='0'> </p>
        </form>
    </div>
    <!-- #respond -->
    @endif

@endsection