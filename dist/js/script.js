// transition
function delay(n) {
    n = n || 2000;
    return new Promise((done) => {
        setTimeout(() => {
            done();
        }, n);
    });
}

function pageTransition() {
    var tl = gsap.timeline();
    tl.to(".loading-screen", {
        duration: 1.2,
        width: "100%",
        left: "0%",
        ease: "Expo.easeInOut",
    });

    tl.to(".loading-screen", {
        duration: 1,
        width: "100%",
        left: "100%",
        ease: "Expo.easeInOut",
        delay: 0.3,
    });
    tl.set(".loading-screen", { left: "-100%" });
}

// navbar fixed
window.onscroll = function() {
    const header = document.querySelector('header');
    const fixedNav = header.offsetTop;

    if(window.pageYOffset > fixedNav) {
        header.classList.add('navbar-fixed');
    } else {
        header.classList.remove('navbar-fixed');
    }
}

// hamburger
const hamburger = document.getElementById('hamburger');
const navMenu = document.getElementById('nav-menu');

function hamburgerNav() {
    hamburger.addEventListener('click', function() {
        this.classList.toggle('hamburger-active');
        navMenu.classList.toggle('hidden');
    });
}
hamburgerNav();

// Klik diluar hamburger
window.addEventListener('click', function(e) {
    if(e.target != hamburger && e.target != navMenu) {
        hamburger.classList.remove('hamburger-active');
        navMenu.classList.add('hidden');
    }
});

//scroll restoration
if ('scrollRestoration' in history) { 
    history.scrollRestoration = 'manual'; 
}

// Slider Categories
const swiper1 = new Swiper('.swiper1', {
    // Optional parameters
    direction: 'horizontal',
    slidesPerView: 3,
    spaceBetween: 20,
    autoHeight: true,
    breakpoints: {
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
    slidesPerView: 2,
    spaceBetween: 20,

    breakpoints: {
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

$(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
});

// Dark mode toggle
const darkToggle = document.getElementById('dark-toggle');
const html = document.querySelector('html');

darkToggle.addEventListener('click', function() {
    if (darkToggle.checked) {
        html.classList.add('dark');
        localStorage.theme = 'dark';
    }else {
        html.classList.remove('dark');
        localStorage.theme = 'light';
    }
});

// pindahkan posisi toggle sesuai mode

if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    darkToggle.checked = true;
} else {
    darkToggle.checked = false;
}

function modalBook() {
    // modal book
    const open = document.querySelector('#open');
    const modal_container = document.getElementById('modal_container');
    const close = document.getElementById('close');

    open.addEventListener('dblclick', () => {
        modal_container.classList.add('show');
    });

    close.addEventListener('click', () => {
        modal_container.classList.remove('show');
    });
    
}
