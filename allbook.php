<?php 
session_start();
require'admin/functions.php';?>
<?php

//pagination
// config
$jumlahDataPerHalaman = 10;
$jumlahData = count(query("SELECT * FROM books"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET["page"])) ? $_GET["page"] : 1;

$awalData = ( $jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$books = query("SELECT *, books.slug AS book_slug, categories.slug AS category_slug FROM books INNER JOIN categories ON books.category = categories.id_category ORDER BY id_books DESC LIMIT $awalData, $jumlahDataPerHalaman");
$currentPage = 'all_books';

//tombol cari di klik
if( isset($_POST["search"]) ) {
    $books = search($_POST["keyword"]);
}

?>

    <?php require 'template/header.php' ?>

    <main data-barba="container" data-barba-namespace="home">

        <!-- All book section start -->
        <section id="allbook" class="py-32 lg:py-40">
            <div class="container mx-auto mb-10 px-4 lg:px-7">
                <h1 class="text-darken text-4xl lg:text-5xl font-bold dark:text-txtdark">All <span
                        class="text-primary">Books</span> :</h1>
                <form action="" method="POST" class="relative">
                    <input type="text" name="keyword" id="search"
                        class="bg-white rounded-full w-full shadow-lg mt-10 p-6 text-sm lg:text-base border lg:border-none"
                        placeholder="Search books, author, categories ..." autofocus autocomplete="off">
                    <input type="submit"
                        class="cursor-pointer px-6 py-2 rounded-full bg-primary text-base lg:text-lg text-white absolute top-1/2 right-[30px]" name="search" value="Search">
                </form>
            </div>
            <?php if($books == NULL) { ?>
                <div class="container mx-auto w-full px-4">
                    <img src="dist/img/notfound.png" alt="" class="mx-auto w-full lg:w-1/2 h-1/2 rounded-xl">    
                    <h3 class="text-center text-darken font-bold text-lg md:text-xl dark:text-txtdark mt-2">Sorry, there are no books yet.</h3>
                </div>
            <?php } ?>
            <div class="container mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-10 px-4 lg:px-7">
                <?php foreach($books as $book) : ?>
                    <a href="book.php?slug=<?= $book["book_slug"] ?>">
                        <div class="group">
                            <div class="overflow-hidden rounded-lg shadow-lg">
                                <img src="dist/img/cover/<?= $book['cover'] ?>" alt="" class="w-full group-hover:scale-110 group-hover:rotate-3 transition duration-500 ease-in-out object-cover">
                            </div>
                            <h3 class="text-darken dark:text-txtdark font-medium text-lg lg:text-xl mt-2"><?= $book['title'] ?></h3>
                            <p class="text-sm text-dark"><?= $book['name'] ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="container mx-auto flex justify-center gap-1 items-center mt-10">
                <?php if($halamanAktif > 1 ) :?>
                    <a href="?page=<?= $halamanAktif - 1?>" class="px-4 py-2 bg-darken dark:border-white text-primary rounded-lg shadow-md">&laquo;</a>
                <?php endif;?>
                <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                    <?php if( $i == $halamanAktif) : ?>
                        <a href="?page=<?= $i ?>" class="px-4 py-2 bg-primary text-white rounded-lg shadow-lg font-bold border-2 border-darken dark:border-white"><?= $i ?></a>
                    <?php else :?>
                        <a href="?page=<?= $i ?>" class="px-4 py-2 bg-primary text-white rounded-lg shadow-md"><?= $i ?></a>
                    <?php endif; ?>
                <?php endfor; ?>
                <?php if($halamanAktif < $jumlahHalaman ) :?>
                    <a href="?page=<?= $halamanAktif + 1?>" class="px-4 py-2 bg-darken text-primary rounded-lg shadow-md">&raquo;</a>
                <?php endif;?>
            </div>
        </section>
        <!-- All book section end -->

        <?php require 'template/footer.php' ?>