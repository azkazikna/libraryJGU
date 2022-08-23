<?php
require 'functions.php';
if (@$_SESSION["role"] == "member") {
    header("Location: ../login.php");
}
// ambil data di url
$id_user = $_GET["id_user"];
// query ambil data berdasarkan id user
$member = query("SELECT * FROM users WHERE id_user = $id_user")[0];
//cek apakah tombol submit sudah ditekan?
if( isset($_POST["submit"])) {

    if( update_member($_POST) > 0 ) {
        echo "<script> alert('Edit member success!'); document.location.href = 'members_data.php';</script>";
    } else {
        echo "<script> alert('Edit member failed!'); document.location.href = 'members_data.php';</script>";
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Card | libraryJGU</title>
    <!-- Icon -->
    <link rel="icon" href="../dist/icon/logo-jgu.png">
    <!-- Custom styles -->
    <link rel="stylesheet" href="../dist/css/output.css">
</head>
<body class="font-poppins overflow-x-hidden relative w-full">
<img src="../dist/icon/logo-jgu-lengkap.png" alt="" class="absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 -z-10 w-1/3 brightness-[5]">
<header class="pt-4 pb-8">
    <div class="container mx-auto px-4 flex justify-between items-center gap-6">
        <div class="logo">
            <img src="../dist/icon/logo-jgu-lengkap.png" alt="" class="w-36">
        </div>
        <div class="text w-full">
            <h1 class="text-xl font-bold text-center">LIBRARY <span class="text-primary">JAKARTA GLOBAL UNIVERSITY</span></h1>
            <p class="font-medium text-center text-xs text-darken">Jl. Boulevard Grand Depok City, Tirtajaya, Kec. Sukmajaya, Kota Depok, Jawa Barat 16412</p>
        </div>
        <div class="logo">
        </div>
    </div>
    <div class="container mx-auto">
        <hr class="my-6 border-darken border-dashed">
    </div>
</header>


<section id="main" class="">
    <div class="container mx-auto">
        <h1 class="text-darken text-sm font-medium">Full Name</>
        <h1 class="font-bold text-xl mb-4"><?= $member['fullname'] ?></h1>
        <div class="flex gap-3 items-center">
            <img src="../dist/img/imgMember/<?= $member['img_member'] ?>" alt="" class="w-40 h-40 rounded-full object-cover object-top">
            <div class="text">
                <table>
                    <tr class="text-sm">
                        <td class="font-bold">ID Member&emsp;&emsp;&emsp;&emsp;</td>
                        <td class="font-bold">:&emsp;&emsp;&emsp;</td>
                        <td><?= $member['code_member'] ?></td>
                    </tr>
                    <tr class="text-sm">
                        <td class="font-bold">Name</td>
                        <td class="font-bold">:</td>
                        <td><?= $member['fullname'] ?></td>
                    </tr>
                    <tr class="text-sm">
                        <td class="font-bold">Gender</td>
                        <td class="font-bold">:</td>
                        <td><?= $member['gender'] ?></td>
                    </tr>
                    <tr class="text-sm">
                        <td class="font-bold">Email</td>
                        <td class="font-bold">:</td>
                        <td><?= $member['email'] ?></td>
                    </tr>
                    <tr class="text-sm">
                        <td class="font-bold">Address</td>
                        <td class="font-bold">:</td>
                        <td><?= $member['address'] ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <hr class="mt-8 mb-5 border-darken">
        <p class="text-sm text-darken text-center font-medium">&copy; <a href="https://azkazikna.github.io/" class="font-bold">Azkazikna Ageung Laksana</a> 2022. All rights reserved</p>
    </div>
</section>

<script>
    window.print();
</script>
</body>
</html>