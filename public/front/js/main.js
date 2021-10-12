//選單切換
$(function() {  
    $(".menu-link").click(function(e) {
        e.preventDefault();
        			
        $(".menu-overlay").toggleClass("open");
        $(".menu-circle-bg").toggleClass("open");
        $(".menu").toggleClass("open");
        $(".fullContainer").toggleClass("open"); 
        $(".hits").toggleClass("open");
    });
    jinShanStart();
    pageHorSwiper();	
    // if ($(window).outerWidth() >= 768) {        
    //     pageHorSwiper();    
    // }
    setTimeout(function(){
		$('.loading').addClass('none');
	}, 1000); 
    

    isAndroid = (navigator.userAgent.match(/Android/i));
    isiPhone = (navigator.userAgent.match(/iPhone/i));
    isiPad = (navigator.userAgent.match(/iPad/i));
    isP = isAndroid || isiPhone;
    isM = isAndroid || isiPhone || isiPad;
    isApple = isiPhone || isiPad;
    if (isM) {
        $('.follower').addClass('none');
        $('body').addClass('phone');
        let vh = window.innerHeight * 0.01;        
        document.documentElement.style.setProperty('--vh', `${vh}px`);
        
        $(window).bind('orientationchange', function(e){
            reloadThePage();            
            let vh = window.innerHeight * 0.01;
            document.documentElement.style.setProperty('--vh', `${vh}px`);
        });
        window.addEventListener('resize', () => {
            let vh = window.innerHeight * 0.01;
            document.documentElement.style.setProperty('--vh', `${vh}px`);
        });  
    };
    if (isP) {        
        $('input').css("font-size", "1.2rem");
        $('select').css("font-size", "1.2rem");
        $('textarea').css("font-size", "1.2rem")     
    };
    if (isApple) {
        // $('input').css("font-size", "1.2rem");
        // $('select').css("font-size", "1.2rem");
        // $('textarea').css("font-size", "1.2rem")
    }
});

function reloadThePage(){    
    window.location.reload();
} 
//首頁動畫
//jinShanStart();
function jinShanStart() {    

    // SWIPER SETTINGS
    $('.swiper_gauge').addClass('active');
    var jinswiper = new Swiper('.jin_container', {
        autoplay: {
            delay: 5000,
        },
        autoplayDisableOnInteraction: false,
        disableOnInteraction: false,
        allowTouchMove: false,
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        speed: 1000,
        on: {
            slideChange: function() {
                $('.swiper_gauge').removeClass('active');
                $('.swiper_gauge').delay(100).queue(function(next) {
                    $(this).addClass('active');
                    next();
                });
            },
        },
        pagination: {
            el: '.jin_container .swiper-pagination',
            // clickable: true,
        },
    });
}


