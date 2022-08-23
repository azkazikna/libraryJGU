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

if ( delete_transaction($id_transaction) > 0 ) {
    echo "<script> alert('Delete transaction success!'); document.location.href = 'transactions_data.php';</script>";
} else {
    echo "<script> alert('Delete transaction failed!'); document.location.href = 'transactions_data.php';</script>";
}

?>