@include('front.layouts.header')
@include('front.layouts.footer')
@include('front.layouts.loading')
<!DOCTYPE html>
<html>
    @yield('head')
    <body class="processDetail">
        @yield('loading')
        <div class="fullContainer">
            @yield('header')
            <section class="pageHorizontal">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="pageTitle">
                                <h1>{{ __('message.Process') }}</h1>
                            </div>
                        </div>
                        @foreach($process as $key => $value)
                        <div class="swiper-slide pce1" data-hash="slide{{ $value->id }}">
                            <div class="contentSection">
                                    <div class="processList">
                                        <div class="hovimg-zoom">
                                            <img class="img-fluid" src="/{{ $value->img }}" alt="">
                                            <div class="processNo">{{ $key+1 }}</div>
                                        </div>
                                        <div class="processInfo">
                                            <div class="processTitle">{{ $value->title }}</div>
                                            <div class="processTxt">{!! $value->inner_content !!}</div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="swiper-slide">
                            <div class="pageEndHeight pageEnd pageDetailEnd">
                                <div class="goNext">
                                    <div class="goNextContent goLTR">
                                        <div class="goNextAnimation">
                                            <a href="/gallery" class="animated-arrow link">
                                                <div class="goNextTxt">next</div>
                                                <span class="the-arrow -left">
                                                <span class="shaft"></span>
                                                </span>
                                                <span class="the-arrow -right">
                                                <span class="shaft"></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="goNextUnit goNextRote">{{ __('message.Gallery') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="pageHpagination" class="swiper-pagination"></div>
                </div>
            </section>
        </div>
        @yield('footer')
    </body>
</html>