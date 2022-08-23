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
// ambil data member
$members = query("SELECT * FROM users");
$books = query("SELECT * FROM books");
// start untuk membuat id buku
$sql = mysqli_query($conn, "SELECT MAX(id_transaction) AS maxID FROM transactions");
$data = mysqli_fetch_array($sql);
$code = $data['maxID'];
$code++;
$ket = "TR";
$codeauto = $ket . sprintf("%03s", $code);
// end untuk membuat id buku
//cek apakah tombol submit sudah ditekan?
if( isset($_POST["submit"])) {

    if( create_transaction($_POST) > 0 ) {
        echo "<script> alert('Add transaction success!'); document.location.href = 'transactions_data.php';</script>";
    } else {
        echo "<script> alert('Add transaction failed!'); document.location.href = 'transactions_data.php';</script>";
    }
    
}

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
                <h1 class="text-darken text-5xl font-bold">Add Transaction</h1>
            </div>
        </div>
        <hr class="my-8">
        <div class="w-full bg-white rounded-3xl p-4 lg:p-16 shadow-lg overflow-x-auto">
            <h1 class="text-xl lg:text-2xl font-bold">Insert data transaction</h1>
            <hr class="mb-3 mt-5">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="flex flex-col lg:flex-row gap-2 mt-2 lg:mt-5">
                    <div class="form-group w-full">
                        <label for="code_transaction" class="text-dark dark:text-txtdark">Transaction ID <span class="text-red-500 text-sm">(auto)</span></label>
                        <input type="text" name="code_transaction" id="code_transaction" value="<?= $codeauto ?>" class="bg-gray-300 dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full" readonly>
                    </div>
                    <div class="form-group w-full">
                        <label for="transaction_date" class="text-dark dark:text-txtdark">Borrow Date <span class="text-red-500 text-sm">(auto)</span></label>
                        <input type="date" name="transaction_date" id="transaction_date" value="<?= $today; ?>" class="bg-gray-300 dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full" readonly>
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row gap-2 mt-2 lg:mt-5">
                    <div class="form-group w-full">
                        <label for="code_member" class="text-dark dark:text-txtdark">Member <span class="text-red-500">*</span></label><br>
                        <select name="code_member" id="code_member" class="dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full">
                            <option value="">-- CHOOSE MEMBER --</option>
                            <?php foreach($members as $member) : ?>
                                <option value="<?= $member['code_member'] ?>"><?= $member['fullname'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group w-full">
                        <label for="code_book" class="text-dark dark:text-txtdark">Book <span class="text-red-500">*</span></label><br>
                        <select name="code_book" id="code_book" class="dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full">
                            <option value="">-- CHOOSE BOOK --</option>
                            <?php foreach($books as $book) : ?>
                                <option value="<?= $book['code_book'] ?>"><?= $book['title'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
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