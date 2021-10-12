@include('front.layouts.header')
@include('front.layouts.footer')
@include('front.layouts.loading')
<!DOCTYPE html>
<html>
    @yield('head')
    <body class="galleryDetail">
        @yield('loading')
        <div class="fullContainer">
            @yield('header')
            <section class="pageHorizontal">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="pageTitle">
                                <h1>{{ __('message.Gallery') }}</h1>
                            </div>
                        </div>
                        <div class="swiper-slide gallery1">
                            <div class="contentSection galleryContent">
                                <div class="galleryDetailContent d-flex flex-column justify-content-center align-items-start">
                                    <div class="backBtn link">
                                        <a href="{{ route('gallery',['page' => $page]) }}">BACK</a>
                                    </div>
                                    <div class="galleryInfo d-flex justify-content-center align-items-start">
                                        <div class="GLdate d-flex flex-column justify-content-start align-items-start">
                                            <span class="GLdateYear">{{ explode('.',$data['date'])[0] }}</span>
                                            <span class="GLdateMd">{{ explode('.',$data['date'])[1].'.'.explode('.',$data['date'])[2] }}</span>
                                        </div>
                                        <div class="GLtxt">
                                            {{ $data['title'] }}
                                        </div>
                                    </div>
                                    <div class="GLtxtPhar"><pre>{!! $data['content'] !!}</pre></div>
                                    <div class="PreNextGallery d-flex justify-content-between align-items-start">
                                        <div class="PreNextGalleryLink link">
                                            @if($data['gallery_id'] != $start_id)
                                            <a href="/galleryDetail/{{ $prev_data['gallery_id'] }}">
                                                <div class="PreNextArr text-right">← 上一則</div>
                                                <div class="PreNextTitle text-right">{{ $prev_data['title'] }}</div>
                                            </a>
                                            @endif
                                        </div>
                                        <div class="PreNextGalleryLink link">
                                            @if($data['gallery_id'] != $end_id)
                                            <a href="/galleryDetail/{{ $next_data['gallery_id'] }}">
                                                <div class="PreNextArr text-left">下一則 →</div>
                                                <div class="PreNextTitle text-left">{{ $next_data['title'] }}</div>
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide galleryDetailSlide">
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
                                            <img class="img-fluid" src="/{{ $value->img }}" alt="">
                                        </div>
                                        @endforeach
                                    </div>
                                    <div id="pageProVpagination" class="swiper-pagination"></div>
                                </div>
                                <div class="goNext">
                                    <div class="goNextContent goLTR">
                                        <div class="goNextAnimation">
                                            <a href="/contact" class="animated-arrow link">
                                                <div class="goNextTxt">next</div>
                                                <span class="the-arrow -left">
                                                <span class="shaft"></span>
                                                </span>
                                                <span class="the-arrow -right">
                                                <span class="shaft"></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="goNextUnit goNextRote">{{ __('message.Contact') }}</div>
                                    </div>
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