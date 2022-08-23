<?php 
  session_start();
  require 'admin/functions.php';
  
  $books = query("SELECT *, books.slug AS book_slug, categories.slug AS category_slug FROM books INNER JOIN categories ON books.category = categories.id_category ORDER BY id_books DESC");
  $categories = query("SELECT * FROM categories ORDER BY id_category DESC");
  $currentPage = 'home';
  $popularBooksHero = query("SELECT *, books.slug AS book_slug FROM books ORDER BY total_comment DESC LIMIT 1");
  $popularBooks = query("SELECT *, books.slug AS book_slug FROM books INNER JOIN categories ON categories.id_category = books.category ORDER BY total_comment DESC");

  //tombol cari di klik
  if( isset($_POST["search"]) ) {
    $books = search($_POST["keyword"]);
  }
?>

        <?php require 'template/header.php' ?>

        <!-- Hero section start -->
        <section id="hero" class="py-32 lg:py-40">
            <div
                class="container px-4 md:px-7 mx-auto flex-col-reverse flex lg:flex-row justify-between gap-5 md:gap-10 lg:gap-20 relative">
                <div class="w-full">
                    <p class="text-dark uppercase text-lg dark:text-txtdark">Read with desire</p>
                    <h1 class="text-darken text-5xl lg:text-6xl xl:text-7xl font-bold mt-7 dark:text-txtdark">
                        Transforming
                        Live <span class="text-primary dark:text-primary">Enriching Future</span>
                    </h1>
                    <p class="text-lg text-dark mt-4 dark:text-txtdark">Knowledge is a seed that grows when you read.
                    </p>
                    <form action="allbook.php" method="POST" class="relative">
                        <input type="text" name="keyword" id="search"
                            class="bg-white rounded-full w-full shadow-lg mt-10 p-6 text-sm lg:text-base border lg:border-0"
                            placeholder="Search books, author, categories ..." autocomplete="off">
                        <input type="submit"
                            class="cursor-pointer px-6 py-2 rounded-full bg-primary text-base lg:text-lg text-white absolute top-1/2 right-[30px]"
                            value="Search" name="search">
                    </form>
                    <div class="mt-14 w-full xl:w-[60%]">
                        <p class="text-dark uppercase mb-3 dark:text-white">Popular books</p>
                        <?php if($popularBooksHero == NULL) { ?>
                            <p class="text-darken dark:text-txtdark mt-5">Sorry, there are no books yet.</p>
                        <?php } else { ?>
                        <div class="flex gap-4 items-center">
                            <?php foreach($popularBooksHero as $popular) : ?>
                            <img src="dist/img/cover/<?= $popular['cover'] ?>" alt="" class="w-28 h-36">
                            <div class="">
                                <h5 class="text-lg text-darken font-medium dark:text-white">Read - <br>You'd be
                                    surprised what You find</h5>
                                <p class="text-sm text-dark dark:text-txtdark">From top - comment books</p>
                            </div>
                            <a href="book.php?slug=<?= $popular['book_slug'] ?>" class="ml-3 py-2 px-3 rounded-full bg-primary"><i
                                    class="fa-solid fa-arrow-right text-white text-3xl"></i></a>
                            <?php endforeach; ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="w-full  lg:block">
                    <img src="dist/img/hero.png" alt="" class="">
                </div>
            </div>
        </section>
        <!-- Hero section end -->

        <!-- Category books section start -->
        <section id="category" class="pb-28 lg:pb-32">
            <div class="container px-4 lg:px-7 mx-auto">
                <div class="flex justify-between items-center">
                    <h1 class="text-darken text-4xl font-bold dark:text-white">Book <span
                            class="text-primary">Categories</span></h1>
                    <a href="categories.php" class="text-dark">View All <i class="fa-solid fa-arrow-right"></i></a>
                </div>
                <?php if($categories == NULL) { ?>
                    <div class="w-full">
                        <p class="text-center text-darken dark:text-txtdark mt-5">Sorry, there are no categories yet.</p>
                    </div>
                <?php }else { ?>
                <div class="swiper1 mt-10">
                    <div class="swiper-wrapper">
                        <?php foreach($categories as $category) : ?>
                            <div class="category swiper-slide overflow-hidden">
                                <a href="category.php?slug=<?= $category["slug"] ?>" class="absolute text-white text-medium w-full h-20 bg-cover rounded-lg"><p class="backdrop-brightness-50 rounded-lg h-20 px-2 py-7 lg:p-7"><?= $category["name"] ?></p></a>
                                <img src="dist/img/imgCategory/<?= $category["img"]?>" alt="" class="w-96 h-20 rounded-lg -z-10 object-cover object-center overflow-hidden">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>
        <!-- Category books section end-->

        <!-- popular books section start -->
        <section id="category" class="pb-28 lg:pb-32">
            <div class="container px-4 lg:px-7 mx-auto">
                <div class="flex justify-between items-center">
                    <h1 class="text-darken text-4xl font-bold dark:text-white">Popular <span
                            class="text-primary">Books</span></h1>
                    <a href="allbook.php" class="text-dark">View All <i
                            class="fa-solid fa-arrow-right"></i></a>
                </div>
                <?php if($popularBooks == NULL) { ?>
                    <div class="w-full">
                        <p class="text-center text-darken dark:text-txtdark mt-5">Sorry, there are no books yet.</p>
                    </div>
                <?php }else { ?>
                <div class="swiper2 mt-10">
                    <div class="swiper-wrapper">
                        <?php foreach($popularBooks as $book) : ?>
                            <a href="book.php?slug=<?= $book["book_slug"] ?>" class="swiper-slide">
                                <div class="group">
                                    <div class="overflow-hidden rounded-lg shadow-lg">
                                        <img src="dist/img/cover/<?= $book["cover"]?>" alt="" class="w-full group-hover:scale-110 group-hover:rotate-3 transition duration-500 ease-in-out object-cover">
                                    </div>
                                    <h3 class="text-darken dark:text-txtdark font-medium text-lg lg:text-xl mt-2"><?= $book["title"]?></h3>
                                    <p class="text-sm text-dark"><?= $book["name"]?></p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>
        <!-- popular books section end-->

        <!-- new release books section start -->
        <section id="category" class="pb-32 lg:pb-38">
            <div class="container px-4 lg:px-7 mx-auto">
                <div class="flex justify-between items-center">
                    <h1 class="text-darken text-4xl font-bold dark:text-white">New <span
                            class="text-primary">Release</span></h1>
                    <a href="allbook.php" class="text-dark">View All <i
                            class="fa-solid fa-arrow-right"></i></a>
                </div>
                <?php if($books == NULL) {  ?>
                    <div class="w-full">
                        <p class="text-center text-darken dark:text-txtdark mt-5">Sorry, there are no books yet.</p>
                    </div>
                <?php }else { ?>
                <div class="swiper2 mt-10">
                    <div class="swiper-wrapper">
                        <?php foreach($books as $book) : ?>
                            <a href="book.php?slug=<?= $book["book_slug"] ?>" class="swiper-slide">
                                <div class="group">
                                    <div class="overflow-hidden rounded-lg shadow-lg">
                                        <img src="dist/img/cover/<?= $book["cover"]?>" alt="" class="w-full group-hover:scale-110 group-hover:rotate-3 transition duration-500 ease-in-out object-cover">
                                    </div>
                                    <h3 class="text-darken dark:text-txtdark font-medium text-lg lg:text-xl mt-2"><?= $book["title"]?></h3>
                                    <p class="text-sm text-dark"><?= $book["name"]?></p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>
        <!-- new release books section end-->

        <?php require 'template/footer.php' ?>