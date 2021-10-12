@include('front.layouts.header')
@include('front.layouts.footer')
@include('front.layouts.loading')
<!DOCTYPE html>
<html>
    @yield('head')
    <body class="process">
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
                        <div class="swiper-slide pce1">
                            <div class="contentSection">
                                <div class="processContent">
                                    <div class="processRow">
                                        @foreach($value as $k => $v)
                                        <div class="processList">
                                            <a href="/processDetail#slide{{ $v['id'] }}">
                                                <div class="hovimg-zoom link">
                                                    <img class="img-fluid" src="/{{ $v['img'] }}" alt="">
                                                </div>
                                                <div class="processInfo">
                                                    <div class="processNo">{{ $k+1 }}</div>
                                                    <div class="processCon">
                                                        <div class="processTitle">{{ $v['title'] }}</div>
                                                        <div class="processTxt">{!! $v['content'] !!}</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="swiper-slide">
                            <div class="pageEndHeight pageEnd">
                                <img class="img-fluid" src="/front/images/process_end.jpg" alt="">
                                <div class="goNext">
                                    <div class="goNextContent txtWhite goLTR">
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