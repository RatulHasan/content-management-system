<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui">
    <title> 404 | BeSofty</title>
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,900%7CGentium+Basic:400italic&amp;subset=latin,latin" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('resources/views/blog/default/front-end/assets/css/extras.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/views/blog/default/front-end/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/views/blog/default/front-end/assets/css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/views/blog/default/front-end/assets/css/corporate.min.css') }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('resources/views/blog/default/front-end/assets/images/favicons/apple-touch-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('resources/views/blog/default/front-end/assets/images/favicons/apple-touch-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('resources/views/blog/default/front-end/assets/images/favicons/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('resources/views/blog/default/front-end/assets/images/favicons/apple-touch-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('resources/views/blog/default/front-end/assets/images/favicons/apple-touch-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('resources/views/blog/default/front-end/assets/images/favicons/apple-touch-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('resources/views/blog/default/front-end/assets/images/favicons/apple-touch-icon-144x144.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('resources/views/blog/default/front-end/assets/images/favicons/favicon-32x32.png" sizes="32x32') }}">
    <link rel="icon" type="image/png" href="{{ asset('resources/views/blog/default/front-end/assets/images/favicons/favicon-96x96.png" sizes="96x96') }}">
    <link rel="icon" type="image/png" href="{{ asset('resources/views/blog/default/front-end/assets/images/favicons/favicon-16x16.png" sizes="16x16') }}">
    <link rel="shortcut icon" href="{{ asset('resources/views/blog/default/front-end/assets/images/favicons/favicon.ico') }}">
</head>

<body class="pace-on pace-counter">
<div class="pace-overlay"></div>
<div class="top-bar">
    <div class="container">
        @yield('top_bar')
    </div>
</div>
<div class="menu navbar navbar-static-top header-logo-left-menu-right oxy-mega-menu navbar-sticky" id="masthead">
    <div class="container">
        {{--
            ** Navbar
            --}}

        @yield('navbar')

        {{--
        ** Navbar
        --}}
    </div>
