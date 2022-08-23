<?php

    session_start();
    
    require 'admin/functions.php';
    $currentPage = 'login';
    //cek cookie
    if( isset($_COOKIE["secreto"]) && isset($_COOKIE["key"])) {
        $secreto = $_COOKIE['secreto'];
        $key = $_COOKIE['key'];

        //ambil username berdasarkan id
        $result = mysqli_query($conn, "SELECT email FROM users WHERE id_user = $secreto");
        $row = mysqli_fetch_assoc($result);

        //cek cookie dan username
        if($key === hash('sha256', $row["email"])) {
            $_SESSION['login'] = true;
        }
    }

    if( isset($_SESSION["login"]) ) {
        if($_SESSION["role"] == 'admin') {
            header("Location: admin");
        } else {
            header("Location: member");
        }
    }

    if( isset($_POST["login"]) ) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

        // cek username
        if(mysqli_num_rows($result) === 1 ) {
            //cek password
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row["password"]) ) {
                //set session
                $_SESSION["login"] = true;
                $_SESSION["fullname"] = $row["fullname"];
                $_SESSION["img_member"] = $row["img_member"];
                $_SESSION["id_user"] = $row["id_user"];
                $_SESSION["role"] = $row["role"];

                // cek remember me
                if( isset($_POST["remember"]) ) {
                    //buat cookie
                    setcookie('secreto', $row["id_user"], time() + (60 * 60 * 24 * 30));
                    setcookie('key', hash('sha256', $row['email']), time() + (60 * 60 * 24 * 30));
                    setcookie('fullname', $row["fullname"], time() + (60 * 60 * 24 * 30));
                    setcookie('img_member', $row["img_member"], time() + (60 * 60 * 24 * 30));
                    setcookie('role', $row["role"], time() + (60 * 60 * 24 * 30));
                }

                if($_SESSION["role"] == 'admin') {
                    header("Location: admin");
                } else {
                    header("Location: member");
                }
                exit;
            }
        }

        $error = true;
    }
?>

        <?php require 'template/header.php' ?>

        <!-- Main section login start -->
        <section id="login" class="py-32 lg:py-40 px-4">
            <div
                class="container mx-auto flex flex-col lg:flex-row gap-12 bg-white dark:bg-[#01060f] items-center rounded-2xl px-4 lg:px-14 py-14 lg:py-24 shadow-md justify-center">
                <div class="w-full">
                    <img src="dist/img/login.png" alt="" class="w-[400px] lg:w-[450px] mx-auto">
                </div>
                <div class="w-full">
                    <h5 class="font-bold text-xl text-center text-darken mb-7 dark:text-white">Log in Account</h5>
                    <?php if(@$error) {  ?>
                        <div class="w-full bg-primary py-2 text-white font-bold text-center rounded-lg">
                            <p>Wrong username/password!</p>
                        </div>
                    <?php } ?>
                    <form action="" method="POST">
                        <div class="form-group mt-7">
                            <label for="email" class="text-dark dark:text-txtdark">Email</label><br>
                            <input type="email" name="email" id="email"
                                class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full"
                                placeholder="Enter your Email here" autofocus>
                        </div>
                        <div class="form-group mt-7 relative">
                            <label for="password" class="text-dark dark:text-txtdark">Password</label><br>
                            <input type="password" name="password" id="password"
                                class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full"
                                placeholder="Enter your Password here">
                            <span toggle="#password"
                                class="fa-solid fa-eye field-icon toggle-password absolute top-1/2 right-5 text-darken dark:text-white text-xl cursor-pointer"></span>
                        </div>
                        <div class="flex justify-between mt-3">
                            <div class="form-group">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember" class="text-darken dark:text-white">Remember me</label>
                            </div>
                            <a href="" class="text-darken dark:text-white underline">Forgot password?</a>
                        </div>
                        <div class="flex justify-center mt-7">
                            <button type="submit"
                                class="py-3 px-5 bg-primary text-lg rounded-lg w-full text-white" name="login">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- Main section register end -->

    </main>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- Barba JS -->
    <script src="https://unpkg.com/@barba/core"></script>
    <script src="https://cdn.jsdelivr.net/npm/@barba/prefetch@2.1.10/dist/barba-prefetch.umd.min.js"></script>
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
    <!-- Swiper Slider -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <!-- Custom Javascript -->
    <script src="dist/js/script.js"></script>
    <!-- transition javascript -->
    <script src="dist/js/transition.js"></script>
</body>

</html>