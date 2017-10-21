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
