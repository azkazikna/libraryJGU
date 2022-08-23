<?php 
session_start();
require'admin/functions.php';?>
<?php 
// ambil data di url
$slug = $_GET["slug"];
// query ambil data berdasarkan id books
$book = query("SELECT *, books.description AS book_description, categories.description AS category_description, books.slug AS books_slug FROM books INNER JOIN categories ON books.category = categories.id_category INNER JOIN users ON books.id_user = users.id_user WHERE books.slug = '$slug'")[0];
$books = query("SELECT *, books.slug AS book_slug, categories.slug AS category_slug FROM books INNER JOIN categories ON books.category = categories.id_category ORDER BY id_books DESC LIMIT 5");
$comments = query("SELECT * FROM comments INNER JOIN books ON books.id_books = comments.id_book INNER JOIN users ON users.id_user = comments.id_user WHERE books.slug = '$slug' ORDER BY id_comment DESC");

$currentPage = $book["title"];


//cek apakah tombol submit sudah ditekan?
if( isset($_POST["submitcomment"])) {

    if( create_comment($_POST) > 0 ) {
        echo "<script> alert('Post comment success!'); document.location.href = 'book.php?slug=" . $book['books_slug'] . "';</script>";
    } else {
        echo "<script> alert('Post comment failed!'); document.location.href = 'book.php?slug=" . $book['books_slug'] . "';</script>";
    }
    
}

