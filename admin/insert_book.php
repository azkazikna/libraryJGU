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
//ambil data categories
$categories = query("SELECT * FROM categories ORDER BY id_category DESC");
// start untuk membuat id buku
$sql = mysqli_query($conn, "SELECT MAX(id_books) AS maxID FROM books");
$data = mysqli_fetch_array($sql);
$code = $data['maxID'];
$code++;
$ket = "BK";
$codeauto = $ket . sprintf("%03s", $code);
// end untuk membuat id buku
//cek apakah tombol submit sudah ditekan?
if( isset($_POST["submit"])) {

    if( create($_POST) > 0 ) {
        echo "<script> alert('Add book success!'); document.location.href = 'books_data.php';</script>";
    } else {
        echo "<script> alert('Add book failed!'); document.location.href = 'books_data.php';</script>";
    }
    
}
?>

<!-- main content start -->
<section class="dashboard">
        <div class="flex justify-center flex-col lg:flex-row gap-5 items-center">
            <div class="text w-full">
                <p class="text-dark text-md">Books</p>
                <h1 class="text-darken text-5xl font-bold">Add Book</h1>
            </div>
        </div>
        <hr class="my-8">
        <div class="w-full bg-white rounded-3xl p-4 lg:p-16 shadow-lg overflow-x-auto">
            <h1 class="text-xl lg:text-2xl font-bold">Insert data book</h1>
            <hr class="mb-3 mt-5">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group w-full">
                    <label for="code_book" class="text-dark dark:text-txtdark">Book ID <span class="text-red-500 text-sm">(auto)</span></label>
                    <input type="text" name="code_book" id="code_book" value="<?= $codeauto ?>" class="bg-gray-300 dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full" readonly>
                </div>
                <div class="flex flex-col lg:flex-row gap-2 mt-5">
                    <div class="form-group w-full">
                        <label for="author" class="text-dark dark:text-txtdark">Author <span class="text-red-500">*</span></label><br>
                        <input type="hidden" name="id_user" value="<?= $_SESSION["id_user"] ?>">
                        <input type="text" name="author" id="author" class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full" placeholder="Enter author name here">
                    </div>
                    <div class="form-group w-full">
                        <label for="title" class="text-dark dark:text-txtdark">Title <span class="text-red-500">*</span></label><br>
                        <input type="text" name="title" id="title" class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full" placeholder="Enter title name here">
                    </div>
                </div>
                <div class="form-group w-full mt-2 lg:mt-5">
                    <label for="category" class="text-dark dark:text-txtdark">Category <span class="text-red-500">*</span></label><br>
                    <select type="text" name="category" id="category" class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full" placeholder="Enter title name here">
                        <option value="">--Choose Category--</option>
                        <?php foreach($categories as $category) :?>
                            <option value="<?= $category["id_category"]?>"><?= $category["name"]?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex flex-col lg:flex-row gap-2 mt-2 lg:mt-5">
                    <div class="form-group w-full">
                        <label for="language" class="text-dark dark:text-txtdark">Language <span class="text-red-500">*</span></label><br>
                        <input type="text" name="language" id="language" class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full" placeholder="Enter language here">
                    </div>
                    <div class="form-group w-full">
                        <label for="pages" class="text-dark dark:text-txtdark">Pages <span class="text-red-500">*</span></label><br>
                        <input type="number" name="pages" id="pages" class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full" placeholder="Enter total pages here">
                    </div>
                </div>
                <div class="form-group w-full mt-2 lg:mt-5">
                    <label for="description" class="text-dark dark:text-txtdark">Description <span class="text-red-500">*</span></label><br>
                    <textarea type="text" name="description" id="description" class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full" placeholder="Add description..."></textarea>
                </div>
                <div class="form-group w-full">
                    <label for="cover" class="text-dark dark:text-txtdark">Cover <span class="text-red-500">*</span></label><br>
                    <input type="file" name="cover" id="cover" class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full">
                </div>
                <div class="flex flex-col lg:flex-row gap-2 mt-2 lg:mt-5">
                    <button type="submit" name="submit" class="block py-3 rounded-xl bg-blue-400 text-center w-full lg:w-[80%] text-white font-bold">Submit</button>
                    <button type="reset" class="block py-3 rounded-xl bg-primary text-center w-full lg:w-[20%] text-white font-bold">Reset</button>
                </div>
            </form>
        </div>
</section>
    
<!-- main content end -->

<?php include 'template/footer.php'; ?>