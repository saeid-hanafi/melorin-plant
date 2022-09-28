// Start Swiper Products Slider
var swiper = new Swiper(".product-slider", {
    slidesPerView: 4,
    grid: {
        rows: 2,
    },
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    spaceBetween: 5,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});
// End Swiper Products Slider