?>

    <?php require 'template/header.php' ?>

        <!-- All book section start -->
        <div class="w-full lg:w-[25%] h-80 rounded-br-full lg:rounded-br-none lg:h-full lg:rounded-tr-full bg-primary absolute -z-10 dark:bg-bgdarken">
        </div>
        <section id="book" class="py-32 lg:py-40">
            <div class="mx-auto px-4 lg:px-20 flex flex-col lg:flex-row gap-10 justify-center w-full ">
                <div class="w-full lg:w-1/2 ">
                    <img src="dist/img/cover/<?= $book["cover"] ?>" alt=""
                        class="w-[300px] h-[400px] rounded-lg mx-auto lg:mx-0 lg:ml-auto object-cover object-top">
                    <div class="relative">
                        <button class="block bg-primary lg:bg-white text-white lg:text-darken text-lg lg:w-[300px] mx-auto lg:mx-0 lg:ml-auto mt-3 p-5 rounded-xl text-center font-semibold w-full" id="open" onclick="modalBook()">Borrow Now<p class="text-xs font-normal">(double click)</p></button>
                    </div>
                </div>
                <div class="w-full">
                    <h1 class="text-2xl lg:text-3xl font-bold text-darken dark:text-white"><?= $book["title"] ?></h1>
                    <p class="text-sm text-dark dark:text-txtdark mb-3">by <?= $book["author"] ?> in <a href="category.php?slug=<?= $book["slug"]?>" class="text-darken font-medium dark:text-white"><?= $book["name"] ?></a></p>
                    <p class="text-justify text-darken dark:text-txtdark mb-10"><?= $book["book_description"] ?></p>
                    <h4 class="text-lg font-bold text-darken dark:text-white mb-3">Book Details : </h4>
                    <table>
                        <tr>
                            <td class="text-darken dark:text-white font-semibold">Uploader</td>
                            <td>:</td>
                            <td class="px-5 dark:text-txtdark"><a href="profile.php?slug=<?= $book['slug_user'] ?>" class="underline"><?= $book["fullname"]?></a></td>
                        </tr>
                        <tr>
                            <td class="text-darken dark:text-white font-semibold">Language</td>
                            <td>:</td>
                            <td class="px-5 dark:text-txtdark"><?= $book["language"] ?></td>
                        </tr>
                        <tr>
                            <td class="text-darken dark:text-white font-semibold">Pagination &emsp;</td>
                            <td>:</td>
                            <td class="px-5 dark:text-txtdark"><?= $book["pages"] ?> Pages</td>
                        </tr>
                    </table>
                </div>
                <div class="w-full lg:w-1/3">
                    <h1 class="text-xl lg:text-2xl font-bold text-white mb-5">You Might Also Like</h1>
                    <?php foreach($books as $bookLatest) : ?>
                        <a href="book.php?slug=<?= $bookLatest["book_slug"] ?>">
                            <div class="latest mb-3 relative">
                                <span class="bg-primary text-white text-xs py-1 px-2 rounded-br-lg absolute"><?= $bookLatest["name"] ?></span>
                                <img src="dist/img/cover/<?= $bookLatest["cover"] ?>" alt=""
                                    class="w-full h-20 mx-auto rounded-lg mb-2 object-cover object-center">
                                <h4 class="text-lg font-semibold text-darken dark:text-txtdark"><?= $bookLatest["title"] ?></h4>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        
        <div class="w-full bg-white dark:bg-bgdark">
                <div class="container mx-auto px-4 py-20">
                    <h1 class="text-lg lg:text-xl font-bold text-darken dark:text-txtdark">Leave a comment</h1>
                    <hr class="my-3 lg:my-4">
                <?php if(@$_COOKIE["key"] != NULL) { ?>
                    <form action="" method="POST">
                        <div class="flex gap-2">
                            <img src="dist/img/imgMember/<?= @$_COOKIE['img_member']  ?>" alt="" class="w-14 h-14 rounded-lg shadow-md object-cover">
                            <input type="hidden" name="id_user" value="<?= $_COOKIE['secreto'] ?>">
                            <input type="hidden" name="id_book" value="<?= $book['id_books'] ?>">
                            <textarea name="comment" id="comment" cols="30" rows="6" placeholder="Type your comment here." class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full"></textarea>
                        </div>
                        <button type="submit" name="submitcomment" class="py-2 px-4 rounded-lg bg-primary float-right text-white mt-2">Post Comment</button>
                    </form>
                <?php } elseif (@$_SESSION["fullname"] != NULL) { ?>
                    <form action="" method="POST">
                        <div class="flex gap-2">
                            <img src="dist/img/imgMember/<?= @$_SESSION['img_member']  ?>" alt="" class="w-14 h-14 rounded-lg shadow-md object-cover">
                            <input type="hidden" name="id_user" value="<?= $_SESSION['id_user'] ?>">
                            <input type="hidden" name="id_book" value="<?= $book['id_books'] ?>">
                            <textarea name="comment" id="comment" cols="30" rows="6" placeholder="Type your comment here." class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full"></textarea>
                        </div>
                        <button type="submit" name="submitcomment" class="py-2 px-4 rounded-lg bg-primary float-right text-white mt-2">Post Comment</button>
                    </form>
                <?php } else {?>
                    <p class="text-center py-10 text-darken dark:text-txtdark">You must be <a href="login.php" class="text-primary">logged in</a> to post a comment.</p>
                <?php } ?>
                <?php foreach($comments as $comment) : ?>
                    <div class="flex gap-3 mt-10">
                        <img src="dist/img/imgMember/<?= $comment['img_member']  ?>" alt="" class="w-14 h-14 rounded-lg shadow-md object-cover">
                        <div class="text w-full">
                            <h5 class="font-bold text-primary"><?= $comment['fullname'] ?></h5>
                            <p class="dark:text-txtdark"><?= $comment['comment'] ?></p>
                            <p class="text-xs text-dark"><?= date_format(new DateTime($comment['time']), 'D, d M Y, h:i:s') ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
        <!-- book section end -->

        <!-- Modal -->
        <div class="modal-container fixed top-0 left-0 h-screen w-screen bg-[rgba(0,0,0,0.3)] flex items-center justify-center opacity-0 pointer-events-none transition duration-500 z-[9999999999999]" id="modal_container">
            <div class="modal bg-white w-[350px] sm:w-[600px] max-w-full px-8 py-12 rounded-lg shadow-lg relative" id="modal">
                <h1 class="font-bold text-xl lg:text-2xl text-center mb-10 text-darken">Step by Step to Borrow a Book</h1>
                <div class="flex flex-row gap-3">
                    <img src="dist/img/step1.png" alt="" class="w-24">
                    <div class="text">
                        <h3 class="font-bold">1. Go to Jakarta Global University Library</h3>
                        <p class="text-darken text-sm">This library is located at Jakarta Global University, precisely on the 3rd floor.</p>
                    </div>
                </div>
                <div class="flex flex-row gap-3 mt-10 lg:mt-7">
                    <div class="text">
                        <h3 class="font-bold">2. Find the book you want to read</h3>
                        <p class="text-darken text-sm">JGU library has grouped books by category, making it easier for you to find the book you are looking for.</p>
                    </div>
                    <img src="dist/img/step2.png" alt="" class="w-32">
                </div>
                <div class="flex flex-row gap-3 mt-10 lg:mt-7">
                    <img src="dist/img/step3.png" alt="" class="w-24">
                    <div class="text">
                        <h3 class="font-bold">3. Go to the Librarian</h3>
                        <p class="text-darken text-sm">The librarian will record your data and what books you borrow, later you can see what book data you are borrowing.</p>
                    </div>
                </div>
                <button id="close" class="text-2xl absolute right-3 top-2 text-darken"><i class="fa-solid fa-circle-xmark"></i></button>
            </div>
        </div>

        <?php require 'template/footer.php' ?>
        