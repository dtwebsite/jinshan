@include('front.layouts.header')
@include('front.layouts.footer')
@include('front.layouts.loading')
<!DOCTYPE html>
<html>
    @yield('head')
    <body class="aboutDetail">
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
                            <div class="contentSection d2">
                                <p>
                                    {!! $about_detail['full_introduction']->value !!}
                                </p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="contentSection d3">
                                <img class="img-fluid d3Img" src="{{ $about_detail['inner_img']->value }}" alt="">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="contentSection d4">
                                <div class="qsiTxt">
                                    <div class="bigText">
                                        <h4>QUALITY<i>{{ __('message.Quality') }}</i></h4>
                                        <p>{!! $about_detail['quality']->value !!}</p>
                                    </div>
                                    <div class="bigText">
                                        <h4>SERVICE<i>{{ __('message.Service') }}</i></h4>
                                        <p>{!! $about_detail['service']->value !!}</p>
                                    </div>
                                    <div class="bigText">
                                        <h4>INNOVATION<i>{{ __('message.Innovation') }}</i></h4>
                                        <p>{!! $about_detail['innovation']->value !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide d5">
                            <div class="pageSubTitle">
                                <h3>quality assurance</h3>
                            </div>
                            <div class="contentSection sgs">
                                @foreach($about_detail['certification'] as $key => $value)
                                <div class="sgsList">
                                    @foreach($value as $k => $v)
                                    <img class="img-fluid d5Img" src="{{ $v['img'] }}" alt="">
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-slide d6">
                            <div class="pageSubTitle specTitle">
                                <h3>Materials Plant</h3>
                            </div>
                            <div class="contentSection pageVertical">
                                <div class="mouseGuideDrag">
                                    <div class="mouseGuideDragArrow">
                                        <span class="arrowDrag-down">
                                        </span>
                                        <span class="scrollDrag-title">
                                            Drag
                                        </span>
                                    </div>
                                    <div class="mouseGuideDragMouse">
                                        <div class="mouseGuideDragWheel"></div>
                                    </div>
                                </div>
                                <div class="swiper-containerV swiper-no-swiping">
                                    <div class="swiper-wrapper">
                                        @foreach($about_detail['production_equipment'] as $value)
                                        <div class="swiper-slide">
                                            <img class="img-fluid" src="{{ $value->img }}" alt="">
                                        </div>
                                        @endforeach
                                    </div>
                                    {{-- <div id="pageProVpagination" class="swiper-pagination"></div>                                                                                                              --}}
                                </div>
                            </div>
                            <div class="equiTxt">
                                <h4>{{ __('message.ProductionEquipment') }}</h4>
                                <div class="equiTxtContent">
                                    @foreach($about_detail['production_equipment_detail'] as $key => $value)
                                    <div class="equiTxtRow">
                                        @foreach($value as $k => $v)
                                        <p>{{ $v['name'] }}</p>
                                        @endforeach
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="contentSection pageVertical">
                                <div class="mouseGuideDrag">
                                    <div class="mouseGuideDragArrow">
                                        <span class="arrowDrag-down">
                                        </span>
                                        <span class="scrollDrag-title">
                                            Drag
                                        </span>
                                    </div>
                                    <div class="mouseGuideDragMouse">
                                        <div class="mouseGuideDragWheel"></div>
                                    </div>
                                </div>
                                <div class="swiper-containerV swiper-no-swiping">
                                    <div class="swiper-wrapper">
                                        @foreach($about_detail['testing_equipment'] as $value)
                                        <div class="swiper-slide">
                                            <img class="img-fluid" src="{{ $value->img }}" alt="">
                                        </div>
                                        @endforeach
                                    </div>
                                    {{-- <div id="pageProVpagination2" class="swiper-pagination"></div>                                                                                                              --}}
                                </div>
                            </div>
                            <div class="equiTxt">
                                <h4>{{ __('message.TestingEquipment') }}</h4>
                                <div class="equiTxtContent">
                                    @foreach($about_detail['testing_equipment_detail'] as $key => $value)
                                    <div class="equiTxtRow">
                                        @foreach($value as $k => $v)
                                        <p>{{ $v['name'] }}</p>
                                        @endforeach
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide d7">
                            <div class="pageSubTitle">
                                <h3>OUR CLIENTS</h3>
                            </div>
                            <div class="contentSection clientList">
                                @foreach($about_detail['client'] as $key => $value)
                                <div class="clientLogo">
                                    @foreach($value as $k => $v)
                                    <a href="{{ $v['link'] }}">
                                        <img class="img-fluid" src="{{ $v['img'] }}" alt="">
                                    </a>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-slide d8">
                            <div class="contentSection">
                                <div class="pageSubTitle">
                                    <h3>HISTORY OF JIN SHAN</h3>
                                </div>
                                <div class="history">
                                    @foreach($about_detail['history'] as $key => $value)
                                    <div class="historyRow">
                                        @foreach($value as $k => $v)
                                        <div class="historyList">
                                            <h3>{{ $v['year'] }}</h3>
                                            <p>{{ $v['content'] }}</p>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endforeach
                                </div>
                                <div class="historyFixPic">
                                    @foreach($about_detail['history_img'] as $value)
                                        <img class="logo d8Img" src="{{ $value->img }}" alt="">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="pageEndHeight pageEnd pageDetailEnd">
                                <div class="goNext">
                                    <div class="goNextContent goLTR">
                                        <div class="goNextAnimation">
                                            {{-- <a href="/productsDetail/{{ $first_product->product_id }}" class="animated-arrow link"> --}}
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
                    <div id="pageHpagination" class="swiper-pagination"></div>
                </div>
            </section>
        </div>
        @yield('footer')
    </body>
</html>