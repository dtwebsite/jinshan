@include('front.layouts.rollellip')
@section('footer')
<div class="hits">
	<div class="mouseGuide">
		<div class="mouseGuideArrow">
			<span class="arrow-down">
			</span>
			<span class="scroll-title">
				Scroll
			</span>
		</div>
		<div class="mouseGuideMouse">
			<div class="mouseGuideWheel"></div>
		</div>
	</div>
	@yield('rollEllip')
	<div id="js-follower" class="follower">
		<span></span>
	</div>
</div>

<script src="{{ asset('/front/js/jquery.min.js') }}"></script>
<script src="{{ asset('/front/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/front/js/swiper/swiper.min.js') }}"></script>
<script src="{{ asset('/front/js/jquery.mousewheel.min.js') }}"></script>
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
<script src="{{ asset('/front/js/cursor.js') }}"></script>
<script src="{{ asset('/front/js/main.js') }}"></script>
<script src="{{ asset('common/sweetalert/sweetalert2.min.js') }}"></script>
<script type="text/javascript">
	var lang = $('.langLink').text();
	if(lang === 'ENGLISH'){
		$('body').addClass('zh');
	}else{
		$('body').addClass('en');
	}
</script>
@endsection