//內頁swiper
//內頁全
//pageHorSwiper();
function pageHorSwiper(){
    var swiper = new Swiper('.pageHorizontal .swiper-container', { 
        pagination: {
            el: '.pageHorizontal .swiper-pagination',
            type:'progressbar',
        },
        scrollbar: {
            //el: '.pageHorizontal .swiper-scrollbar',
            draggable: true,
            //snapOnRelease: false,
        },
        direction: 'horizontal',
        loop: false,
        slidesPerView:'auto',
        spaceBetween: 0,
        freeMode: true,
        // freeModeSticky: false,
        // freeModeMomentum: false,
        allowTouchMove: true,
        // simulateTouch:true,				
        mousewheel: true,
        mousewheel: {
            sensitivity : 0.4,
            //releaseOnEdges: true,
        },
        // on: { 
        //     onSlideChangeStart: function(swiperV) { //滑动父级需要激活滚轮事件
        //         swiperV.enableMousewheelControl();
        //     }     
        // }
        //grabCursor: true,
        observer:true,
        observeParents:true,
        breakpoints: {                         
            767: {
                direction: 'vertical',
                allowTouchMove: true,
            },
                
        },
        keyboard: {
            enabled: true,
        },
        hashNavigation: true,
        watchSlidesProgress : true,
        on:{
            progress: function(progress){
                const w = window.outerWidth*this.progress*0.615;
                const w1 = window.outerWidth*this.progress*0.615/200*360+40;
                const w2 = window.outerWidth*this.progress*0.615/167*360-40;
                //$(".rollEllip .tdt").text('dis:'+ w );
                $(".rollEllip").css('left', w);
                //$(".rollEllip").css('transform',`rotate(w)`;
                $(".rollEllip .ellipseBall1").css({ transform: 'rotate(' + w1 + 'deg)'});
                $(".rollEllip .ellipseBall2").css({ transform: 'rotate(' + w2 + 'deg)'});
                //console.log(this.progress);
                if(this.progress>0.7){
                    $(".mouseGuide").addClass('active');
                }else{
                    $(".mouseGuide").removeClass('active');
                }
            }, 
        },        
        
    });         

// //pageVerSwiper();
    //內文上下1
    // function pageVerSwiper(){
    var swiperV = new Swiper('.pageVertical .swiper-containerV', {         
        direction: 'vertical',
        autoplay:true,
        speed: 5000,
        autoplay: {            
            delay: 0,
            stopOnLastSlide: false,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.pageVertical .swiper-containerV .swiper-pagination',
            type:'progressbar',
        },
        loop: true,
        slidesPerView:'auto',
        spaceBetween: 0,
        freeMode: true,
        //allowTouchMove: true,				
        // mousewheel: true,
        // mousewheel: {
        //     sensitivity : 0.4,
        //     releaseOnEdges: true,
        // },
        nested: true,
        //grabCursor: true,        
        // on: {
        //     slideChangeTransitionStart: function () {
        //         swiper.mousewheel.disable();
        //     },
        //     slideChangeTransitionEnd: function () {
        //         swiper.mousewheel.enable();
        //     },
        //     slideChange: function() {  
        //         swiper.mousewheel.enable();              
        //     },
        //   } 
        breakpoints: {             
            767: {
                direction: 'horizontal',
            }
        },  
    });
    //內文上下2
    var swiperV2 = new Swiper('.pageVertical .swiper-containerV2', {         
        direction: 'vertical',
        autoplay:true,
        speed: 5000,
        autoplay: {            
            delay: 0,
            stopOnLastSlide: false,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.pageVertical .swiper-containerV2 .swiper-pagination',
            type:'progressbar',
        },
        loop: true,
        slidesPerView:'auto',
        spaceBetween: 0,
        freeMode: true,
        //allowTouchMove: true,				
        // mousewheel: true,
        // mousewheel: {
        //     sensitivity : 0.4,
        //     releaseOnEdges: true,
        // },
        nested: true,
        //grabCursor: true,        
        // on: {
        //     slideChangeTransitionStart: function () {
        //         swiper.mousewheel.disable();
        //     },
        //     slideChangeTransitionEnd: function () {
        //         swiper.mousewheel.enable();
        //     },
        //     slideChange: function() {                               
        //     },
        //   }
        breakpoints: {             
            767: {
                direction: 'horizontal',
            }
        },  
    });

    //產品上下
    var swiperProductV = new Swiper('.pageProVertical .swiper-containerV', {  
        direction: 'vertical',
        pagination: {
            el: '.pageProVertical .swiper-pagination',
            type:'progressbar',
        },               
        loop: false,
        slidesPerView:'auto',
        spaceBetween: 0,
        freeMode: true,
        allowTouchMove: true,
        // simulateTouch:true,				
        mousewheel: true,
        mousewheel: {
            sensitivity : 0.4,
            releaseOnEdges: true,
        }, 
        observer:true,
        observeParents:true,
        breakpoints: {                        
            767: {
                //mousewheel: false,
                allowTouchMove: false,
                pagination:false,
                freeMode: false,                
            }
        },
        // on: { 
        //     onSlideChangeStart: function(swiperV) { //滑动父级需要激活滚轮事件
        //         swiperV.enableMousewheelControl();
        //     }     
        // }       
    }); 


    // $(window).resize(function () {        
    //     if ($(window).outerWidth() >= 768) {        
    //         pageHorSwiper();    
    //     } else if ($(window).outerWidth() < 768) {          
    //         swiperProductV.destroy();
    //         swiper.destroy();
    //     }
    //   });
   
}

// 產品Parallax
(function() {
    "use strict";
    var app = {
        init: function() {            
            this.setUpListeners();
        },
        setUpListeners: function() {
            var hiwItem = document.querySelectorAll(".hiw-item");
            if (hiwItem.length) {
                hiwItem.forEach(function(item) {
                    item.addEventListener("mousemove", app.itemHit);
                    item.addEventListener("mouseleave", app.itemHitOut)
                })
            }
        },
        
        itemHit: function(e) {
            setTimeout(app.callParallaxHit.bind(null, e, this), 200)
        },
        itemHitOut: function(e) {
            setTimeout(app.callParallaxHitOut.bind(null, e, this), 200)
        },
        callParallaxHit: function(e, container) {
            app.parallaxHit(e, container, container.querySelector(".l-1 img"), -30);
            app.parallaxHit(e, container, container.querySelector(".l-3 img"), 30)
        },
        callParallaxHitOut: function(e, container) {
            app.parallaxHit(e, container, container.querySelector(".l-1 img"), 0);
            app.parallaxHit(e, container, container.querySelector(".l-3 img"), 0)
        },
        parallaxHit: function(e, container, target, movement) {
            var offset = container.getBoundingClientRect()
              , relX = e.pageX - (offset.left + window.scrollX)
              , relY = e.pageY - (offset.top + window.scrollY)
              , width = container.offsetWidth
              , height = container.offsetHeight;
            gsap.to(target, 1, {
                x: (relX - width / 2) / width * movement,
                y: (relY - height / 2) / height * movement,
                ease: Power2.easeOut
            })
        },
    }
    app.init()
}());

