@include('front.layouts.header')
@include('front.layouts.footer')
@include('front.layouts.loading')
<!DOCTYPE html>
<html>
    @yield('head')
    <body class="gallery">
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
                        <div class="swiper-slide">
                            <div class="contentSection g1">
                                <div class="galleryFrame d-flex flex-column justify-content-center align-items-center">
                                    <div class="galleryList w-100 d-flex justify-content-start align-items-center">
                                        <!-- 每2則 重複一次 -->
                                        @foreach($gallery->chunk(2) as $key => $value)
                                        <div class="galleryListRow d-flex flex-column">
                                            @foreach($value as $k => $v)
                                            <div class="galleryListItem">
                                                <a class="galleryListItemLink" href="/galleryDetail/{{ $v->gallery_id }}">
                                                    <div class="d-flex justify-content-center align-items-start">
                                                        <div class="galleryEmpty"></div>
                                                        <div class="galleryImg hovimg-zoom link">
                                                            <img class="img-fluid" src="{{ $v->detail_img->first()['img'] }}" alt="">
                                                            }
                                                        </div>
                                                    </div>
                                                    <div class="galleryInfo d-flex justify-content-center align-items-start">
                                                        <div class="GLdate d-flex flex-column justify-content-start align-items-start">
                                                            <span class="GLdateYear">{{ explode('.',$v->date)[0] }}</span>
                                                            <span class="GLdateMd">{{ explode('.',$v->date)[1].'.'.explode('.',$v->date)[2] }}</span>
                                                        </div>
                                                        <div class="GLtxt">
                                                            {{ $v->title }}
                                                        </div>
                                                    </div>
                                                </a> 
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="listPagination">
                                        {{ $gallery->links('vendor.pagination.bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="pageEndHeight pageEnd">
                                <img class="img-fluid" src="/front/images/gallery_end.jpg" alt="">
                                <div class="goNext">
                                    <div class="goNextContent txtWhite goLTR">
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
                    <div id="pageHpagination" class="swiper-pagination"></div>
                </div>
            </section>
        </div>
        @yield('footer')
    </body>
</html>