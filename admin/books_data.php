<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: ../login.php");
}

if ($_SESSION["role"] == "member") {
    header("Location: ../login.php");
}
$currentPage = 'books_data';
?>
<?php include'template/header.php';?>
<?php include'template/sidebar.php';?>
<?php require'functions.php';?>
<?php
  $books = query("SELECT *, books.description AS book_description, categories.description AS category_description FROM books INNER JOIN categories ON books.category = categories.id_category INNER JOIN users ON books.id_user = users.id_user WHERE books.id_user = $id_user ORDER BY id_books DESC");
  $jumlahBukuUser = count($books);
  $allbooks = query("SELECT *, books.description AS book_description, categories.description AS category_description, books.slug AS book_slug, categories.slug AS category_slug FROM books INNER JOIN categories ON books.category = categories.id_category ORDER BY id_books DESC");
  $jumlahBuku = count($allbooks);
?>

<!-- main content start -->
<section class="dashboard">
        <div class="flex justify-center flex-col lg:flex-row gap-5 items-center">
            <div class="text w-full">
                <p class="text-dark text-md">Books</p>
                <h1 class="text-darken text-5xl font-bold">Data</h1>
            </div>
            <div class="statistik w-full">
                <div class="bg-white shadow-lg py-5 px-5 rounded-md flex justify-between items-center">
                    <div class="text">
                        <h2 class="text-3xl font-bold text-darken"><?= $jumlahBuku ?></h2>
                        <h4 class="text-darken">Books Published</h4>
                    </div>
                    <i class="fa-solid fa-book text-darken text-5xl"></i>
                </div>
            </div>
        </div>
        <hr class="my-8">
        <div class="w-full bg-white rounded-3xl p-4 lg:p-16 shadow-lg overflow-x-auto">
            <a href="insert_book.php" class="py-2 px-4 rounded-md bg-green-500 text-white transition duration-500"><i class="fa-solid fa-plus"></i> Add Book</a>
            <hr class="mb-3 mt-5">
            <table id="table_id" class="row-border text-darken text-sm max-w-full">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Cover</th>
                        <th>Books ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach( $allbooks as $row) : 
                        // strip tags to avoid breaking any html
                        $string = strip_tags($row["book_description"]);
                        if (strlen($string) > 500) {
                            // truncate string
                            $stringCut = substr($string, 0, 100);
                            $endPoint = strrpos($stringCut, ' ');
                            //if the string doesn't contain any space then it will cut without word basis.
                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                            $string .= '...';
                        }
                      ?>
                    <tr>
                        <td width="10"><?= $no ?></td>
                        <td><img src="../dist/img/cover/<?= $row["cover"] ?>" alt="" class="w-52 rounded-md"></td>
                        <td><?= $row["code_book"] ?></td>
                        <td><?= $row["title"] ?></td>
                        <td><?= $row["author"] ?></td>
                        <td><?= $row["name"] ?></td>
                        <td><?= $string ?></td>
                        <td>
                            <div class="flex flex-col lg:flex-row gap-2">
                                <a href="../book.php?slug=<?= $row["book_slug"] ?>" class="px-5 py-2 text-white font-medium rounded-md border bg-green-500 transition duration-500"><i class="fa-solid fa-eye"></i></a>
                                <a href="update_book.php?id_books=<?= $row["id_books"] ?>" class="px-5 py-2 text-white font-medium rounded-md bg-blue-500 transition duration-500"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="delete.php?id_books=<?= $row["id_books"] ?>" class="px-5 py-2 text-white font-medium rounded-md bg-red-500 transition duration-500" onclick="return confirm('Are you sure you want to delete this book?');"><i class="fa-solid fa-trash-can"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php $no++; endforeach; ?>
                </tbody>
            </table>
        </div>
</section>
    
<!-- main content end -->

<?php include'template/footer.php';?>