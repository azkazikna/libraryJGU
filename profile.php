<?php 
require'admin/functions.php';
// ambil data di url
$slug = $_GET["slug"];
// query ambil data berdasarkan id books
$user = query("SELECT * FROM users WHERE slug_user = '$slug'")[0];

$jumlahDataPerHalaman = 8;
$jumlahData = count(query("SELECT *,books.slug AS book_slug, categories.slug AS category_slug FROM books INNER JOIN categories ON books.category = categories.id_category INNER JOIN users ON books.id_user = users.id_user WHERE users.slug_user = '$slug'"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET["page"])) ? $_GET["page"] : 1;

$awalData = ( $jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$books = query("SELECT *,books.slug AS book_slug, categories.slug AS category_slug FROM books INNER JOIN categories ON books.category = categories.id_category INNER JOIN users ON books.id_user = users.id_user WHERE users.slug_user = '$slug' ORDER BY books.id_books DESC LIMIT $awalData, $jumlahDataPerHalaman");


$currentPage = $user["fullname"];
?>

        <?php require 'template/header.php' ?>

        <!-- Main section register start -->
        <div class="w-full h-64 bg-[#fab1b3] absolute -z-10 rounded-br-full dark:bg-bgdarken"></div>
        <section id="register" class="py-32 lg:py-40 px-4">
            <div
                class="container mx-auto bg-white dark:bg-bgdarken dark:border items-center rounded-2xl px-4 lg:px-14 py-7 lg:py-8 shadow-md">
                <div class="w-full flex gap-7 items-center">
                    <div class="w-28 h-28 border overflow-hidden rounded-xl p-2 shadow-lg">
                        <img src="dist/img/avatar/maleProfile.png" alt="">
                    </div>
                    <div class="text w-full">
                        <div class="flex flex-col lg:flex-row justify-between">
                            <div class="">
                                <h1 class="text-xl lg:text-2xl font-bold text-darken dark:text-white inline-block"><?= $user["fullname"] ?></h1>
                                <img src="dist/img/avatar/verif.png" alt="" class="w-5 h-5 inline-block mb-2 ml-1">
                            </div>
                            <div class="">
                                <div class="w-3 h-3 bg-green-400 rounded-full inline-block"></div>
                                <p class="text-green-400 inline-block">Online</p>
                            </div>
                        </div>
                        <p class="text-dark dark:text-txtdark">Web Developer</p>
                    </div>
                </div>
            </div>
            <div class="container mx-auto mt-5">
                <div class="flex flex-col-reverse lg:flex-row gap-2">
                    <div
                        class="w-full bg-white dark:bg-bgdarken items-center rounded-2xl px-4 lg:px-14 py-7 lg:py-8 shadow-md lg:w-[70%]">
                        <h3 class="text-darken dark:text-white font-semibold text-md lg:text-lg mb-4">Books Uploaded :
                            <span class="py-1 px-2 bg-primary text-white rounded-xl text-base font-bold"><?= $jumlahData ?></span></span>
                        </h3>
                        <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
                            <?php foreach($books as $book) : ?>
                                <a href="book.php?slug=<?= $book["book_slug"] ?>">
                                    <div class="group">
                                        <div class="overflow-hidden rounded-lg shadow-lg">
                                            <img src="dist/img/cover/<?= $book["cover"] ?>" alt=""
                                                class="w-full group-hover:scale-110 group-hover:rotate-3 transition duration-500 ease-in-out object-cover">
                                        </div>
                                        <h3 class="text-darken dark:text-white font-medium mt-2"><?= $book["title"] ?></h3>
                                        <p class="text-sm text-dark dark:text-txtdark"><?= $book["name"] ?></p>
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
                    </div>
                    <div
                        class="w-full bg-white dark:bg-bgdarken items-center rounded-2xl px-4 lg:px-14 py-7 lg:py-8 shadow-md lg:w-[30%] self-start">
                        <h3 class="text-darken dark:text-white font-semibold text-md lg:text-lg my-3">Bio :</h3>
                        <p class="text-darken dark:text-white text-sm">Lorem ipsum dolor sit amet consectetur,
                            adipisicing elit. Tempora velit ratione aperiam aspernatur molestias error numquam quidem
                            reprehenderit voluptas accusantium.</p>
                        <h3 class="text-darken font-semibold text-md lg:text-lg my-3 dark:text-white">Details Profile :
                        </h3>
                        <table class="text-sm">
                            <tr>
                                <td class="text-dark dark:text-txtdark font-semibold">Join date</td>
                                <td>:</td>
                                <td class="px-5 py-1 text-dark dark:text-txtdark">26<sup>th</sup> July 2022</td>
                            </tr>
                            <tr>
                                <td class="text-dark dark:text-txtdark font-semibold">Date of birth</td>
                                <td>:</td>
                                <td class="px-5 py-1 text-dark dark:text-txtdark">24<sup>th</sup> June 2004</td>
                            </tr>
                            <tr>
                                <td class="text-dark dark:text-txtdark font-semibold">Gender</td>
                                <td>:</td>
                                <td class="px-5 py-1 text-dark dark:text-txtdark">Male</td>
                            </tr>
                            <tr>
                                <td class="text-dark dark:text-txtdark font-semibold">Language</td>
                                <td>:</td>
                                <td class="px-5 py-1 text-dark dark:text-txtdark">Bahasa</td>
                            </tr>
                            <tr>
                                <td class="text-dark dark:text-txtdark font-semibold">Citizenship</td>
                                <td>:</td>
                                <td class="px-5 py-1 text-dark dark:text-txtdark">Indonesian</td>
                            </tr>
                            <tr>
                                <td class="text-dark dark:text-txtdark font-semibold">Email</td>
                                <td>:</td>
                                <td class="px-5 py-1 text-dark dark:text-txtdark">azkazikna.aal@gmail.com</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main section register end -->

        <?php require 'template/footer.php' ?>