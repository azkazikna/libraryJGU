<?php
session_start();

if( !isset($_SESSION["login"]) || $_SESSION["role"] == "admin" ) {
    header("Location: ../login.php");
}
$currentPage = 'history_data';
?>
<?php include'template/header.php';?>
<?php include'template/sidebar.php';?>
<?php require'functions.php';?>
<?php 
  $histories = query("SELECT * FROM history INNER JOIN users ON history.code_member = users.code_member INNER JOIN books ON history.code_book = books.code_book WHERE users.id_user = $id_user ORDER BY id_history DESC");
  $jumlahhistory = count($histories);

  $month = date('m');
  $day = date('d');
  $year = date('Y');

  $today = $year . '-' . $month . '-' . $day;
?>
<!-- main content start -->
<section class="dashboard">
        <div class="flex justify-center flex-col lg:flex-row gap-5 items-center">
            <div class="text w-full">
                <p class="text-dark text-md">History</p>
                <h1 class="text-darken text-5xl font-bold">Data</h1>
            </div>
            <div class="statistik w-full">
                <div class="bg-white shadow-lg py-5 px-5 rounded-md flex justify-between items-center">
                    <div class="text">
                        <h2 class="text-3xl font-bold text-darken"><?= $jumlahhistory ?></h2>
                        <h4 class="text-darken">History Transactions</h4>
                    </div>
                    <i class="fa-solid fa-book text-darken text-5xl"></i>
                </div>
            </div>
        </div>
        <hr class="my-8">
        <div class="w-full bg-white rounded-3xl p-4 lg:p-16 shadow-lg overflow-x-auto">
            <table id="table_id" class="row-border text-darken text-sm max-w-full">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Transaction ID</th>
                        <th>Book ID</th>
                        <th>Book Title</th>
                        <th>Book Cover</th>
                        <th>Borrow Date</th>
                        <th>Return Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; 
                    foreach( $histories as $row) :
                    ?>
                    <tr>
                        <td width="10"><?= $no ?></td>
                        <td><?= $row["code_transaction"] ?></td>
                        <td><?= $row["code_book"] ?></td>
                        <td><?= $row["title"] ?></td>
                        <td><img src="../dist/img/cover/<?= $row["cover"] ?>" alt="" class="w-24 h-36 object-cover"></td>
                        <td><?= date_format(new DateTime($row['transaction_date']), 'D, d-m-Y')?></td>
                        <td><?= date_format(new DateTime($row['return_date']), 'D, d-m-Y')?></td>
                    </tr>
                    <?php $no++; endforeach; ?>
                </tbody>
            </table>
      </div>
</section>
    
  <!-- main content end -->

<?php include'template/footer.php';?>