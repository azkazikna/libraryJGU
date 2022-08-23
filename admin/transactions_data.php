<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: ../login.php");
}

if ($_SESSION["role"] == "member") {
    header("Location: ../login.php");
}
$currentPage = 'transactions_data';
?>
<?php include'template/header.php';?>
<?php include'template/sidebar.php';?>
<?php require'functions.php';?>
<?php 
  $transactions = query("SELECT * FROM transactions INNER JOIN users ON transactions.code_member = users.code_member INNER JOIN books ON transactions.code_book = books.code_book ORDER BY id_transaction DESC");
  $jumlahtransaction = count($transactions);

  $month = date('m');
  $day = date('d');
  $year = date('Y');

  $today = $year . '-' . $month . '-' . $day;
?>
<!-- main content start -->
<section class="dashboard">
        <div class="flex justify-center flex-col lg:flex-row gap-5 items-center">
            <div class="text w-full">
                <p class="text-dark text-md">Transactions</p>
                <h1 class="text-darken text-5xl font-bold">Data</h1>
            </div>
            <div class="statistik w-full">
                <div class="bg-white shadow-lg py-5 px-5 rounded-md flex justify-between items-center">
                    <div class="text">
                        <h2 class="text-3xl font-bold text-darken"><?= $jumlahtransaction ?></h2>
                        <h4 class="text-darken">Transactions</h4>
                    </div>
                    <i class="fa-solid fa-book text-darken text-5xl"></i>
                </div>
            </div>
        </div>
        <hr class="my-8">
        <div class="w-full bg-white rounded-3xl p-4 lg:p-16 shadow-lg overflow-x-auto">
            <a href="insert_transaction.php" class="py-2 px-4 rounded-md bg-green-500 text-white transition duration-500"><i class="fa-solid fa-plus"></i> Add Transaction</a>
            <hr class="mb-3 mt-5">
            <table id="table_id" class="row-border text-darken text-sm max-w-full">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Transaction ID</th>
                        <th>Member ID</th>
                        <th>Name</th>
                        <th>Book ID</th>
                        <th>Book Title</th>
                        <th>Book Cover</th>
                        <th>Borrow Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; 
                    foreach( $transactions as $row) :
                    ?>
                    <tr>
                        <td width="10"><?= $no ?></td>
                        <td><?= $row["code_transaction"] ?></td>
                        <td><?= $row["code_member"] ?></td>
                        <td>
                            <div class="flex gap-2 items-center">
                            <img src="../dist/img/imgMember/<?= $row['img_member'] ?>" alt="" class="w-5 h-5 rounded-full inline-block object-cover">
                            <?= $row["fullname"] ?>
                            </div>
                        </td>
                        <td><?= $row["code_book"] ?></td>
                        <td><?= $row["title"] ?></td>
                        <td><img src="../dist/img/cover/<?= $row["cover"] ?>" alt="" class="w-24 h-36 object-cover"></td>
                        <td><?= date_format(new DateTime($row['transaction_date']), 'D, d-m-Y')?></td>
                        <td>
                            <div class="flex flex-col lg:flex-row gap-2">
                                <a href="return_transaction.php?id_transaction=<?= $row["id_transaction"] ?>&code_member=<?= $row["code_member"] ?>&code_book=<?= $row["code_book"] ?>&code_transaction=<?= $row["code_transaction"] ?>&transaction_date=<?= $row["transaction_date"] ?>&return_date=<?= $today ?>" class="px-5 py-2 font-medium rounded-md bg-green-500 text-white transition duration-500" onclick="return confirm('Are you sure this book has been returned?');"><i class="fa-solid fa-right-left"></i></a>
                                <a href="delete_transaction.php?id_transaction=<?= $row["id_transaction"] ?>" class="px-5 py-2 font-medium rounded-md bg-red-500 text-white transition duration-500" onclick="return confirm('Are you sure you want to delete this transaction?');"><i class="fa-solid fa-trash-can"></i></a>
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