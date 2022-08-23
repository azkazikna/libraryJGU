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

<!-- main content start -->
<section class="dashboard">
        <div class="flex justify-center flex-col lg:flex-row gap-5 items-center">
            <div class="text w-full">
                <p class="text-dark text-md">Members</p>
                <h1 class="text-darken text-5xl font-bold">Edit Member</h1>
            </div>
        </div>
        <hr class="my-8">
        <div class="w-full bg-white rounded-3xl p-4 lg:p-16 shadow-lg overflow-x-auto">
            <h1 class="text-xl lg:text-2xl font-bold">Edit data member</h1>
            <hr class="mb-3 mt-5">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="flex flex-col lg:flex-row gap-2 mt-5">
                    <div class="form-group w-full">
                        <label for="code_member" class="text-dark dark:text-txtdark">Member ID <span class="text-red-500 text-sm">(auto)</span></label>
                        <input type="hidden" name="id_user" value="<?= $member['id_user'] ?>">
                        <input type="hidden" name="oldImg" value="<?= $member['img_member'] ?>">
                        <input type="text" name="code_member" id="code_member" value="<?= $member['code_member'] ?>" class="bg-gray-300 dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full" readonly>
                    </div>
                    <div class="form-group w-full">
                        <label for="role" class="text-dark dark:text-txtdark">Role <span class="text-red-500">*</span></label><br>
                        <input type="text" name="role" id="role" class="bg-gray-300 dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full" value="member" readonly>
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row gap-2 mt-5">
                    <div class="form-group w-full">
                        <label for="fullname" class="text-dark dark:text-txtdark">Full name <span class="text-red-500">*</span></label><br>
                        <input type="text" name="fullname" id="fullname" class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full" placeholder="Enter full name here" value="<?= $member['fullname'] ?>">
                    </div>
                    <div class="form-group w-full">
                        <label for="email" class="text-dark dark:text-txtdark">Email <span class="text-red-500">*</span></label><br>
                        <input type="email" name="email" id="email" class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full" placeholder="Enter member's email here" value="<?= $member['email'] ?>">
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row gap-2 mt-2 lg:mt-5">
                    <div class="form-group w-full">
                        <label for="birth" class="text-dark dark:text-txtdark">Birth <span class="text-red-500">*</span></label><br>
                        <input type="date" name="birth" id="birth" class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full" value="<?= $member['birth'] ?>">
                    </div>
                    <div class="form-group w-full">
                        <label for="gender" class="text-dark dark:text-txtdark">Gender <span class="text-red-500">*</span></label><br>
                        <select name="gender" id="gender" class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full">
                            <option value="<?= $member['gender'] ?>"><?= $member['gender'] ?></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-group w-full mt-2 lg:mt-5">
                    <label for="address" class="text-dark dark:text-txtdark">Address <span class="text-red-500">*</span></label><br>
                    <textarea type="text" name="address" id="address" class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full" placeholder="Add address..."><?= $member['address'] ?></textarea>
                </div>
                <div class="form-group w-full">
                    <label for="img_member" class="text-dark dark:text-txtdark">Image <span class="text-red-500">*</span></label><br>
                    <img src="../dist/img/imgMember/<?= $member['img_member'] ?>" alt="" class="w-28 h-36 mb-2 object-cover">
                    <input type="file" name="img_member" id="img_member" class="bg-white dark:text-txtdark border bg-opacity-[40%] p-4 rounded-xl w-full">
                </div>
                <div class="flex flex-col lg:flex-row gap-2 mt-2 lg:mt-5">
                    <button type="submit" name="submit" class="block py-3 rounded-xl bg-sky-600 text-center w-full lg:w-[80%] text-white font-bold">Submit</button>
                    <button type="reset" class="block py-3 rounded-xl bg-primary text-center w-full lg:w-[20%] text-white font-bold">Reset</button>
                </div>
            </form>
        </div>
</section>
    
<!-- main content end -->

<?php include 'template/footer.php'; ?>