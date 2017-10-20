@extends('blog.default.index')
@section('post_content')

    @foreach($all_posts as $posts)
        {{--@if($posts->post_type=='blog')--}}
            <article class="post">
                <header class="post-head small-screen-center">
                    <h2 class="post-title"><a href="{{ URL::to("/$posts->slug") }}" rel="bookmark" title="{{ $posts->post_title }}">{{ $posts->post_title }}</a></h2>
                    <div class="post-details">
                        <span class="post-date">
                        <i class="icon-clock"></i>
                            {{--September 25, 2014--}}
                            {{ date('F d, Y', strtotime($posts->created_at)) }}
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
                            <a href="#" title="Comment on {{ $posts->post_title }}">{{ $posts->comment_count }} comments
                            </a>
                        </span>
                        @endif
                    </div>
                </header>
                <div class="row">
                    @if($posts->post_image!=null)
                        <div class="post-media col-md-5 col-sm-5 col-xs-12">
                                <div class="figure fade-in text-center figcaption-middle">
                                    <a class="figure-image" href="{{ URL::to("$posts->slug") }}"> <img alt="The know how of branding" src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/blog011.jpg') }}">
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
                                @if($posts->post_password==Session::get('post_password') && $posts->slug==Session::get('post_slug'))
                                    {!! html_entity_decode($posts->post_content) !!}
                                @elseif($posts->post_password=='')
                                    {!! html_entity_decode($posts->post_content) !!}
                                @else
                                    <form action="{{ URL::to('blog/post_password') }}" method="post">
                                        {{ csrf_field() }}
                                    <h2>Enter post Password</h2>
                                        <input type="text" name="post_password" placeholder="Enter post Password" />
                                        <input type="hidden" name="post_slug" value="{{ Request::segment(1) }}" />
                                        <button type="submit" class="btn btn-flat" >Submit</button>
                                        @if(session()->has('error'))
                                            <span class="text-danger">{!! session('error') !!}</span>
                                        @endif
                                    </form>
                                @endif
                            @else
                                @if(isset($posts->post_content))
                                    {{--Session::pull('post_password');
                                    Session::pull('post_slug');--}}
                                    <?php

                                        if(strlen($posts->post_content)>500){
                                            $pos=strpos($posts->post_content, ' ', 200);
                                        }else{
                                            $pos=strpos($posts->post_content, ' ', floor((strlen($posts->post_content)/4)));
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
                                {{--<div class="social-buttons">
                                    <div class="text-right small-screen-center post-share">
                                        <ul class="social-icons social-sm social-simple social-circle">
                                            <li>
                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url()."/".$posts->slug }}" target="_blank" data-iconcolor="#00acee"> <i class="fa fa-facebook"></i> </a>
                                            </li>
                                            <li>
                                                <a href="https://plus.google.com/share?url={{ Request::url()."/".$posts->slug }}" target="_blank" data-iconcolor="#E45135"> <i class="fa fa-google-plus"></i> </a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank" data-iconcolor="#3b5998"> <i class="fa fa-twitter"></i> </a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank" data-iconcolor="#C92228"> <i class="fa fa-pinterest"></i> </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>--}}
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
        {{--@endif--}}

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

    @if(isset($all_metas))
            @if(Request::segment(1)==$all_metas->meta_key)
                <div class="text-center">
                    {{ $all_posts->render() }}
                </div>
            @endif
    @endif

@if(isset($comment_status))
    @if($comment_status->comment_status=="open")
    <!-- nav-below -->
    <div class="comments padded" id="comments">
        <div class="comments-head">
            @if(count($all_comments)<1)
                <h3>Start conversation</h3>
            @else
            <h3>
                {{ $comment_status->comment_count }} comments
            </h3>
                <small class="pull-right">Join the conversation</small>
            @endif
        </div>
        <section class="comment-list">
            <!-- First Comment -->
            @foreach($all_comments as $all_comment)
                @if($all_comment->comment_parent==null || $all_comment->comment_parent=='')
                    <article class="row">
                        <div class="col-md-2 col-sm-2 hidden-xs">
                            <figure class="thumbnail">
                                <img class="img-responsive img-circle" src="{{ asset('public/admin-panel/img/comment-user.png') }}" />
                                <figcaption class="text-center">{{ $all_comment->comment_author }}</figcaption>
                            </figure>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <div class="panel panel-default arrow left">
                                <div class="panel-body">
                                    <header class="text-left">
                                        <div class="comment-user"><i class="fa fa-user"></i> {{ $all_comment->comment_author }}</div>
                                        <time class="comment-date" datetime="{{ date("M d, Y H:i", strtotime($all_comment->created_at)) }}"><i class="fa fa-clock-o"></i> {{ date("M d, Y", strtotime($all_comment->created_at)) }}</time>
                                    </header>
                                    <div class="comment-post">
                                        <p>
                                            {{ $all_comment->comment_content }}
                                        </p>
                                    </div>
                                    <p class="text-right"><a href="#reply-title" onclick="commentValue('{{ $all_comment->comment_ID }}'); return false;" class="btn btn-default btn-sm reply"><i class="fa fa-reply"></i> reply</a></p>
                                </div>
                            </div>
                        </div>
                    </article>
                    @endif
                    @foreach($all_reply as $reply)
                    @if($reply->comment_parent==$all_comment->comment_ID)
                            <!-- Second Comment Reply -->
                    <article class="row">
                        <div class="col-md-2 col-sm-2 col-md-offset-1 col-sm-offset-0 hidden-xs">
                            <figure class="thumbnail">
                                <img class="img-responsive img-circle" src="{{ asset('public/admin-panel/img/comment-user.png') }}" />
                                <figcaption class="text-center">{{ $reply->comment_author }}</figcaption>
                            </figure>
                        </div>
                        <div class="col-md-9 col-sm-9">
                            <div class="panel panel-default arrow left">
                                <div class="panel-body">
                                    <header class="text-left">
                                        <div class="comment-user"><i class="fa fa-user"></i> {{ $reply->comment_author }}</div>
                                        <time class="comment-date" datetime="{{ date("M d, Y H:i", strtotime($reply->created_at)) }}"><i class="fa fa-clock-o"></i> {{ date("M d, Y", strtotime($reply->created_at)) }}</time>
                                    </header>
                                    <div class="comment-post">
                                        <p>
                                            {{ $reply->comment_content }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                @endif
            @endforeach
            @endforeach
        </section>
    </div>
    <div class="comment-respond" id="respond">
        <h3 class="comment-reply-title" id="reply-title">Leave a Reply <small>
                <a href="javascript:void (0)" id="cancel-comment-reply-link"
                   rel="nofollow" style="display:none;" class="text-danger" onclick="commentValueNull()">Cancel reply</a></small></h3>
        <form action="" class="comment-form" id="commentform" method="post">
            {{ csrf_field() }}
            <p class="comment-notes">
                <span id="email-notes">Your email address will not be published.</span>
                Required fields are marked <span class="required">*</span>

                <span id="comment_success"></span>
            </p>
            <div class="row">
                <div class="form-group col-md-4{{ $errors->has('comment_author') ? ' has-error' : '' }}">
                    <label for="author">Your name <span class="required">*</span>
                    </label>
                    <input class="input-block-level form-control" id="comment_author" name="comment_author" type="text" value="{{ old('comment_author') }}">
                    @if ($errors->has('comment_author'))
                        <span class="help-block">
                            <strong>{{ $errors->first('comment_author') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-4{{ $errors->has('comment_author_email') ? ' has-error' : '' }}">
                    <label for="email">Your email <span class="required">*</span>
                    </label>
                    <input class="input-block-level form-control" id="comment_author_email" name="comment_author_email" type="text" value="{{ old('comment_author_email') }}">
                    @if ($errors->has('comment_author_email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('comment_author_email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="url">Website</label>
                    <input class="input-block-level form-control" id="comment_author_url" name="comment_author_url" type="text">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12{{ $errors->has('comment_content') ? ' has-error' : '' }}">
                    <label for="comment">Your message <span class="required">*</span>
                    </label>
                    <textarea class="input-block-level form-control" id="comment_content" name="comment_content" rows="5">{{ old('comment_content') }}</textarea>
                    @if ($errors->has('comment_content'))
                        <span class="help-block">
                            <strong>{{ $errors->first('comment_content') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <p class="form-submit">
                <input class="btn btn-primary" id="comment_submit" type="button" value="Post Comment">
                <input id='comment_post_ID' name='comment_post_ID' type='hidden' value='{{ $comment_status->post_id }}'>
                <input id='comment_parent' name='comment_parent' type='hidden'>
            </p>
        </form>
    </div>
    
    <script>
        $("#comment_submit").click(function(){
            var comment_post_ID=$("#comment_post_ID").val();
            var comment_parent=$("#comment_parent").val();
            var comment_author=$("#comment_author").val();
            var comment_author_email=$("#comment_author_email").val();
            var comment_author_url=$("#comment_author_url").val();
            var comment_content=$("#comment_content").val();
            //alert(comment_author);exit();
            $.ajax({
                type: 'POST',
                url: '{{ URL::to('/blog/comment_post') }}',
                data: {
                    'comment_post_ID': comment_post_ID,
                    'comment_parent': comment_parent,
                    'comment_author': comment_author,
                    'comment_author_email': comment_author_email,
                    'comment_author_url': comment_author_url,
                    'comment_content': comment_content,
                    '_token':'{{ csrf_token() }}'
                },
                success: function (e) {
                    $("#comment_success").html("<span class='alert1 alert-success'>Comment sent for approval</span>");
                    var comment_parent=$("#comment_parent").val('');
                    var comment_author=$("#comment_author").val('');
                    var comment_author_email=$("#comment_author_email").val('');
                    var comment_author_url=$("#comment_author_url").val('');
                    var comment_content=$("#comment_content").val('');    

                },
                error: function (e) {
                    $("#comment_success").html("<span class='alert1 alert-danger'>SORRY! Comment not sent!</span>");
                }
            });

        });
    </script>
    <script>
        function commentValue(val){
            document.getElementById("comment_parent").value=val;
        }
        function commentValueNull(){
            document.getElementById("comment_parent").value='';

        }
    </script>
    <script>
        $("a.reply").click(function() {
            $('html,body').animate({
                scrollTop: $("#respond").offset().top
            },1500);
            $('#cancel-comment-reply-link').show();
        });
        $("#cancel-comment-reply-link").click(function() {
            $('#cancel-comment-reply-link').hide();
        });
    </script>
    <!-- #respond -->
    @endif
@endif
@endsection