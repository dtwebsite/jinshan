@include('front.layouts.header')
@include('front.layouts.footer')
@include('front.layouts.loading')
<!DOCTYPE html>
<html>
    @yield('head')
    <body class="about">
        @yield('loading')
        <div class="fullContainer">
            @yield('header')
            <section class="pageHorizontal">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="pageTitle">
                                <h1>{{ __('message.About') }}</h1>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="contentSection a1">
                                <img class="img-fluid a1Img" src="{{ $about['index_img1']->value }}" alt="">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="contentSection a2">
                                <img class="img-fluid a2Img" src="{{ $about['index_img2']->value }}" alt="">
                                <p>
                                    {!! $about['introduction']->value !!}
                                </p>
                                <div class="btnMore"><a class="link" href="/aboutDetail">more</a></div>
                                <div class="qsiTxt">
                                    <div class="bigText">QUALITY</div>
                                    <div class="bigText">SERVICE</div>
                                    <div class="bigText">INNOVATION</div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="pageEndHeight pageEnd">
                                <img class="img-fluid" src="/front/images/about_end.jpg" alt="">
                                <div class="goNext">
                                    <div class="goNextContent txtWhite goLTR">
                                        <div class="goNextAnimation">
                                            <a href="/products" class="animated-arrow link">
                                                <div class="goNextTxt">next</div>
                                                <span class="the-arrow -left">
                                                <span class="shaft"></span>
                                                </span>
                                                <span class="the-arrow -right">
                                                <span class="shaft"></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="goNextUnit goNextRote">{{ __('message.Products') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div  id="pageHpagination" class="swiper-pagination"></div>
                </div>
            </section>
        </div>
        @yield('footer')
    </body>
</html>