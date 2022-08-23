<!-- footer start -->
<footer class="py-8 bg-primary dark:bg-bgdarken">
    <div class="container mx-auto px-4">
        <p class="text-white text-center">&copy; <a href="https://azkazikna.github.io/" class="font-bold">Azkazikna Ageung Laksana</a> 2022. All rights reserved</p>
    </div>
</footer>
<!-- footer end -->

</main>

<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!-- Barba JS -->
<script src="https://unpkg.com/@barba/core"></script>
<script src="https://cdn.jsdelivr.net/npm/@barba/prefetch@2.1.10/dist/barba-prefetch.umd.min.js"></script>
<!-- GSAP -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
<!-- Swiper Slider -->
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<!-- Custom Javascript -->
<script src="dist/js/script.js"></script>
<!-- transition javascript -->
<script src="dist/js/transition.js"></script>
<!-- Profile javascript -->
<?php if(@$_COOKIE["key"] != NULL || @$_SESSION["fullname"] != NULL) {?>
    <script>
    // profile nav
    const profile = document.getElementById('profile');
    const navProfile = document.getElementById('profileMenu');

    function profileNav() {
        profile.addEventListener('click', function() {
            navProfile.classList.toggle('hidden');
        });
    }
    profileNav();
    </script>
<?php } ?>

</body>

</html>