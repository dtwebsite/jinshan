@include('front.layouts.header')
@include('front.layouts.footer')
@include('front.layouts.loading')
<!DOCTYPE html>
<html>
    @yield('head')
    <body class="welcome">
        @yield('loading')
        <div class="fullContainer">
            @yield('header')
            <section class="jin_section">
                <div class="jin_container">
                    <div class="welcomeContent">
                        <div class="welcomeIntro">
                            {{ __('message.IndexMsg1') }}，<br>{{ __('message.IndexMsg2') }}，<br>{{ __('message.IndexMsg3') }}
                        </div>
                        <div class="jin_sliderContent">
                            <div class="jin_slider">
                                <div class="swiper-pagination swiper-pagination-white"></div>
                                <div class="swiper_gauge"></div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-wrapper">
                        <!-- <div class="swiper-slide jin_slide1"> -->
                        <div class="swiper-slide jin_slide1">
                            <div class="slide_bg">
                            <video autoplay muted loop style="position: fixed; left: 0; top: 0;  min-width: 100%;  min-height: 100%;">
                                <source src="/front/images/testvideo.mp4" type="video/mp4">
                            </video>
                            </div>
                        </div>
                        <div class="swiper-slide jin_slide2">
                            <div class="slide_bg">
                                <video autoplay muted loop style="position: fixed; left: 0; top: 0;  min-width: 100%;  min-height: 100%;">
                                    <source src="/front/images/2.mp4" type="video/mp4">
                                </video>
                            </div>
                        </div>
                        <div class="swiper-slide jin_slide3">
                            <div class="slide_bg">
                            </div>
                        </div>
                        <div class="swiper-slide jin_slide4">
                            <div class="slide_bg">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="goNext">
                    <div class="goNextContent txtWhite goLTR">
                        <div class="goNextAnimation">
                            <a href="/about" class="animated-arrow link">
                                <div class="goNextTxt">next</div>
                                <span class="the-arrow -left">
                                <span class="shaft"></span>
                                </span>
                                <span class="the-arrow -right">
                                <span class="shaft"></span>
                                </span>
                            </a>
                        </div>
                        <!-- <div class="goNextUnit goNextRote">ABOUT</div> -->
                    </div>
                </div>
            </section>
        </div>
        @yield('footer')
    </body>
</html>