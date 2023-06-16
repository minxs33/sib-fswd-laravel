jQuery(() => {
    $(".carousel").owlCarousel({
        items:1,
        // margin:10,
        lazyLoad:true,
        responsive: {
            768 : {
                nav: false,
                dots: true,
                autoplayHoverPause: false,
            },
            992 : {
                nav:true,
                dots:true,
                autoplayHoverPause:true,
            }
        },
        autoplay:true,
        autoplayTimeout:3000,
        loop: true,
    })

    $(".category-carousel").owlCarousel({
        margin:10,
        lazyLoad:true,
        stagePadding: false,
        responsive: {

       
            0: {
                items: 2,
                stagePadding: 15,
                nav: false,
                dots: false,
                autoplayHoverPause: false,
            },
            768 : {
                items: 3,
                stagePadding: 15,
                nav: false,
                dots: false,
                autoplayHoverPause: false,
            },
            992 : {
                items: 4,
                nav:true,
                slideBy: 2,
                dots:false,
                autoplayHoverPause:true,
            },
            1200 : {
                items: 6,
                nav:true,
                slideBy: 3,
                dots:false,
                autoplayHoverPause:true,
            }
        },
        // autoplay:true,
        // autoplayTimeout:3000,
        loop: false,
    })

})