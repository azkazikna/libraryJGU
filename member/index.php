<?php 
session_start();
$currentPage = 'home';
include'template/header.php';?>
<?php
require'functions.php';

if( !isset($_SESSION["login"]) || $_SESSION["role"] == "admin" || $COOKIE["role"] == "admin") {
    header("Location: ../login.php");
}

$books = query("SELECT *, books.description AS book_description, categories.description AS category_description FROM books INNER JOIN categories ON books.category = categories.id_category INNER JOIN users ON books.id_user = $id_user ORDER BY id_books DESC");
$jumlahBukuUser = count(query("SELECT * FROM transactions INNER JOIN users ON transactions.code_member = users.code_member WHERE id_user = $id_user"));
$bukuUser = query("SELECT *, books.slug as 'book_slug' FROM transactions INNER JOIN users ON transactions.code_member = users.code_member INNER JOIN books ON transactions.code_book = books.code_book INNER JOIN categories ON books.category = categories.id_category WHERE users.id_user = $id_user");
?>
<?php include'template/sidebar.php';?>

<!-- main content start -->
<section class="dashboard">
        <div class="flex justify-center flex-col lg:flex-row gap-5 items-center">
            <div class="text w-full">
                <p class="text-dark text-md">Dashboard</p>
                <h1 class="text-darken text-5xl font-bold">Overview</h1>
            </div>
            <div class="w-full">
                <div class="bg-white shadow-lg py-5 px-5 rounded-xl flex justify-between items-center">
                    <div class="text">
                        <h2 class="text-3xl font-bold text-darken"><?= $jumlahBukuUser ?></h2>
                        <h4 class="text-darken">Your Books</h4>
                    </div>
                    <i class="fa-solid fa-book text-darken text-5xl"></i>
                </div>
            </div>
        </div>
        <hr class="my-8">
        <div class="flex gap-5 flex-col lg:flex-row">
            <div class="chart bg-white shadow-lg p-4 lg:p-7 rounded-xl w-full">
                <h1 class="text-darken font-bold text-2xl">Your <span class="text-primary">Books</span></h1>
                <hr class="my-3">
                <?php if($bukuUser == NULL) { ?>
                    <img src="../dist/img/notfound.png" alt="" class="mx-auto w-64 md:w-96">    
                    <h3 class="text-center text-darken font-bold text-lg md:text-xl">Sorry, no books are currently borrowed.</h3>
                <?php } ?>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-10">
                    <?php foreach($bukuUser as $book) : ?>
                        <a href="../book.php?slug=<?= $book["book_slug"] ?>">
                            <div class="group relative">
                                <div class="overflow-hidden rounded-lg shadow-lg">
                                    <img src="../dist/img/cover/<?= $book["cover"] ?>" alt="" class="w-full group-hover:scale-110 group-hover:rotate-3 transition duration-500 ease-in-out object-cover">
                                </div>
                                <span class="bg-primary text-white text-xs py-1 px-2 rounded-br-lg absolute top-4"><?= $book["name"] ?></span>
                                <h3 class="text-darken dark:text-txtdark font-medium text-lg lg:text-xl mt-2 leading"><?= $book['title'] ?></h3>
                                <p class="text-sm text-dark dark:text-txtdark">Borrow date : <?= $book["transaction_date"] ?></p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    
    <!-- main content end -->
      

<?php include 'template/footer.php'; ?>