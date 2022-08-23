<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth relative overflow-x-hidden w-full">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php if($currentPage == 'home') {
            echo "Home" ;
        } elseif ($currentPage == 'all_books' ) {
            echo "All Books";
        } elseif ($currentPage == 'categories' ) {
            echo "Categories";
        }  elseif ($currentPage == @$slug ) {
            echo ucwords(@$slug) . " Category";
        } elseif ($currentPage == @$book["title"] ) {
            echo $book["title"];
        } elseif ($currentPage == @$user["fullname"] ) {
            echo @$user["fullname"];
        } elseif ($currentPage == 'login' ) {
            echo 'Login';
        }
        ?> 
    | libraryJGU</title>
    <!-- Icon -->
    <link rel="icon" href="dist/icon/logo-jgu.png">
    <!-- Font poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;600;700&family=Poppins:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/27e42df87e.js" crossorigin="anonymous"></script>
    <!-- Swiper Slider -->
    <link rel="stylesheet" href="dist/css/swiper.min.css" />
    <!-- Custom Style -->
    <link rel="stylesheet" href="dist/css/output.css">
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="font-poppins overflow-x-hidden relative w-full dark:bg-bgdark transition duration-500"
    data-barba="wrapper">

    <!-- transition start -->
    <div class="load-container">
        <div class="loading-screen"></div>
    </div>
    <!-- transition end -->

    <!-- Header Start -->
    <header
        class="bg-transparent absolute top-0 left-0 w-full flex items-center justify-evenly z-index-10 transition duration-500 py-5 lg:py-4">
        <div class="container lg:px-7">
            <div class="flex items-center justify-between relative">
                <div class="px-4">
                    <a href="index.php" class="flex items-center gap-2">
                        <img src="dist/icon/logo-jgu.png" alt="" class="w-14 lg:w-16">
                        <h1 class="text-2xl lg:text-3xl font-bold text-primary"><span
                                class="text-darken dark:text-txtdark">library</span>JGU</h1>
                    </a>
                </div>
                <div class="flex items-center px-4">
                    <button id="hamburger" name="hamburger" type="buton" class="block absolute right-4 lg:hidden">
                        <span class="hamburger-line transition duration-300 ease-in-out origin-top-left"></span>
                        <span class="hamburger-line transition duration-300 ease-in-out"></span>
                        <span class="hamburger-line transition duration-300 ease-in-out origin-bottom-left"></span>
                    </button>

                    <nav id="nav-menu"
                        class="hidden absolute py-5 bg-white backdrop-blur-sm shadow-lg rounded-lg max-w-[250px] w-full right-4 top-full lg:block lg:static lg:backdrop-blur-0 lg:bg-transparent lg:max-w-full lg:shadow-none lg:rounded-none dark:bg-bgdark dark:bg-opacity-70 lg:dark:bg-transparent dark:border lg:dark:border-none z-[999] mt-5 lg:mt-0">
                        <ul class="block lg:flex">
                            <li class="group" id="subnav"><a href="index.php"
                                    class="text-base text-darken font-medium py-2 mx-8 flex group-hover:text-primary dark:text-white transition duration-500 ease-in-out">Home</a>
                            </li>
                            <li class="group" id="subnav"><a href="allbook.php" class="text-base text-darken font-medium py-2 mx-8 flex group-hover:text-primary dark:text-white transition duration-500 ease-in-out">All Books</a></li>
                            <li class="group" id="subnav"><a href="categories.php"
                                    class="text-base text-darken font-medium py-2 mx-8 flex group-hover:text-primary dark:text-white transition duration-500 ease-in-out">Category</a>
                            </li>
                            <li class="ml-10 mt-4 lg:mt-1">
                                <input type="checkbox" class="opacity-0 absolute top-0 group" id="dark-toggle">
                                <label for="dark-toggle"
                                    class="w-[50px] h-[26px] bg-primary flex rounded-full items-center justify-between p-[5px] relative scale-150 cursor-pointer transition duration-300 ease-linear">
                                    <i class="fas fa-moon text-bgdark"></i>
                                    <i class="fa-solid fa-sun text-[#FEFDF9] text-sm"></i>
                                    <div
                                        class='ball w-5 h-5 bg-[#FEFDF9] absolute t-[2px] l-[2px] rounded-full transition duration-200 ease-linear'>
                                </label>
                            </li>
                            <hr class="mb-3 mt-5">
                            <?php if(@$_COOKIE["key"] != NULL) { ?>
                                <?php if(@$_COOKIES["role"] == "admin") : ?>
                                    <li class="group lg:hidden" id="subnav"><a href="admin/" class="text-base dark:text-white text-darken font-medium py-2 mx-8 flex group-hover:text-primary transition duration-500 ease-in-out" data-barba-prevent="all">Dashboard</a></li>
                                <?php endif; ?>
                                <?php if(@$_COOKIES["role"] == "member") : ?>
                                    <li class="group lg:hidden" id="subnav"><a href="member/" class="text-base dark:text-white text-darken font-medium py-2 mx-8 flex group-hover:text-primary transition duration-500 ease-in-out" data-barba-prevent="all">Dashboard</a></li>
                                <?php endif; ?>
                                <li class="group lg:hidden" id="subnav"><a href="logout.php" class="text-base text-red-500 font-medium py-2 mx-8 flex items-center gap-2 transition duration-500 ease-in-out" data-barba-prevent="all"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log out</a></li>
                            <?php } elseif(@$_SESSION["fullname"] != NULL) { ?>
                                <?php if(@$_SESSION["role"] == "admin") : ?>
                                    <li class="group lg:hidden" id="subnav"><a href="admin/" class="text-base dark:text-white text-darken font-medium py-2 mx-8 flex group-hover:text-primary transition duration-500 ease-in-out" data-barba-prevent="all">Dashboard</a></li>
                                <?php endif; ?>
                                <?php if(@$_SESSION["role"] == "member") : ?>
                                    <li class="group lg:hidden" id="subnav"><a href="member/" class="text-base dark:text-white text-darken font-medium py-2 mx-8 flex group-hover:text-primary transition duration-500 ease-in-out" data-barba-prevent="all">Dashboard</a></li>
                                <?php endif; ?>
                                <li class="group lg:hidden" id="subnav"><a href="logout.php" class="text-base text-red-500 font-medium py-2 mx-8 flex items-center gap-2 transition duration-500 ease-in-out" data-barba-prevent="all"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log out</a></li>
                            <?php } else { ?>
                                <li class="mx-5 mt-4 lg:mt-1"><a href="login.php" class="text-base font-medium text-white px-8 py-2 bg-primary shadow-lg rounded-full block text-center lg:hidden">Login</a></li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
                <div class="lg:flex items-center gap-10 hidden">
                    <?php if(@$_COOKIE["key"] != NULL) {?>
                        <button id="profile" type="button" name="profile">
                            <div class="flex items-center gap-2">
                                <img src="dist/img/imgMember/<?= @$_COOKIE['img_member'] ?>" alt="" class="w-8 h-8 rounded-full shadow-md border-2 border-darken dark:border-white object-cover object-top">
                                <p class="text-darken font-medium">Hi, <?= @$_COOKIE["fullname"]; ?></p>
                            </div>
                        </button>

                        <nav id="profileMenu" class="hidden absolute py-5 shadow-lg rounded-lg max-w-[250px] w-full bg-white right-4 top-full z-[999] mt-5">
                            <ul class="block">
                                <?php if(@$_COOKIE["role"] == "admin") : ?>
                                    <li class="group" id="subnav"><a href="admin/" class="text-base text-darken font-medium py-2 mx-8 flex group-hover:text-primary transition duration-500 ease-in-out" data-barba-prevent="all">Dashboard</a></li>
                                <?php endif; ?>
                                <?php if(@$_COOKIE["role"] == "member") : ?>
                                    <li class="group" id="subnav"><a href="member/" class="text-base text-darken font-medium py-2 mx-8 flex group-hover:text-primary transition duration-500 ease-in-out" data-barba-prevent="all">Dashboard</a></li>
                                <?php endif; ?>
                                <hr class="text-dark mt-5 mb-2">
                                <li class="group" id="subnav"><a href="logout.php" class="text-base text-red-500 font-medium py-2 mx-8 flex items-center gap-2 transition duration-500 ease-in-out" data-barba-prevent="all"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log out</a></li>
                            </ul>
                        </nav>
                    <?php } elseif(@$_SESSION["fullname"] != NULL) { ?>
                        <button id="profile" type="button" name="profile">
                            <div class="flex items-center gap-2">
                                <img src="dist/img/imgMember/<?= @$_SESSION['img_member'] ?>" alt="" class="w-8 h-8 rounded-full shadow-md border-2 border-darken dark:border-white object-cover object-top">
                                <p class="text-darken dark:text-white font-medium">Hi, <?= @$_SESSION["fullname"]; ?></p>
                            </div>
                        </button>

                        <nav id="profileMenu" class="hidden absolute py-5 shadow-lg rounded-lg max-w-[250px] w-full bg-white right-4 top-full z-[999] mt-5">
                        <ul class="block">
                            <?php if(@$_SESSION["role"] == "admin") : ?>
                                <li class="group" id="subnav"><a href="admin/" class="text-base text-darken font-medium py-2 mx-8 flex group-hover:text-primary transition duration-500 ease-in-out" data-barba-prevent="all">Dashboard</a></li>
                            <?php endif; ?>
                            <?php if(@$_SESSION["role"] == "member") : ?>
                                <li class="group" id="subnav"><a href="member/" class="text-base text-darken font-medium py-2 mx-8 flex group-hover:text-primary transition duration-500 ease-in-out" data-barba-prevent="all">Dashboard</a></li>
                            <?php endif; ?>
                            <hr class="text-dark mt-5 mb-2">
                            <li class="group" id="subnav"><a href="logout.php" class="text-base text-red-500 font-medium py-2 mx-8 flex items-center gap-2 transition duration-500 ease-in-out" data-barba-prevent="all"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log out</a></li>
                        </ul>
                    </nav>
                    <?php } else {?>
                        <a href="login.php" class="text-base font-medium text-white px-8 py-2 bg-primary shadow-lg rounded-full">Login</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    <main data-barba="container" data-barba-namespace="home">