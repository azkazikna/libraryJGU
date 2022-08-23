<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: ../login.php");
}

if ($_SESSION["role"] == "member") {
    header("Location: ../login.php");
}
$currentPage = 'categories_data';
?>
<?php include'template/header.php';?>
<?php include'template/sidebar.php';?>
<?php require'functions.php';?>
<?php 
  $categories = query("SELECT * FROM categories ORDER BY id_category DESC");
  $jumlahKategori = count($categories);
?>
<!-- main content start -->
<section class="dashboard">
        <div class="flex justify-center flex-col lg:flex-row gap-5 items-center">
            <div class="text w-full">
                <p class="text-dark text-md">Categories</p>
                <h1 class="text-darken text-5xl font-bold">Data</h1>
            </div>
            <div class="statistik w-full">
                <div class="bg-white shadow-lg py-5 px-5 rounded-md flex justify-between items-center">
                    <div class="text">
                        <h2 class="text-3xl font-bold text-darken"><?= $jumlahKategori ?></h2>
                        <h4 class="text-darken">Categories</h4>
                    </div>
                    <i class="fa-solid fa-book text-darken text-5xl"></i>
                </div>
            </div>
        </div>
        <hr class="my-8">
        <div class="w-full bg-white rounded-3xl p-4 lg:p-16 shadow-lg overflow-x-auto">
            <a href="insert_category.php" class="py-2 px-4 rounded-md bg-green-500 text-white transition duration-500"><i class="fa-solid fa-plus"></i> Add Category</a>
            <hr class="mb-3 mt-5">
            <table id="table_id" class="row-border text-darken text-sm max-w-full">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach( $categories as $row) : 
                      // strip tags to avoid breaking any html
                      $string = strip_tags($row["description"]);
                      if (strlen($string) > 500) {
                        // truncate string
                        $stringCut = substr($string, 0, 500);
                        $endPoint = strrpos($stringCut, ' ');
                        //if the string doesn't contain any space then it will cut without word basis.
                        $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                        $string .= '...';
                      }
                    ?>
                    <tr>
                        <td width="10"><?= $no ?></td>
                        <td><img src="../dist/img/imgCategory/<?= $row["img"] ?>" alt="" class="w-64 rounded-md"></td>
                        <td><?= $row["name"] ?></td>
                        <td width="500"><?= $string ?></td>
                        <td>
                            <div class="flex flex-col lg:flex-row gap-2">
                                <a href="update_category.php?id_category=<?= $row["id_category"] ?>" class="px-5 py-2 text-white font-medium rounded-md bg-blue-500 hover:text-white transition duration-500"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="delete_category.php?id_category=<?= $row["id_category"] ?>" class="px-5 py-2 text-white font-medium rounded-md bg-red-500 transition duration-500" onclick="return confirm('Are you sure you want to delete this category?');"><i class="fa-solid fa-trash-can"></i></a>
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