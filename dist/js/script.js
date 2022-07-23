// navbar fixed
window.onscroll = function() {
    const header = document.querySelector('header');
    const fixedNav = header.offsetTop;
    const toTop = document.getElementById('toTop');

    if(window.pageYOffset > fixedNav) {
        header.classList.add('navbar-fixed');
        toTop.classList.remove('hidden');
        toTop.classList.add('flex');
    } else {
        header.classList.remove('navbar-fixed');
        toTop.classList.remove('flex');
        toTop.classList.add('hidden');
    }
}

// hamburger
const hamburger = document.getElementById('hamburger');
const navMenu = document.getElementById('nav-menu');

hamburger.addEventListener('click', function() {
    hamburger.classList.toggle('hamburger-active');
    navMenu.classList.toggle('hidden');
});

// Klik diluar hamburger
window.addEventListener('click', function(e) {
    if(e.target != hamburger && e.target != navMenu) {
        hamburger.classList.remove('hamburger-active');
        navMenu.classList.add('hidden');
    }
});

// Slider Categories
const swiper1 = new Swiper('.swiper1', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,

    breakpoints: {
        // when window width is >= 320px
        480: {
          slidesPerView: 3,
          spaceBetween: 20
        },
        // when window width is >= 640px
        640: {
          slidesPerView: 4,
          spaceBetween: 40
        },

        1080: {
          slidesPerView: 6,
          spaceBetween: 40
        }
    }
});

// Slider Categories
const swiper2 = new Swiper('.swiper2', {
    // Optional parameters
    direction: 'horizontal',

    breakpoints: {
        // when window width is >= 320px
        480: {
          slidesPerView: 2,
          spaceBetween: 20
        },
        // when window width is >= 640px
        640: {
          slidesPerView: 3,
          spaceBetween: 40
        },

        1080: {
          slidesPerView: 5,
          spaceBetween: 40
        }
    }
});