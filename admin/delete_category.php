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
$id_category = $_GET["id_category"];

if ( delete_category($id_category) > 0 ) {
    echo "<script> alert('Delete category success!'); document.location.href = 'categories_data.php';</script>";
} else {
    echo "<script> alert('Delete category failed!'); document.location.href = 'categories_data.php';</script>";
}

?>