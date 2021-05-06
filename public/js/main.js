$(function(){

    //shrink header
    $(document).on("scroll", function(){

        if($(document).scrollTop() > 150){

            $('.navbar-dark').addClass('nav-stick-top');

        }else{

            $('.navbar-dark').removeClass('nav-stick-top');

        }

    });

    new WOW().init();

    //back to top
    var scrollTrigger = 100, // px
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('#back-to-top').addClass('show');
            } else {
                $('#back-to-top').removeClass('show');
            }
        };
    backToTop();
    $(window).on('scroll', function(){
        backToTop();
    });
    $('#back-to-top').on('click', function(e){
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });

    $('.btn-scroll').on('click', function(e){
        e.preventDefault();
        var position = $('.scrolly').offset().top - $('.navbar-expand-lg').height();;

        $('html,body').animate({
            scrollTop: position
        }, 700);
    });
    
	if($('.slider').length > 0){
        $('.slider').bxSlider({
            auto: true,
            preloadImages: 'all',
            controls: false,
            pause: 8000,
            onSliderLoad: function(){
                $('.slider > .items .scroll-down').eq(1).addClass('active-slide');
                $('.scroll-down.active-slide > .btn-scroll .text').addClass('wow fadeInDown');

                $('.scroll-down.active-slide > .btn-scroll .icon').addClass('wow fadeInUp');
                $('.scroll-down.active-slide > .btn-scroll .icon').attr('data-wow-delay', '.5s');
                new WOW().init();
            },
            onSlideAfter: function(currentSlideNumber, totalSlideQty, currentSlideHtmlObject){
                $('.active-slide').removeClass('active-slide');
                $('.slider > .items .scroll-down').eq(currentSlideHtmlObject + 1).addClass('active-slide');
                $('.scroll-down.active-slide > .btn-scroll .text').addClass('wow fadeInDown');

                $('.scroll-down.active-slide > .btn-scroll .icon').addClass('wow fadeInUp');
                $('.scroll-down.active-slide > .btn-scroll .icon').attr('data-wow-delay', '.5s');
                new WOW().init();
            },
            onSlideBefore: function(){
                $('.scroll-down.active-slide > .btn-scroll .text').removeClass('wow fadeInDown');
                $('.scroll-down.active-slide > .btn-scroll .icon').removeClass('wow fadeInUp');
                $('.scroll-down.active-slide > .btn-scroll .text').removeAttr('style');
                $('.scroll-down.active-slide > .btn-scroll .icon').removeAttr('style');
            }
        });
    }

    var contentWayPoint = function(){
        var i = 0;
        if($('.probootstrap-animate').length > 0 ){
            $('.probootstrap-animate').waypoint(function(direction){

                if(direction === 'down' && !$(this.element).hasClass('probootstrap-animated')){
                    i++;

                    $(this.element).addClass('item-animate');
                    setTimeout(function(){

                        $('body .probootstrap-animate.item-animate').each(function(k){
                            var el = $(this);
                            setTimeout( function () {
                                var effect = el.data('animate-effect');
                                if ( effect === 'fadeIn') {
                                    el.addClass('fadeIn probootstrap-animated');
                                } else if ( effect === 'fadeInLeft') {
                                    el.addClass('fadeInLeft probootstrap-animated');
                                } else if ( effect === 'fadeInRight') {
                                    el.addClass('fadeInRight probootstrap-animated');
                                } else if ( effect === 'fadeInDown') {
                                    el.addClass('fadeInDown probootstrap-animated');
                                } else {
                                    el.addClass('fadeInUp probootstrap-animated');
                                }
                                el.removeClass('item-animate');
                            },  k * 50, 'easeInOutExpo' );
                        });
                        
                    }, 50);
                    
                }

            }, { offset: '95%' });
        }
    };
    contentWayPoint();

    if($('#image-gallery').length > 0){
        $('#image-gallery').lightSlider({
            gallery: true,
            item: 1,
            thumbItem: 6,
            slideMargin: 0,
            speed: 500,
            auto: true,
            loop: true,
            controls: false,
            pause: 5000,
            onSliderLoad: function() {
                $('#image-gallery').removeClass('cS-hidden');
            }  
        });
    }

    if($('.food-beverages').length > 0){
        $('.food-beverages').owlCarousel({
            loop: false,
            rewind: true,
            autoplay: true,            
            autoplayTimeout: 9000,
            autoplayHoverPause: true,
            responsiveClass: true,
            dots: false,
            nav: true,
            navText: [
                '<i class="fas fa-fw fa-angle-left"></i>',
                '<i class="fas fa-fw fa-angle-right"></i>'
            ],
            margin: 20,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1200: {
                    items: 5
                }
            }
        });
    }

    if($('.each-food-beverages').length > 0){
        $('.each-food-beverages').owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,            
            autoplayTimeout: 9000,
            autoplayHoverPause: true,
            responsiveClass: true,
            dots: false,
            nav: true,
            navText: [
                '<i class="fas fa-fw fa-angle-left"></i>',
                '<i class="fas fa-fw fa-angle-right"></i>'
            ]
        });
    }

    $('.view').click(function(){
        var item = $(this).attr('id');

        $('#photo').modal('show');

        $.ajax({
            type: 'GET',
            url: base_url + '/api/photos/search',
            data: {"item": item},
            dataType: 'json',
            cache: false,

            beforeSend : function() {
                $('.preload').show();
                $('.modal-title').html("");
                $('.modal-body .img').attr('src', "");
                $('.modal-body .body').html("");
            },
            complete : function() {
                $('.preload').hide();
            },
            success : function(data){

                $('.modal-title').html(data.photo.title);
                $('.modal-body .img').attr('src', data.photo.image);
                $('.modal-body .body').html(data.photo.description);

            },
            error : function(){
                swal("Failed", "Unable to connect to server.", "error");
            }

        });

    });

    $(document).on('submit' , '#frmContact' , function(e){
    e.preventDefault();

        $.ajax({
            type : 'POST',
            url  : base_url + '/send-mail',
            data : $('#frmContact').serialize(),
            dataType : 'json',
            cache : false,

            beforeSend : function(){
                $('.ajax-msg').hide();
            },
            complete : function(){
            },
            success : function(data){

                if(data.status){

                    $('[name="type"]').val('');
                    $('[name="email"]').val('');
                    $('[name="name"]').val('');
                    $('[name="number"]').val('');
                    $('[name="message"]').val('');

                    $('.ajax-msg').show();
                    $('#msg').html(data.message);

                    setTimeout(function(){
                        $('.ajax-msg').fadeOut();
                    },5000);

                }else{

                    $('.ajax-msg').show();
                    var html = '';
                    html += '<div class="alert alert-danger">';
                    $(data.message).each(function(a, b){
                        html += b +'<br>';
                    });
                    html += '</div>';
                    $('#msg').html(html);

                    setTimeout(function(){
                        $('.ajax-msg').fadeOut();
                    },9000);
                }

            },
            error : function(){
                alert("Unable to connect to server. Please reload your page.");
            }

        });

        return false;

    });

});
