<?php 

session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('secreto', '', time() - 3600);
setcookie('key', '', time() - 3600);
setcookie('fullname', '', time() - 3600);
setcookie('img_member', '', time() - 3600);
setcookie('role', '', time() - 3600);

header("Location: login.php");
exit;

?>