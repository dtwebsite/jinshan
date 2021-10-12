@include('front.layouts.header')
@include('front.layouts.footer')
@include('front.layouts.loading')
<!DOCTYPE html>
<html>
    @yield('head')
    <body class="products">
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
                        @foreach($products as $key => $value)
                        <div class="swiper-slide pro1">
                            <div class="contentSection">
                                <div class="productsContent">
                                    <div class="productsRow">
                                        @foreach($value as $k => $v)
                                        <div class="productsList">
                                            <a class="link" href="/productsDetail/{{ $v['product_id'] }}">
                                                <div class="hiw-item">
                                                    <div class="hiw-item-w">
                                                        @for($i = 1; $i <= 3; $i++)
                                                        <div class="hiw-item-l l-{{$i}}">
                                                            <img src="{{ $v['img'] }}" alt="">
                                                        </div>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="productsTitle">{{ $v['name'] }}</div>
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
                                <img class="img-fluid" src="/front/images/products_end.jpg" alt="">
                                <div class="goNext">
                                    <div class="goNextContent txtWhite goLTR">
                                        <div class="goNextAnimation">
                                            <a href="/process" class="animated-arrow link">
                                                <div class="goNextTxt">next</div>
                                                <span class="the-arrow -left">
                                                <span class="shaft"></span>
                                                </span>
                                                <span class="the-arrow -right">
                                                <span class="shaft"></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="goNextUnit goNextRote">{{ __('message.Process') }}</div>
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