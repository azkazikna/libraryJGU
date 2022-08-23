<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: ../login.php");
}

if ($_SESSION["role"] == "member") {
    header("Location: ../login.php");
}
$currentPage = 'members_data';
?>
<?php include'template/header.php';?>
<?php include'template/sidebar.php';?>
<?php require'functions.php';?>
<?php
// start untuk membuat id member
$sql = mysqli_query($conn, "SELECT MAX(id_user) AS maxID FROM users");
$data = mysqli_fetch_array($sql);
$code = $data['maxID'];
$code++;
$ket = "AG";
$codeauto = $ket . sprintf("%03s", $code);
// end untuk membuat id member
//cek apakah tombol submit sudah ditekan?
if( isset($_POST["submit"])) {

    if( create_member($_POST) > 0 ) {
        echo "<script> alert('Add member success!'); document.location.href = 'members_data.php';</script>";
    } else {
        echo "<script> alert('Add member failed!'); document.location.href = 'members_data.php';</script>";
    }
    
}
?>

<!-- main content start -->
<section class="dashboard">
        <div class="flex justify-center flex-col lg:flex-row gap-5 items-center">
            <div class="text w-full">
                <p class="text-dark text-md">Members</p>
                <h1 class="text-darken text-5xl font-bold">Add Member</h1>
            </div>
        </div>
        <hr class="my-8">
        <div class="w-full bg-white rounded-3xl p-4 lg:p-16 shadow-lg overflow-x-auto">
            <h1 class="text-xl lg:text-2xl font-bold text-center lg:text-left">Insert data member</h1>
            <hr class="mb-3 mt-5">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="flex flex-col lg:flex-row gap-2 mt-5">
                    <div class="form-group w-full">
                        <label for="code_member" class="text-dark dark:text-txtdark">Member ID <span class="text-red-500 text-sm">(auto)</span></label>
                        <input type="text" name="code_member" id="code_member" value="<?= $codeauto ?>" class="bg-gray-300 dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full" readonly>
                    </div>
                    <div class="form-group w-full">
                        <label for="role" class="text-dark dark:text-txtdark">Role <span class="text-red-500">*</span></label><br>
                        <input type="text" name="role" id="role" class="bg-gray-300 dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full" value="member" readonly>
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row gap-2 mt-5">
                    <div class="form-group w-full">
                        <label for="fullname" class="text-dark dark:text-txtdark">Full name <span class="text-red-500">*</span></label><br>
                        <input type="text" name="fullname" id="fullname" class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full" placeholder="Enter full name here">
                    </div>
                    <div class="form-group w-full">
                        <label for="password" class="text-dark dark:text-txtdark">Password <span class="text-red-500">*</span></label><br>
                        <input type="password" name="password" id="password" class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full" placeholder="Enter member's password here">
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row gap-2 mt-2 lg:mt-5">
                    <div class="form-group w-full">
                        <label for="email" class="text-dark dark:text-txtdark">Email <span class="text-red-500">*</span></label><br>
                        <input type="email" name="email" id="email" class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full" placeholder="Enter member's email here">
                    </div>
                    <div class="form-group w-full">
                        <label for="confirm_password" class="text-dark dark:text-txtdark">Confirm Password <span class="text-red-500">*</span></label><br>
                        <input type="password" name="confirm_password" id="confirm_password" class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full" placeholder="Confirm password here">
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row gap-2 mt-2 lg:mt-5">
                    <div class="form-group w-full">
                        <label for="birth" class="text-dark dark:text-txtdark">Birth <span class="text-red-500">*</span></label><br>
                        <input type="date" name="birth" id="birth" class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full">
                    </div>
                    <div class="form-group w-full">
                        <label for="gender" class="text-dark dark:text-txtdark">Gender <span class="text-red-500">*</span></label><br>
                        <select name="gender" id="gender" class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full">
                            <option value="">-- SELECT GENDER --</option>
                            <option value="Female">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-group w-full mt-2 lg:mt-5">
                    <label for="address" class="text-dark dark:text-txtdark">Address <span class="text-red-500">*</span></label><br>
                    <textarea type="text" name="address" id="address" class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full" placeholder="Add address..."></textarea>
                </div>
                <div class="form-group w-full">
                    <label for="img_member" class="text-dark dark:text-txtdark">Image <span class="text-red-500">*</span></label><br>
                    <input type="file" name="img_member" id="img_member" class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full">
                </div>
                <div class="flex flex-col lg:flex-row gap-2 mt-2 lg:mt-5">
                    <button type="submit" name="submit" class="block py-3 rounded-xl bg-blue-400 text-center w-full lg:w-[80%] text-white font-bold">Submit</button>
                    <button type="reset" class="block py-3 rounded-xl bg-primary text-center w-full lg:w-[20%] text-white font-bold">Reset</button>
                </div>
            </form>
        </div>
</section>
    
<!-- main content end -->

<?php include 'template/footer.php'; ?>