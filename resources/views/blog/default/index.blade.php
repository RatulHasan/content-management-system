<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta name="description" content="@if(isset($blogdescription)){{ $blogdescription }} @endif">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui">
    <?php
        $url=Request::segment(1);
        $url=ucfirst(str_replace("-"," ",$url));
        if(empty($url)){
            $url="Home";
        }
    ?>
    <title> {{ $url }} | @if(isset($blogname)){{ $blogname }} @endif</title>
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
    <script src="{{ asset('resources/views/blog/default/front-end/assets/js/theme.min.js') }}"></script>
    <script src="{{ asset('resources/views/blog/default/front-end/assets/js/revolution.min.js') }}"></script>
    <style>
        .required{
            color:red;
        }
    </style>
</head>

<body class="pace-on pace-counter">
    <div class="pace-overlay"></div>
    <div class="top-bar">
        @yield('top_bar')
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
            @yield('slider')
            {{----}}
            <section class="section">
                <div class="container">
                    <div class="row element-top-50 element-bottom-50">
                        @if(isset($sidebar))
                        <div class="col-md-9 blog-list-layout-normal">
                        @else
                        <div class="col-md-12 blog-list-layout-normal">
                        @endif


                            {{--
                            ** All Posts
                            --}}

                            @yield('post_content')

                            {{--
                            ** All Posts
                            --}}

                        </div>
                    @if(isset($sidebar))
                        <div class="col-md-3 sidebar ">

                            {{--
                            ** Sidebar
                            --}}

                            @yield('sidebar')

                            {{--
                            ** Sidebar
                            --}}

                        </div>
                    @endif
                    </div>
                </div>
            </section>
        </article>
        <footer id="footer">
            @yield('footer')
        </footer>
    </div>
    <a class="go-top go-top-circle" href="javascript:void(0)"> <i class="fa fa-angle-up"></i> </a>
    <script type="text/javascript">
        var oxyThemeData = {
            navbarHeight: 100,
            navbarScrolled: 90,
            navbarScrolledPoint: 20,
            menuClose: 'off',
            scrollFinishedMessage: 'No more items to load.',
            hoverMenu:
            {
                hoverActive: false,
                hoverDelay: 1,
                hoverFadeDelay: 200
            },
            siteLoader: 'on'
        };
    </script>
    <a class="go-top go-top-circle" href="javascript:void(0)"> <i class="fa fa-angle-up"></i> </a>
    <script type="text/javascript">
        var oxyThemeData = {
            navbarHeight: 100,
            navbarScrolled: 90,
            navbarScrolledPoint: 20,
            menuClose: 'off',
            scrollFinishedMessage: 'No more items to load.',
            hoverMenu:
            {
                hoverActive: false,
                hoverDelay: 1,
                hoverFadeDelay: 200
            },
            siteLoader: 'on'
        };
    </script>

    <script type="text/javascript">
        /*jQuery(document).ready(function()
        {
            jQuery('#homepage-slider').revolution(
                    {
                        jsFileLocation: '{{asset('resources/views/blog/default/front-end/assets/')}}',
                        extensions: 'revolution-extensions/',
                        sliderType: "standard",
                        sliderLayout: "auto",
                        dottedOverlay: "none",
                        delay: 9000,
                        navigation:
                        {
                            keyboardNavigation: "off",
                            keyboard_direction: "horizontal",
                            mouseScrollNavigation: "off",
                            onHoverStop: "off",
                            touch:
                            {
                                touchenabled: "on",
                                swipe_threshold: 75,
                                swipe_min_touches: 1,
                                swipe_direction: "horizontal",
                                drag_block_vertical: false
                            },
                            arrows:
                            {
                                style: "",
                                enable: true,
                                hide_onmobile: false,
                                hide_onleave: false,
                                tmp: '',
                                left:
                                {
                                    h_align: "left",
                                    v_align: "center",
                                    h_offset: 20,
                                    v_offset: 0
                                },
                                right:
                                {
                                    h_align: "right",
                                    v_align: "center",
                                    h_offset: 20,
                                    v_offset: 0
                                }
                            },
                            bullets:
                            {
                                enable: true,
                                hide_onmobile: false,
                                style: "hesperiden",
                                hide_onleave: false,
                                direction: "horizontal",
                                h_align: "center",
                                v_align: "bottom",
                                h_offset: 0,
                                v_offset: 20,
                                space: 5,
                                tmp: ''
                            }
                        },
                        gridwidth: 1170,
                        gridheight: 550,
                        lazyType: "none",
                        parallax:
                        {
                            type: "mouse+scroll",
                            origo: "enterpoint",
                            speed: 400,
                            levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 50]
                        },
                        shadow: 2,
                        spinner: "spinner2",
                        stopLoop: "off",
                        stopAfterLoops: -1,
                        stopAtSlide: -1,
                        shuffle: "off",
                        autoHeight: "off",
                        hideThumbsOnMobile: "off",
                        hideSliderAtLimit: 0,
                        hideCaptionAtLimit: 0,
                        hideAllCaptionAtLilmit: 0,
                        debugMode: false,
                        fallbacks:
                        {
                            simplifyAll: "off",
                            nextSlideOnWindowFocus: "off",
                            disableFocusListener: false,
                        }
                    });
        });*/
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function()
        {
            jQuery('.tp-banner').show().revolution(
                    {
                        delay: 7000,
                        startwidth: 1170,
                        startheight: 480,
                        onHoverStop: "off", // Stop Banner Timer at Hover on Slide on/off
                        thumbWidth: 100, // Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
                        thumbHeight: 50,
                        thumbAmount: 3,
                        hideThumbs: 0,
                        navigationType: "bullet", // bullet, thumb, none
                        navigationArrows: "solo", // nexttobullets, solo (old name verticalcentered), none
                        navigationStyle: "round", // round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item), custom
                        navigationHAlign: "center", // Vertical Align top,center,bottom
                        navigationVAlign: "bottom", // Horizontal Align left,center,right
                        navigationHOffset: 0,
                        parallax:
                        {
                            type: "mouse+scroll",
                            origo: "enterpoint",
                            speed: 400,
                            levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 50],
                        },
                        navigationVOffset: 20,
                        soloArrowLeftHalign: "left",
                        soloArrowLeftValign: "center",
                        soloArrowLeftHOffset: 20,
                        soloArrowLeftVOffset: 0,
                        soloArrowRightHalign: "right",
                        soloArrowRightValign: "center",
                        soloArrowRightHOffset: 20,
                        soloArrowRightVOffset: 0,
                        touchenabled: "on", // Enable Swipe Function : on/off
                        stopAtSlide: -1, // Stop Timer if Slide "x" has been Reached. If stopAfterLoops set to 0, then it stops already in the first Loop at slide X which defined. -1 means do not stop at any slide. stopAfterLoops has no sinn in this case.
                        stopAfterLoops: -1, // Stop Timer if All slides has been played "x" times. IT will stop at THe slide which is defined via stopAtSlide:x, if set to -1 slide never stop automatic
                        hideCaptionAtLimit: 0, // It Defines if a caption should be shown under a Screen Resolution ( Basod on The Width of Browser)
                        hideAllCaptionAtLilmit: 0, // Hide all The Captions if Width of Browser is less then this value
                        hideSliderAtLimit: 0, // Hide the whole slider, and stop also functions if Width of Browser is less than this value
                        fullWidth: "on",
                        shadow: 0
                    });
        });
    </script>
</body>

</html>