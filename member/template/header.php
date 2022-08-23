<?php
 if(!isset($_SESSION)) 
 { 
     session_start(); 
 }

  if(@$_COOKIE["key"] != NULL) {
    $id_user = $_COOKIE["secreto"];
  } else {
    if($_SESSION["fullname"] != NULL) {
      $id_user = $_SESSION["id_user"];
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Member | libraryJGU</title>
    <!-- Icon -->
    <link rel="icon" href="../dist/icon/logo-jgu.png">
    <!-- Font poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;600;700&family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/27e42df87e.js" crossorigin="anonymous"></script>
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <!-- Select 2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    <!-- DataTables JS -->
    <link rel="stylesheet" href="../dist/css/datatables.css">
    <link rel="stylesheet" href="../dist/css/buttons.dataTables.css">
    <!-- Custom Style -->
    <link rel="stylesheet" href="../dist/css/output.css">
</head>
<body class="font-poppins overflow-x-hidden relative w-full">
