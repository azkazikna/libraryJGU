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
$id_books = $_GET["id_books"];

if ( delete($id_books) > 0 ) {
    echo "<script> alert('Delete book success!'); document.location.href = 'books_data.php';</script>";
} else {
    echo "<script> alert('Delete book failed!'); document.location.href = 'books_data.php';</script>";
}

?>