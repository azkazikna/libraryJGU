<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: ../login.php");
}

if ($_SESSION["role"] == "member") {
    header("Location: ../login.php");
}
$currentPage = 'members_data';
?>
<?php include'template/header.php';?>
<?php include'template/sidebar.php';?>
<?php require'functions.php';?>
<?php 
  $members = query("SELECT * FROM users ORDER BY id_user DESC");
  $isBorrow = queryArr("SELECT * FROM transactions");
  $arrCodeMember = array_column($isBorrow, 'code_member');
  $jumlahMember = count($members);
?>
<!-- main content start -->
<section class="dashboard">
        <div class="flex justify-center flex-col lg:flex-row gap-5 items-center">
            <div class="text w-full">
                <p class="text-dark text-md">Members</p>
                <h1 class="text-darken text-5xl font-bold">Data</h1>
            </div>
            <div class="statistik w-full">
                <div class="bg-white shadow-lg py-5 px-5 rounded-md flex justify-between items-center">
                    <div class="text">
                        <h2 class="text-3xl font-bold text-darken"><?= $jumlahMember ?></h2>
                        <h4 class="text-darken">Members</h4>
                    </div>
                    <i class="fa-solid fa-book text-darken text-5xl"></i>
                </div>
            </div>
        </div>
        <hr class="my-8">
        <div class="w-full bg-white rounded-3xl p-4 lg:p-16 shadow-lg overflow-x-auto">
            <a href="insert_member.php" class="py-2 px-4 rounded-md bg-green-500 text-white transition duration-500"><i class="fa-solid fa-plus"></i> Add Member</a>
            <hr class="mb-3 mt-5">
            <table id="table_id" class="row-border text-darken text-sm max-w-full">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; 
                    foreach( $members as $row) :
                    ?>
                    <tr <?php if($row["role"] == "admin") { echo 'class="!bg-green-100"'; } ?>>
                        <td width="10"><?= $no ?></td>
                        <td><img src="../dist/img/imgMember/<?= $row["img_member"] ?>" alt="" class="w-full h-32 object-cover object-top rounded-md"></td>
                        <td><?= $row["code_member"] ?></td>
                        <td><?= $row["fullname"] ?></td>
                        <td><?= $row["gender"] ?></td>
                        <td><?= $row["email"] ?></td>
                        <td><?= $row["address"] ?></td>
                        <td><?= in_array($row['code_member'], $arrCodeMember) ? '<div class="px-3 py-1 bg-green-500 text-white rounded-lg">Borrowing</div>' : '<div class="px-3 py-1 bg-primary text-white rounded-lg">Not borrowing</div>' ?></td>
                        <td><?= $row["role"] ?></td>
                        <td>
                            <div class="flex flex-col lg:flex-row gap-2">
                                <a href="print_member.php?id_user=<?= $row["id_user"] ?>" class="px-5 py-2 font-medium rounded-md bg-green-500 text-white transition duration-500"><i class="fa-solid fa-print"></i></a>
                                <a href="update_user.php?id_user=<?= $row["id_user"] ?>" class="px-5 py-2 font-medium rounded-md  bg-blue-500 text-white transition duration-500"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="delete_member.php?id_user=<?= $row["id_user"] ?>" class="px-5 py-2 font-medium rounded-md bg-red-500 text-white transition duration-500" onclick="return confirm('Are you sure you want to delete this member?');"><i class="fa-solid fa-trash-can"></i></a>
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