// tell Barba to use the prefetch module
barba.use(barbaPrefetch);
// Init Barba
barba.init({
    cacheIgnore: false,
    prefetchIgnore: false,
    timeout: 30000,
    transitions: [
        {
            // sync: true,
            // css classes will look like `.fade-xxx-[-xxx]`
            // name: 'fade',
            before({ current, next, trigger }) {
            },
            async leave({ current, next, trigger }) {
                const done = this.async();
                hamburgerNav();
                pageTransition();
                await delay(1000);
                done();
            },
            afterLeave({ current, next, trigger }) {
            },
            beforeEnter({ current, next, trigger }) {
            },
            enter({ current, next, trigger }) {
                hamburgerNav();
                // Slider Categories
                const swiper1 = new Swiper('.swiper1', {
                    // Optional parameters
                    direction: 'horizontal',
                    loop: true,
                    slidesPerView: 3,
                    spaceBetween: 20,

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
            },
			after({ current, next, trigger }) {
            },
        }
    ]
});