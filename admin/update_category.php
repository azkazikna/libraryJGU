<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: ../login.php");
}

if ($_SESSION["role"] == "member") {
    header("Location: ../login.php");
}
$currentPage = 'categories_data' 
?>
<?php include'template/header.php';?>
<?php include'template/sidebar.php';?>
<?php require'functions.php';?>
<?php 
// ambil data di url
$id_category = $_GET["id_category"];
// query ambil data berdasarkan id category
$categories = query("SELECT *, categories.description AS category_description FROM categories WHERE id_category = $id_category")[0];
//cek apakah tombol submit sudah ditekan?
if( isset($_POST["submit"])) {

    if( update_category($_POST) > 0 ) {
        echo "<script> alert('Edit category success!'); document.location.href = 'categories_data.php';</script>";
    } else {
        echo "<script> alert('Edit category failed!'); document.location.href = 'categories_data.php';</script>";
    }
    
}
?>

<!-- main content start -->
<section class="dashboard">
        <div class="flex justify-center flex-col lg:flex-row gap-5 items-center">
            <div class="text w-full">
                <p class="text-dark text-md">Categories</p>
                <h1 class="text-darken text-5xl font-bold">Edit Category</h1>
            </div>
        </div>
        <hr class="my-8">
        <div class="w-full bg-white rounded-3xl p-4 lg:p-16 shadow-lg overflow-x-auto">
            <h1 class="text-xl lg:text-2xl font-bold">Edit data category</h1>
            <hr class="mb-3 mt-5">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group w-full mt-5">
                    <label for="name" class="text-dark dark:text-txtdark">Category Name <span class="text-red-500">*</span></label><br>
                    <input type="hidden" name="id_user" value="<?= $id_user ?>">
                    <input type="hidden" name="id_category" value="<?= $id_category ?>">
                    <input type="hidden" name="oldImg" value="<?= $categories["img"] ?>">
                    <input type="text" name="name" id="name" class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full" placeholder="Enter category name here" value="<?= $categories["name"] ?>">
                </div>
                <div class="form-group w-full mt-2 lg:mt-5">
                    <label for="description" class="text-dark dark:text-txtdark">Description <span class="text-red-500">*</span></label><br>
                    <textarea type="text" name="description" id="description" class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full" placeholder="Enter description here"><?= $categories["category_description"] ?></textarea>
                </div>
                <div class="form-group w-full mt-2 lg:mt-5">
                    <label for="img" class="text-dark dark:text-txtdark">Image <span class="text-red-500">*</span></label><br>
                    <img src="../dist/img/imgCategory/<?= $categories["img"] ?>" alt="" class="w-56 h-36 mb-2 object-cover">
                    <input type="file" name="img" id="img" class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full">
                </div>
                <div class="flex flex-col lg:flex-row gap-2 mt-2 lg:mt-5">
                    <button type="submit" name="submit" class="block py-3 rounded-xl bg-sky-600 text-center w-full lg:w-[80%] text-white font-bold">Submit</button>
                    <button type="reset" class="block py-3 rounded-xl bg-primary text-center w-full lg:w-[20%] text-white font-bold">Reset</button>
                </div>
            </form>
        </div>
</section>
    
<!-- main content end -->

<?php include 'template/footer.php'; ?>