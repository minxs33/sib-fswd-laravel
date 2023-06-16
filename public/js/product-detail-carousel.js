document.addEventListener('DOMContentLoaded',function(){
var main = new Splide('#main-slider',{
    type: 'fade',
    rewind: true,
    pagination: true,
    arrows: false,
});

var thumbnails = new Splide('#thumbnail-slider',{
    fixedWidth: 100,
    fixedHeight: 60,
    gap: 10,
    rewind: true,
    pagination: false,
    isNavigation: true,
    breakpoints: {
        576: {
            arrows: false,
            Width : 60,
            Height: 44,
        },
        768 : {
            arrows: false,
            Width : 70,
            Height: 54,
        },
    },
    arrows: true,
});

main.sync(thumbnails);
main.mount();
thumbnails.mount();

});