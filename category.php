<?php 
session_start();
require'admin/functions.php';?>
<?php
  // ambil data di url
  $slug = $_GET["slug"];
  $books = query("SELECT *, books.slug AS book_slug, categories.slug AS category_slug FROM books INNER JOIN categories ON books.category = categories.id_category WHERE categories.name = '$slug' ORDER BY id_books DESC");

//tombol cari di klik
if( isset($_POST["search"]) ) {
    $books = search($_POST["keyword"]);
}

$currentPage = $slug;

?>

    <?php require 'template/header.php' ?>

    <!-- All book section start -->
    <section id="allbook" class="py-32 lg:py-40 md:px-7">
        <div class="container mx-auto mb-10 px-4">
            <h1 class="text-darken text-4xl lg:text-5xl font-bold"><?= ucwords($slug) ?> <span class="text-primary">Books</span> :</h1>
        </div>
        <?php if($books == NULL) { ?>
            <div class="container mx-auto w-full px-4">
                <img src="dist/img/notfound.png" alt="" class="mx-auto w-full lg:w-1/2 h-1/2">    
                <h3 class="text-center text-darken font-bold text-lg md:text-xl">Sorry, there are no <?= $slug ?> category books yet.</h3>
            </div>
        <?php }else { ?>
        <div class="container mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-10 px-4">
            <?php foreach($books as $book) : ?>
            <a href="book.php?slug=<?= $book["book_slug"] ?>">
                <div class="group">
                    <div class="overflow-hidden rounded-lg shadow-lg">
                        <img src="dist/img/cover/<?= $book['cover'] ?>" alt="" class="w-full group-hover:scale-110 group-hover:rotate-3 transition duration-500 ease-in-out object-cover">
                    </div>
                    <h3 class="text-darken font-medium text-xl mt-2"><?= $book['title'] ?></h3>
                    <p class="text-sm text-dark"><?= $book['name'] ?></p>
                </div>
            </a>
            <?php endforeach; } ?>
        </div>
    </section>
    <!-- All book section end -->

    <?php require 'template/footer.php' ?>