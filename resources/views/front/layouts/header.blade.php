@section('head')
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta content="black" name="apple-mobile-web-app-status-bar-style" />
	<meta content="yes" name="apple-mobile-web-app-capable" />
	<meta content="email=no" name="format-detection" />
	<title>
		@if(App::getLocale() == 'zh')
			金山彩藝
		@else
			Jin Shan
		@endif
	</title>
	<link rel="stylesheet" href="{{ asset('front/css/index_main.css') }}">
	<link rel="stylesheet" href="{{ asset('front/css/index_rwd.css') }}">
	<link href="{{ asset('common/sweetalert/sweetalert2.min.css') }}" rel="stylesheet">
</head>
@endsection
@section('header')
{{-- <a id="top"></a> --}}
<div class="headerLogo">
	<a href="/" class="linkLogo">
		<span class="icon-logo" title="Jin Shan 金山彩藝"></span>
		@if(App::getLocale() == 'zh')
			<img class="img-fluid logoTxt" src="{{ asset('/front/images/logo.png') }}" alt="金山彩藝">
		@else
			<img class="img-fluid logoTxt" src="{{ asset('/front/images/logo_eng.png') }}" alt="Jin Shan">
		@endif
		<!-- <img class="img-fluid logoBigWhite" src="/front/images/logo.png" alt="金山彩藝"> -->
		<!-- <img class="img-fluid logoSmallWhite" src="{{ asset('/front/images/logo_swhite.png') }}" alt="金山彩藝">
		<img class="img-fluid logoSmallBlack" src="{{ asset('/front/images/logo_sblack.png') }}" alt="金山彩藝"> -->
	</a>
</div>
<div class="headerLang">
	<a class="link contactLink" href="/contact">{{ __('message.Contact') }}</a>
	@if(App::getLocale() == 'zh')
	<a class="link langLink" href="/lang/set/en">ENGLISH</a>
	@else
	<a class="link langLink" href="/lang/set/zh">繁體中文</a>
	@endif
	{{-- 繁體中文 --}}
</div>
<div class="headerMenu link">
	<a href="#" class="menu-link">
		<span class="menu-line menu-line-1"></span>
		<span class="menu-line menu-line-2"></span>
		<span class="menu-line-3">MENU</span>
	</a>
</div>
<div class="menu-overlay fullSetting">
	<div class="headerNavContainer">
		<a href="/" class="menuLogo">
			<span class="icon-logo" title="Jin Shan 金山彩藝"></span>
			<!-- <img class="img-fluid" src="{{ asset('/front/images/logo_sblack.png') }}" alt="金山彩藝"> -->
		</a>
		<ul>
			<li class="headerNavItem">
				<a href="/">{{ __('message.Home') }}</a>
			</li>
			<li class="headerNavItem">
				<a href="/aboutDetail">{{ __('message.About') }}</a>
			</li>
			<li class="headerNavItem">
				<a href="/products">{{ __('message.Products') }}</a>
			</li>
			<li class="headerNavItem">
				<a href="/process">{{ __('message.Process') }}</a>
			</li>
			<li class="headerNavItem">
				<a href="/gallery">{{ __('message.Gallery') }}</a>
			</li>
			<li class="headerNavItem">
				<a href="/contact">{{ __('message.Contact') }}</a>
			</li>
			<li class="headerNavItem menuSocial">
				<a href="{{ $line->value }}">LINE</a>
				<a href="{{ $facebook->value }}">FACEBOOK</a>
			</li>
		</ul>
	</div>
</div>
<div class="menu-circle-bg">
	<span class="menu-circle"></span>
</div>
@endsection