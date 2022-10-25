$(window).scroll(function () {
    if ($(this).scrollTop() >= 133) {
        $('.search_top').addClass('d-show');
        $('.logo_menu_d').addClass('d-show');
    } else {
        $('.search_top').removeClass('d-show');
        $('.logo_menu_d').removeClass('d-show');
    }
});
$('.search_top').click(function (){
        $("html, body").animate({ scrollTop: "0" });
})
$('.search_992').click(function (){
        $("html, body").animate({ scrollTop: "0" });
        if($('.position-992-absolute').hasClass('d-none'))
        {
            $('.position-992-absolute').removeClass('d-none')
        }
        else
        {
            $('.position-992-absolute').addClass('d-none')
        }
})

// menu js
document.addEventListener("DOMContentLoaded", function(){
// make it as accordion for smaller screens
    if (window.innerWidth > 992) {

        document.querySelectorAll('.navbar .nav-item').forEach(function(everyitem){

            everyitem.addEventListener('mouseover', function(e){

                let el_link = this.querySelector('a[data-bs-toggle]');

                if(el_link != null){
                    let nextEl = el_link.nextElementSibling;
                    el_link.classList.add('show');
                    // nextEl.classList.add('show');
                }

            });
            everyitem.addEventListener('mouseleave', function(e){
                let el_link = this.querySelector('a[data-bs-toggle]');

                if(el_link != null){
                    let nextEl = el_link.nextElementSibling;
                    el_link.classList.remove('show');
                    // nextEl.classList.remove('show');
                }


            })
        });

    }
// end if innerWidth
});

$('.navbar-toggler').click(function (){
    if($('.navbar-collapse').hasClass('show'))
    {
        $('.navbar-collapse').removeClass('show')
        $('.menu_svg').removeClass('fa-xmark')
        $('.menu_svg').addClass('fa-bars')
    }
    else
    {
        $('.navbar-collapse').addClass('show')
        $('.menu_svg').removeClass('fa-bars')
        $('.menu_svg').addClass('fa-xmark')
    }
})
$('.menu_in_a').click(function (){
    var key=$(this).attr('data-key')
    if($('.dropdown-menu-'+key).hasClass('show'))
    {
        $('.dropdown-menu-'+key).removeClass('show')
        $('.menu_in_svg_'+key).removeClass('fa-rotate-90')
    }
    else
    {
        $('.dropdown-menu-'+key).addClass('show')
        $('.menu_in_svg_'+key).addClass('fa-rotate-90')
    }
})
$('.menu_in_svg').click(function (){
    var key=$(this).attr('data-key')
    if($('.dropdown-menu-'+key).hasClass('show'))
    {
        $('.dropdown-menu-'+key).removeClass('show')
    }
    else
    {
        $('.dropdown-menu-'+key).addClass('show')
    }
})

//slider_single
{
    var swiper = new Swiper(".mySwiper.slider_single", {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".slider_single .swiper-button-next",
            prevEl: ".slider_single .swiper-button-prev",
        },
    });
}


//slider vip product
var swiper = new Swiper(".mySwiper.product_vip", {
    slidesPerView: 1,
    spaceBetween: 0,
    slidesPerGroup: 1,
    loop: false,
    autoplay: {
        delay: 10000,
        disableOnInteraction: false,
    },
    // loopFillGroupWithBlank: true,
    navigation: {
        nextEl: ".product_vip .swiper-button-next",
        prevEl: ".product_vip .swiper-button-prev",
    },
    breakpoints: {
        // when window width is >= 200px
        200: {
            slidesPerView: 1,
            spaceBetween: 0,
            slidesPerGroup: 1,
        },
        // when window width is >= 375px
        375: {
            slidesPerView: 1.7,
            spaceBetween: 0,
            slidesPerGroup: 1,
        },
        // when window width is >= 480px
        480: {
            slidesPerView: 2,
            spaceBetween: 0,
            slidesPerGroup: 1,
        },
        // when window width is >= 576px
        576: {
            slidesPerView: 2,
            spaceBetween: 0,
            slidesPerGroup: 1,
        },
        // when window width is >= 768px
        768: {
            slidesPerView: 3,
            spaceBetween: 0,
            slidesPerGroup: 2,
        },
        // when window width is >= 992px
        992: {
            slidesPerView: 4,
            spaceBetween: 0,
            slidesPerGroup: 2,
        },
        // when window width is >= 1200px
        1200: {
            slidesPerView: 5,
            spaceBetween: 0,
            slidesPerGroup: 3,
        },
    }
});

