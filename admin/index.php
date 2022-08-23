<?php 
session_start();
$currentPage = 'home';
include'template/header.php';?>
<?php
require'functions.php';

if( !isset($_SESSION["login"]) ) {
    header("Location: ../login.php");
}

if ($_SESSION["role"] == "member") {
    header("Location: ../login.php");
}

$books = query("SELECT *, books.description AS book_description, categories.description AS category_description FROM books INNER JOIN categories ON books.category = categories.id_category INNER JOIN users ON books.id_user = $id_user ORDER BY id_books DESC");
$jumlahBuku = count(query("SELECT * from books"));
$jumlahBukuUser = count(query("SELECT * from users WHERE users.role = 'member' "));
$jumlahKategori = count(query("SELECT * from categories"));
$comments = query("SELECT *, books.slug AS book_slug FROM comments 
INNER JOIN books ON books.id_books = comments.id_book INNER JOIN categories ON categories.id_category = books.category INNER JOIN users ON users.id_user = comments.id_user ORDER BY id_comment DESC LIMIT 5");
$categoryName = query("SELECT * FROM categories");
$topUsers = query("SELECT * FROM users ORDER BY total_comment DESC");

?>
<?php include'template/sidebar.php';?>

<!-- main content start -->
<section class="dashboard">
        <div class="flex justify-center flex-col lg:flex-row gap-5 items-center">
            <div class="text w-full">
                <p class="text-dark text-md">Dashboard</p>
                <h1 class="text-darken text-5xl font-bold">Overview</h1>
            </div>
            <div class="statistik w-full">
                <div class="bg-white shadow-lg py-5 px-5 rounded-xl flex justify-between items-center">
                    <div class="text">
                        <h2 class="text-3xl font-bold text-darken"><?= $jumlahBukuUser ?></h2>
                        <h4 class="text-darken">Members</h4>
                    </div>
                    <i class="fa-solid fa-user text-darken text-5xl"></i>
                </div>
            </div>
            <div class="statistik w-full ">
                <div class="bg-white shadow-lg py-5 px-5 rounded-xl flex justify-between items-center">
                    <div class="text">
                        <h2 class="text-3xl font-bold text-darken"><?= $jumlahBuku ?></h2>
                        <h4 class="text-darken">Published Books</h4>
                    </div>
                    <i class="fa-solid fa-book text-darken text-5xl"></i>
                </div>
            </div>
            <div class="statistik w-full">
                <div class="bg-white shadow-lg py-5 px-5 rounded-xl flex justify-between items-center">
                    <div class="text">
                        <h2 class="text-3xl font-bold text-darken"><?= $jumlahKategori ?></h2>
                        <h4 class="text-darken">Categories</h4>
                    </div>
                    <i class="fa-solid fa-book text-darken text-5xl"></i>
                </div>
            </div>
        </div>
        <hr class="my-8">
        <div class="flex gap-5 flex-col lg:flex-row">
            <div class="chart bg-white shadow-lg p-4 lg:p-7 rounded-xl w-full lg:w-[60%] xl:w-[70%]">
                <h1 class="text-darken font-bold text-2xl">Statistic of <span class="text-primary">Books</span></h1>
                <hr class="my-3">
                <canvas id="booksChart" height="100"></canvas>
            </div>
            <div class="topUsers w-full lg:w-[40%] xl:w-[30%] bg-white shadow-lg p-4 lg:p-7 rounded-xl">
                <h1 class="text-darken font-bold text-2xl">Top <span class="text-primary">Users</span></h1>
                <hr class="my-3">
                <div class="flex flex-col">
                    <?php foreach($topUsers as $user) : ?>
                        <a href="profile.html">
                            <div class="flex gap-3 items-center mb-5">
                                <img src="../dist/img/imgMember/<?= $user['img_member'] ?>" alt="" class="w-16 h-16 rounded-full object-cover object-top border-2 border-primary">
                                <div class="text">
                                    <h6 class="text-darken font-semibold"><?= $user['fullname'] ?></h6>
                                    <p class="text-sm text-dark">Total Comment: <?= $user['total_comment'] ?></p>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="w-full bg-white shadow-lg p-4 lg:p-7 rounded-xl mt-5">
            <h1 class="text-darken font-bold text-2xl">Latest <span class="text-primary">Comment</span></h1>
            <hr class="my-3">
            <table class="text-darken w-full" id="table_comment">
                <thead>
                    <tr>
                        <th class="text-start px-1 lg:px-7 pb-2">Name</th>
                        <th class="text-start px-1 lg:px-7 pb-2">Comments</th>
                        <th class="text-start px-1 lg:px-7 pb-2">Book</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($comments as $comment) : ?>
                        <tr class="border-b border-dark">
                            <td class="px-1 lg:px-7 py-2">
                                <div class="flex gap-2 items-center">
                                    <img src="../dist/img/imgMember/<?= $comment['img_member'] ?>" alt="" class="w-10 h-10 rounded-full object-cover object-top border-2 border-primary">
                                    <div class="text">
                                        <p class="text-darken"><?= $comment['fullname'] ?></p>
                                        <p class="text-dark text-xs"><?= ucwords($comment['role']) ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="italic px-7 py-2"><q><?= $comment['comment'] ?></q></td>
                            <td class="px-7 py-2 text-darken underline"><a href="../book.php?slug=<?= $comment['book_slug'] ?>"><?= $comment['title'] ?></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
    
    <!-- main content end -->
      

<?php include 'template/footer.php'; ?>