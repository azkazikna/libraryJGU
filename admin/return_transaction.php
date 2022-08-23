<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: ../login.php");
}

if ($_SESSION["role"] == "member") {
    header("Location: ../login.php");
}
?>
<?php
require 'functions.php';
$id_transaction = $_GET["id_transaction"];
$code_transaction = $_GET["code_transaction"];
$code_member = $_GET["code_member"];
$code_book = $_GET["code_book"];
$transaction_date = $_GET["transaction_date"];
$return_date = $_GET["return_date"];

if ( return_transaction($id_transaction, $code_transaction, $code_member, $code_book, $transaction_date, $return_date) > 0 ) {
    echo "<script> alert('Return book success!'); document.location.href = 'transactions_data.php';</script>";
} else {
    echo "<script> alert('Return book failed!'); document.location.href = 'transactions_data.php';</script>";
}

?>