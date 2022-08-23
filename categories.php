<?php
session_start();
require 'admin/functions.php';

$categories = query("SELECT * FROM categories ORDER BY id_category DESC");
$currentPage = 'categories';
?>

        <?php require 'template/header.php' ?>

        <!-- All book section start -->
        <div class="w-full h-48 bg-[#fab1b3] dark:bg-[#01060f] absolute -z-10 rounded-br-full"></div>
        <section id="categories" class="py-32 lg:py-40">
            <div class="container lg:px-7 mx-auto px-4 mb-10 lg:mb-20">
                <h1
                    class="text-darken dark:text-txtdark text-4xl lg:text-5xl font-bold text-center px-5 py-2 relative left-1/2 -translate-x-1/2 rounded-full bg-white w-fit shadow-md dark:bg-black">
                    All <span class="text-primary">Categories</span></h1>
            </div>
            <?php if($categories == NULL) { ?>
                <div class="container mx-auto w-full px-4">
                    <img src="dist/img/notfound.png" alt="" class="mx-auto w-full lg:w-1/2 h-1/2 rounded-xl">    
                    <h3 class="text-center text-darken font-bold text-lg md:text-xl dark:text-txtdark mt-2">Sorry, there are no categories yet.</h3>
                </div>
            <?php } else {?>
            <div class="container lg:px-7 mx-auto px-4 grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-16">
                <?php foreach($categories as $category) : ?>
                    <a href="category.php?slug=<?= $category['slug'] ?>" class="text-white bg-cover rounded-lg bg-center relative overflow-hidden">
                    <img src="dist/img/imgCategory/<?= $category['img'] ?>" alt="" class="absolute h-full w-full object-cover">
                        <div class="w-full h-full backdrop-brightness-50 rounded-lg px-5 pb-7">
                            <p class="py-7 lg:p-7 text-center font-semibold text-xl"><?= $category["name"] ?></p>
                            <hr>
                            <p class="text-base font-extralight text-center mt-5"><?= $category["description"] ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php } ?>
        </section>
        <!-- All book section end -->

        <?php require 'template/footer.php' ?>