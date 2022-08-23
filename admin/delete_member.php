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
$id_user = $_GET["id_user"];

if ( delete_member($id_user) > 0 ) {
    echo "<script> alert('Delete member success!'); document.location.href = 'members_data.php';</script>";
} else {
    echo "<script> alert('Delete member failed!'); document.location.href = 'members_data.php';</script>";
}

?>