@include('front.layouts.header')
@include('front.layouts.footer')
@include('front.layouts.loading')
<!DOCTYPE html>
<html>
    @yield('head')
    <body class="productsDetail">
        @yield('loading')
        <div class="fullContainer">
            @yield('header')
            <section class="pageHorizontal">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="pageTitle">
                                <h1>{{ __('message.Products') }}</h1>
                            </div>
                        </div>
                        <div class="swiper-slide pro1">
                            <div class="contentSection proContent">
                                <div class="proPic1">
                                    {{-- 撈第一張產品圖 --}}
                                    <img class="img-fluid" src="/{{ $data['detail_img'][0]['img'] }}" alt="">
                                </div>
                                <div class="proPicListContent">
                                    <div class="proPicList">
                                        <img class="img-fluid" src="/{{ $data['img'] }}" alt="">
                                    </div>
                                    <h2 class="productsTitle">{{ $data['name'] }}</h2>
                                    <h4>{{ __('message.Features') }}</h4>
                                    <p>{!! $data['features'] !!}</p>
                                    <h4>{{ __('message.Application') }}</h4>
                                    <p>{!! $data['application'] !!}</p>
                                    <h4>{{ __('message.Material') }}</h4>
                                    <p>{!! $data['material'] !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide proDetailSlide">
                            <div class="contentSection pageProVertical">
                                <div class="mouseGuideScroll">
                                    <div class="mouseGuideScrollArrow">
                                        <span class="arrowScroll-down">
                                        </span>
                                        <span class="scrollScroll-title">
                                            Scroll
                                        </span>
                                    </div>
                                    <div class="mouseGuideScrollMouse">
                                        <div class="mouseGuideScrollWheel"></div>
                                    </div>
                                </div>
                                <div class="swiper-containerV">
                                    <div class="swiper-wrapper">
                                        @foreach($data['detail_img'] as $key => $value)
                                        <div class="swiper-slide">
                                            <img class="img-fluid" src="/{{ $value['img'] }}" alt="">
                                        </div>
                                        @endforeach
                                        <div class="swiper-slide">
                                            <img class="img-fluid" src="/{{ $last_img['img'] }}" alt="">
                                            <div class="goNext">
                                                <div class="goNextContent txtWhite goLTR">
                                                    <div class="goNextAnimation">
                                                        @if($data['product_id'] != $end_id)
                                                        <a href="/productsDetail/{{ $next_data['product_id'] }}" class="animated-arrow link">
                                                        @else
                                                        <a href="/processDetail" class="animated-arrow link">
                                                        @endif
                                                            <div class="goNextTxt">next</div>
                                                            <span class="the-arrow -left">
                                                            <span class="shaft"></span>
                                                            </span>
                                                            <span class="the-arrow -right">
                                                            <span class="shaft"></span>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    @if($data['product_id'] != $end_id)
                                                    <div class="goNextUnit goNextRote">{{ $next_data['name'] }}</div>
                                                    @else
                                                    <div class="goNextUnit goNextRote">{{ __('message.Process') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="pageProVpagination" class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        @yield('footer')
    </body>
</html>