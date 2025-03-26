const swiper = new Swiper('.swiper', {
    // Show multiple slides at once
    slidesPerView: 3,
    spaceBetween: 30,
    
    // Center the active slide
    centeredSlides: true,
    
    // Autoplay
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    
    // Different transition effects
    effect: 'coverflow', // try 'fade', 'cube', 'flip', etc.
    coverflowEffect: {
        rotate: 30,
        slideShadows: false,
    },
    
    // Keyboard control
    keyboard: {
        enabled: true,
    },
    
    // Mousewheel control
    mousewheel: {
        invert: true,
    },
});