//slider category
var swiper = new Swiper(".mySwiper.category", {
    slidesPerView: 2,
    spaceBetween: 0,
    slidesPerGroup: 1,
    loop: false,
    autoplay: {
        delay: 10000,
        disableOnInteraction: false,
    },
    // loopFillGroupWithBlank: true,
    navigation: {
        nextEl: ".category .swiper-button-next",
        prevEl: ".category .swiper-button-prev",
    },
    breakpoints: {
        // when window width is >= 480px
        480: {
            slidesPerView: 2,
            spaceBetween: 0,
            slidesPerGroup: 1,
        },
        // when window width is >= 576px
        576: {
            slidesPerView: 3,
            spaceBetween: 0,
            slidesPerGroup: 1,
        },
        // when window width is >= 768px
        768: {
            slidesPerView: 4,
            spaceBetween: 0,
            slidesPerGroup: 2,
        },
        // when window width is >= 992px
        992: {
            slidesPerView: 6,
            spaceBetween: 0,
            slidesPerGroup: 2,
        },
        // when window width is >= 1200px
        1200: {
            slidesPerView: 8,
            spaceBetween: 0,
            slidesPerGroup: 3,
        },
    }
});

//slider new product
var swiper = new Swiper(".mySwiper.product_new", {
    slidesPerView: 1,
    spaceBetween: 0,
    slidesPerGroup: 1,
    autoplay: {
        delay: 10000,
        disableOnInteraction: false,
    },
    loop: false,
    // loopFillGroupWithBlank: true,
    navigation: {
        nextEl: ".product_new .swiper-button-next",
        prevEl: ".product_new .swiper-button-prev",
    },
    breakpoints: {
        // when window width is >= 200px
        200: {
            slidesPerView: 1,
            spaceBetween: 0,
            slidesPerGroup: 1,
        },
        // when window width is >= 375px
        375: {
            slidesPerView: 1.7,
            spaceBetween: 0,
            slidesPerGroup: 1,
        },
        // when window width is >= 480px
        480: {
            slidesPerView: 2,
            spaceBetween: 0,
            slidesPerGroup: 1,
        },
        // when window width is >= 576px
        576: {
            slidesPerView: 2,
            spaceBetween: 0,
            slidesPerGroup: 1,
        },
        // when window width is >= 768px
        768: {
            slidesPerView: 3,
            spaceBetween: 0,
            slidesPerGroup: 2,
        },
        // when window width is >= 992px
        992: {
            slidesPerView: 5,
            spaceBetween: 0,
            slidesPerGroup: 2,
        },
        // when window width is >= 1200px
        1200: {
            slidesPerView: 6,
            spaceBetween: 0,
            slidesPerGroup: 3,
        },
    }
});
//slider seen product
var swiper = new Swiper(".mySwiper.product_seen", {
    slidesPerView: 1,
    spaceBetween: 0,
    slidesPerGroup: 1,
    loop: false,
    autoplay: {
        delay: 10000,
        disableOnInteraction: false,
    },
    // loopFillGroupWithBlank: true,
    navigation: {
        nextEl: ".product_seen .swiper-button-next",
        prevEl: ".product_seen .swiper-button-prev",
    },
    breakpoints: {
        // when window width is >= 200px
        200: {
            slidesPerView: 1,
            spaceBetween: 0,
            slidesPerGroup: 1,
        },
        // when window width is >= 375px
        375: {
            slidesPerView: 1.7,
            spaceBetween: 0,
            slidesPerGroup: 1,
        },
        // when window width is >= 480px
        480: {
            slidesPerView: 2,
            spaceBetween: 0,
            slidesPerGroup: 1,
        },
        // when window width is >= 576px
        576: {
            slidesPerView: 2,
            spaceBetween: 0,
            slidesPerGroup: 1,
        },
        // when window width is >= 768px
        768: {
            slidesPerView: 3,
            spaceBetween: 0,
            slidesPerGroup: 2,
        },
        // when window width is >= 992px
        992: {
            slidesPerView: 5,
            spaceBetween: 0,
            slidesPerGroup: 2,
        },
        // when window width is >= 1200px
        1200: {
            slidesPerView: 6,
            spaceBetween: 0,
            slidesPerGroup: 3,
        },
    }
});

//slider blog
var swiper = new Swiper(".mySwiper.blog", {
    slidesPerView: 1,
    spaceBetween: 0,
    slidesPerGroup: 1,
    loop: false,
    // loopFillGroupWithBlank: true,
    autoplay: {
        delay: 10000,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: ".blog .swiper-button-next",
        prevEl: ".blog .swiper-button-prev",
    },
    breakpoints: {

        // when window width is >= 576px
        576: {
            slidesPerView: 2,
            spaceBetween: 0,
            slidesPerGroup: 1,
        },
        // when window width is >= 768px
        768: {
            slidesPerView: 3,
            spaceBetween: 0,
            slidesPerGroup: 1,
        },
        // when window width is >= 992px
        992: {
            slidesPerView: 4,
            spaceBetween: 0,
            slidesPerGroup: 1,
        },
    }
});
