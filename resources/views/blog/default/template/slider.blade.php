@extends('blog.default.index')
@section('slider')

    <section class="section">
        <div class="container-fullwidth">
            <div class="row">
                <div class="col-md-12">
                    <div class="fullwidthbanner-container">
                        <div class="tp-banner">
                            <ul>
                                <!-- SLIDE  -->
                                <li data-transition="fade" data-slotamount="5" data-masterspeed="500" data-saveperformance="on" {{--data-title="Intro Slide"--}}>
                                    <!-- MAIN IMAGE --><img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/s09.jpg') }}" alt="slidebg1" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                                    <!-- LAYERS -->
                                    <!-- LAYER NR. 1 -->
                                    <div class="tp-caption lfb ltb rs-parallaxlevel-0" data-x="0" data-y="0" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                         data-speed="800" data-start="1800" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 2;"> <img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/s10.png') }}"> </div>
                                    <!-- LAYER NR. 2 -->
                                    <div class="tp-caption lfb ltb rs-parallaxlevel-0" data-x="0" data-y="0" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                         data-speed="800" data-start="2100" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 3;"> <img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/s11.png') }}" alt=""> </div>
                                    <!-- LAYER NR. 3 -->
                                    <div class="tp-caption lfb ltb rs-parallaxlevel-0" data-x="0" data-y="0" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                         data-speed="800" data-start="2400" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 4;"> <img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/s12.png') }}"> </div>
                                    <!-- LAYER NR. 4 -->
                                    <div class="tp-caption lfb ltb rs-parallaxlevel-0" data-x="0" data-y="0" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                         data-speed="800" data-start="2600" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 5;"> <img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/s13.png') }}" alt=""> </div>
                                    <!-- LAYER NR. 5 -->
                                    <div class="tp-caption lfb ltb rs-parallaxlevel-0" data-x="0" data-y="0" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                         data-speed="800" data-start="2700" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 6;"><img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/s14.png') }}" alt=""> </div>
                                    <!-- LAYER NR. 6 -->

                                </li>
                                <li data-transition="fade" data-slotamount="5" data-masterspeed="500" data-saveperformance="on" {{--data-title="Intro Slide"--}}>
                                    <!-- MAIN IMAGE --><img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/s011.jp') }}g" alt="slidebg1" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                                    <!-- LAYERS -->
                                    <!-- LAYER NR. 1 -->
                                    <div class="tp-caption lfb ltb rs-parallaxlevel-0" data-x="0" data-y="0" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                         data-speed="800" data-start="1800" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 2;"> <img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/s021.pn') }}g" alt=""> </div>
                                    <!-- LAYER NR. 2 -->
                                    <div class="tp-caption lfb ltb rs-parallaxlevel-0" data-x="0" data-y="0" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                         data-speed="800" data-start="2100" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 3;"> <img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/s03.png') }}" alt=""> </div>
                                    <!-- LAYER NR. 3 -->
                                    <div class="tp-caption lfb ltb rs-parallaxlevel-0" data-x="0" data-y="0" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                         data-speed="800" data-start="2400" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 4;"> <img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/s041.pn') }}g" alt=""> </div>
                                    <!-- LAYER NR. 4 -->
                                    <div class="tp-caption lfb ltb rs-parallaxlevel-0" data-x="0" data-y="0" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                         data-speed="800" data-start="2600" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 5;"> <img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/s051.pn') }}g" alt=""> </div>
                                    <!-- LAYER NR. 5 -->
                                    <div class="tp-caption lfb ltb rs-parallaxlevel-0" data-x="0" data-y="0" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                         data-speed="800" data-start="2700" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 6;"> <img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/s06.png') }}" alt=""> </div>
                                    <!-- LAYER NR. 6 -->
                                    <div class="tp-caption lfb ltb rs-parallaxlevel-0" data-x="50" data-y="0" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                         data-speed="800" data-start="2800" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 7;"> <img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/s071.pn') }}g" alt=""> </div>
                                    <!-- LAYER NR. 7 -->

                                    <!-- LAYER NR. 10 -->
                                    <div class="tp-caption sfl rs-parallaxlevel-0" data-x="40" data-y="200" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                         data-speed="600" data-start="2400" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 11;"> <img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/s08.png') }}" alt=""> </div>
                                    <!-- LAYER NR. 11 -->

                                    <!-- LAYER NR. 12 -->
                                    <div class="tp-caption sfl rs-parallaxlevel-0" data-x="40" data-y="250" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                         data-speed="600" data-start="2700" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 13;"> <img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/s08.png') }}" alt=""> </div>
                                    <!-- LAYER NR. 13 -->

                                    <!-- LAYER NR. 14 -->
                                    <div class="tp-caption sfl rs-parallaxlevel-0" data-x="40" data-y="300" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                         data-speed="600" data-start="3000" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 15;"> <img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/s08.png') }}" alt=""> </div>
                                    <!-- LAYER NR. 15 -->

                                </li>
                                <li data-transition="fade" data-slotamount="5" data-masterspeed="500" data-saveperformance="on" {{--data-title="Intro Slide"--}}>
                                    <!-- MAIN IMAGE --><img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/s15.jpg') }}" alt="slidebg1" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                                    <!-- LAYERS -->
                                    <!-- LAYER NR. 1 -->
                                    <div class="tp-caption lfb ltb rs-parallaxlevel-0" data-x="0" data-y="-60" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                         data-speed="800" data-start="1800" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 2;"> <img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/s16.png') }}" alt="s16"> </div>
                                    <!-- LAYER NR. 2 -->
                                    <div class="tp-caption lfb ltb rs-parallaxlevel-0" data-x="0" data-y="-60" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                         data-speed="800" data-start="2100" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 3;"> <img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/s17.png') }}" alt=""> </div>
                                    <!-- LAYER NR. 3 -->
                                    <div class="tp-caption lfb ltb rs-parallaxlevel-0" data-x="0" data-y="-60" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                         data-speed="700" data-start="2400" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 4;"> <img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/s18.png') }}" alt=""> </div>
                                    <!-- LAYER NR. 4 -->
                                    <div class="tp-caption lfb ltb rs-parallaxlevel-0" data-x="0" data-y="-60" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                         data-speed="700" data-start="2700" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 5;"> <img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/s19.png') }}" alt=""> </div>
                                    <!-- LAYER NR. 5 -->
                                    <div class="tp-caption lfb ltb rs-parallaxlevel-0" data-x="0" data-y="-90" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                         data-speed="600" data-start="3000" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 6;"> <img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/s20.png') }}" alt=""> </div>
                                    <!-- LAYER NR. 6 -->
                                    <div class="tp-caption lfb ltb rs-parallaxlevel-0" data-x="0" data-y="-80" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                         data-speed="600" data-start="3300" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 7;"> <img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/s22.png') }}" alt=""> </div>
                                    <!-- LAYER NR. 7 -->
                                    <div class="tp-caption lfb ltb rs-parallaxlevel-0" data-x="0" data-y="-80" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                         data-speed="600" data-start="3600" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 8;"><img src="{{ asset('resources/views/blog/default/front-end/assets/images/corporate/s21.png') }}" alt=""> </div>
                                    <!-- LAYER NR. 8 -->

                                </li>
                            </ul>
                            <div class="tp-bannertimer"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection