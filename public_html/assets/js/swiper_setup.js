var swiper = new Swiper('.swiper-container', {
    slidesPerView: 5,
    spaceBetween: 18,
    navigation: {
        nextEl: '.product-slider__button--next',
        prevEl: '.product-slider__button--prev',
    },
    breakpoints: {
        320: {
            slidesPerView: 1,
            spaceBetween: 12,
        },
        480: {
            slidesPerView: 2,
            spaceBetween: 12,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 14,
        },
        960: {
            slidesPerView: 4,
            spaceBetween: 16,
        }
    },
});