</div>
<div id="content" role="main">
    <article>
        <section class="section">
            <div class="background-media" style="background-image: url('{{ asset('resources/views/blog/default/front-end/assets/images/corporate/p02.jpg') }}'); background-repeat:no-repeat; background-size:cover; background-attachment:fixed; background-position: 50% 0%;" data-start="background-position: 50% -31px"
                 data-0-top-bottom="background-position: 50% 50px"></div>
            <div class="background-overlay grid-overlay-0 " style="background-color: rgba(1,192,225,0.8);"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-2 text-center"></div>
                    <div class="col-md-8 text-center">
                        <h1 class="element-top-70 text-light os-animation bigger default" data-os-animation="fadeIn" data-os-animation-delay="0s"> {{ ucwords(Request::segment(2)) }} not found </h1>
                        <div class="divider-border divider-border-center element-top-10 element-bottom-10 os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.1s" style="height:3px;">
                            <div class="divider-border-inner" style="background:#ffffff; width:60px;"></div>
                        </div>
                        <p class="lead text-center center text-light element-bottom-40" data-os-animation="none" data-os-animation-delay="0s"> Sorry, but the page you were trying to view does not exist.<br /> </p> <a href="{{ Request::root() }}" class="btn btn-primary btn-lg text-light btn-icon-right add-margin element-bottom-40 os-animation" target="_self" data-os-animation="fadeIn" data-os-animation-delay="0s">
                            Go back home<i class="fa fa-home" data-animation="none"></i>
                        </a>
                        <p class="lead text-center center text-light element-bottom-40" data-os-animation="none" data-os-animation-delay="0s">or</p>
                        <div class="element-bottom-70 os-animation" data-os-animation="fadeIn" data-os-animation-delay="0s">
                            <ul class="social-icons text-normal social-lg social-simple social-circle text-light">
                                <li>
                                    <a href="" target="_self" style="background-color:#82c9ed;" data-iconcolor="#ea4c89"> <i class="fa fa-dribbble"></i> </a>
                                </li>
                                <li>
                                    <a href="" target="_self" style="background-color:#82c9ed;" data-iconcolor="#3b5998"> <i class="fa fa-facebook"></i> </a>
                                </li>
                                <li>
                                    <a href="" target="_self" style="background-color:#82c9ed;" data-iconcolor="#4183c4"> <i class="fa fa-github"></i> </a>
                                </li>
                                <li>
                                    <a href="" target="_self" style="background-color:#82c9ed;" data-iconcolor="#E45135"> <i class="fa fa-google-plus"></i> </a>
                                </li>
                                <li>
                                    <a href="" target="_self" style="background-color:#82c9ed;" data-iconcolor="#5FB0D5"> <i class="fa fa-linkedin"></i> </a>
                                </li>
                                <li>
                                    <a href="" target="_self" style="background-color:#82c9ed;" data-iconcolor="#00acee"> <i class="fa fa-twitter"></i> </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 "></div>
                </div>
            </div>
        </section>
        {{--<section class="section">
            <div class="background-overlay grid-overlay-0" style="background-color: rgba(240,240,240,0);"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ">
                        <h1 class="text-center element-top-60 text-normal os-animation big default" data-os-animation="fadeIn" data-os-animation-delay="0s"> Our latest news </h1>
                        <div class="divider-border divider-border-center element-top-10 element-bottom-10 os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.1s" style="height:3px;">
                            <div class="divider-border-inner" style="background:#00c0e1; width:60px;"></div>
                        </div>
                        <p class="lead text-center center  text-normal  element-bottom-40 os-animation " data-os-animation="fadeIn" data-os-animation-delay="0.2s"> We post our news regularly keeping it fresh.<br /> Take a look at our views and options. </p>
                        <div class=" element-top-20 element-bottom-20 recent-simple-os-container row">
                            <div class="col-md-4" data-os-animation="none" data-os-animation-delay="0s">
                                <article id="post-143" class="post-grid element-bottom-20 text-left">
                                    <a href="corporate-standard-post.html"> <img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/blog011.jpg') }}" alt="The know how of branding" class="img-responsive"> </a>
                                    <div class="post-grid-content">
                                        <h3 class="post-grid-content-title"> <a href="corporate-standard-post.html">
                                                The know how of branding
                                            </a> </h3>
                                        <p> Lisa, vampires are make-believe, like elves, gremlins, and Eskimos. We started out like Romeo and Juliet, but it ended up in tragedy. Attempted murder? Now honestly, what is that? Do they give a Nobel Prize for attempted
                                            chemistry? Get ready, skanks! It's time for the truth train! Books are useless! I only ever read one </p>
                                        <div class="post-grid-content-footer"> Langan John , September 25, 2014 </div>
                                    </div>
                                </article>
                            </div>
                            <div class="col-md-4" data-os-animation="none" data-os-animation-delay="0s">
                                <article id="post-144" class="post-grid element-bottom-20 text-left">
                                    <a href="corporate-standard-post.html"> <img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/blog02.jpg') }}" alt="A corporare design to remember" class="img-responsive"> </a>
                                    <div class="post-grid-content">
                                        <h3 class="post-grid-content-title"> <a href="corporate-standard-post.html">
                                                A corporare design to remember
                                            </a> </h3>
                                        <p> That sounded like a prayer. A prayer in a public school. God has no place within these walls, just like facts don't have a place within an organized religion. Son, a woman is like a beer. They smell good, they look
                                            good, you'd step over your own mother just to get one! But you can't </p>
                                        <div class="post-grid-content-footer"> Proistakis Manos , September 25, 2014 </div>
                                    </div>
                                </article>
                            </div>
                            <div class="col-md-4" data-os-animation="none" data-os-animation-delay="0s">
                                <article id="post-146" class="post-grid element-bottom-20 text-left">
                                    <a href="corporate-standard-post.html"> <img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/blog03.jpg') }}" alt="The blog fundamentals" class="img-responsive"> </a>
                                    <div class="post-grid-content">
                                        <h3 class="post-grid-content-title"> <a href="corporate-standard-post.html">
                                                The blog fundamentals
                                            </a> </h3>
                                        <p> There's one way and only one way to determine if an animal is intelligent. Dissect its brain! It's a T. It goes "tuh". Anyone who laughs is a communist! Morbo will now introduce tonight's candidates… Morbo's good friend,
                                            Richard Nixon.</p>
                                        <div class="post-grid-content-footer"> Constantourakis Harris , September 25, 2014 </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>--}}
    </article>
    <footer id="footer">
        @yield('footer')
    </footer>
</div>
<a class="go-top go-top-circle" href="javascript:void(0)"> <i class="fa fa-angle-up"></i> </a>

<script src="{{ asset('resources/views/blog/default/front-end/assets/js/theme.min.js') }}"></script>
</body>

</html>