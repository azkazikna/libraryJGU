<!-- sidebar start -->
<nav class="sidebar">
        <header>
            <a href="../index.php">
                <div class="flex gap-2 items-center">
                    <img src="../dist/icon/logo-jgu.png" alt="" class="w-10">
                    <div class="text">
                        <h3 class="text-darken font-bold text-xl lg:text-2xl">library<span class="text-primary">JGU</span></h3>
                    </div>
                </div>
            </a>
            <hr class="my-3">
            <div class="image-text">
                <span class="image">
                    <?php if(@$COOKIE['img_member'] != NULL ) { ?>
                        <img src="../dist/img/imgMember/<?= @$_COOKIE['img_member']; ?>" alt="" class="w-full">
                    <?php } elseif (@$_SESSION["img_member"] != NULL) { ?>
                        <img src="../dist/img/imgMember/<?= @$_SESSION['img_member']; ?>" alt="" class="w-full">
                    <?php } ?>
                </span>

                <div class="text logo-text">
                    <span class="name">
                    <?php if(@$_COOKIE['key'] != NULL) {
                      $nick = preg_split('/\s+/', @$_COOKIE["fullname"]);
                      echo $nick[0];
                    } else {
                      if(@$_SESSION["fullname"] != NULL) {
                        $nick = preg_split('/\s+/', @$_SESSION["fullname"]);
                        echo $nick[0];
                      }
                    }?>
                    </span>
                    <span class="profession">
                        <?php if (@$_COOKIE['role'] != NULL) {
                            echo ucwords($_COOKIE['role']);
                        } elseif(@$_SESSION['role'] != NULL) {
                            echo ucwords(@$_SESSION['role']);
                        } ?>
                    </span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar flex-col">
            <div class="menu">

                <ul class="menu-links">

                    <p class="text-sm text-dark mt-3">Dashboard</p>
                    <li class="nav-link <?php if($currentPage == "home"){echo 'active';} ?>">
                        <a href="index.php" class="list-none h-full bg-transparent flex items-center w-full rounded-md transition duration-300 text-darken hover:bg-primary hover:text-white">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <p class="text-sm text-dark mt-3">Data Master</p>
                    <li class="nav-link <?php if($currentPage == "categories_data"){echo 'active';} ?>">
                        <a href="categories_data.php" class="list-none h-full bg-transparent flex items-center w-full rounded-md transition duration-300 text-darken hover:bg-primary hover:text-white">
                            <i class='bx bx-category-alt icon'></i>
                            <span class="text nav-text">Categories Data</span>
                        </a>
                    </li>

                    <li class="nav-link <?php if($currentPage == "books_data"){echo 'active';} ?>">
                        <a href="books_data.php" class="list-none h-full bg-transparent flex items-center w-full rounded-md transition duration-300 text-darken hover:bg-primary hover:text-white">
                            <i class='bx bx-book icon'></i>
                            <span class="text nav-text">Books Data</span>
                        </a>
                    </li>
                    <li class="nav-link <?php if($currentPage == "members_data"){echo 'active';} ?>">
                        <a href="members_data.php" class="list-none h-full bg-transparent flex items-center w-full rounded-md transition duration-300 text-darken hover:bg-primary hover:text-white">
                            <i class='bx bx-user icon'></i>
                            <span class="text nav-text">Members Data</span>
                        </a>
                    </li>

                    <p class="text-sm text-dark mt-3">Data Transaction</p>
                    <li class="nav-link <?php if($currentPage == "transactions_data"){echo 'active';} ?>">
                        <a href="transactions_data.php" class="list-none h-full bg-transparent flex items-center w-full rounded-md transition duration-300 text-darken hover:bg-primary hover:text-white">
                            <i class='bx bx-archive-in icon'></i>
                            <span class="text nav-text">Transaction Data</span>
                        </a>
                    </li>
                    <li class="nav-link <?php if($currentPage == "history_data"){echo 'active';} ?>">
                        <a href="history_data.php" class="list-none h-full bg-transparent flex items-center w-full rounded-md transition duration-300 text-darken hover:bg-primary hover:text-white">
                            <i class='bx bx-history icon'></i>
                            <span class="text nav-text">History Transaction</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="../logout.php" class="list-none h-full bg-transparent flex items-center w-full rounded-md transition duration-300 text-red-500 hover:bg-red-500 hover:text-white">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
                
            </div>
        </div>

    </nav>
    <!-- sidebar end -->