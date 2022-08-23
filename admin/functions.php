<?php
// koneksi database
$conn = mysqli_connect("localhost", "root", "", "libraryJGU");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function queryArr($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_array($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function create($data) {
    global $conn;
    $author = htmlspecialchars($data["author"]);
    $id_user = htmlspecialchars($data["id_user"]);
    $code_book = htmlspecialchars($data["code_book"]);
    $title = htmlspecialchars($data["title"]);
    $category = htmlspecialchars($data["category"]);
    $language = htmlspecialchars($data["language"]);
    $pages = htmlspecialchars($data["pages"]);
    $description = htmlspecialchars($data["description"]);

    //create slug
    $slugTemp = strtolower($title);
    $slug = str_replace(' ', '-', $slugTemp);

    //upload gambar
    $cover = uploadImage();
    if( !$cover ) {
        return false;
    }

    // query insert
    $query = "INSERT INTO books VALUES
                    ('', '$code_book' ,'$id_user', '$slug', '$author', '$title', '$category', '$language', '$pages', '$description', '$cover', '')
                    ";
    mysqli_query($conn, $query);

    // update total comment user
    $query2 = "UPDATE categories SET total_book = total_book+1 WHERE id_category= '$category'";
    mysqli_query($conn, $query2);
   
    // update total comment book
    $query3 = "UPDATE books SET total_comment = total_comment+1 WHERE code_book= '$code_book'";
    mysqli_query($conn, $query3);

    return mysqli_affected_rows($conn);
}


function uploadImage() {
    $filename = $_FILES['cover']['name'];
    $filesize = $_FILES['cover']['size'];
    $error = $_FILES['cover']['error'];
    $tmpname = $_FILES['cover']['tmp_name'];

    //cek apakah tidak ada gambar yang di upload
    if( $error === 4 ) {
        echo "<script>alert('Please choose a cover first!')</script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $imgExtValid = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'tiff'];
    $imgExt = explode('.', $filename);
    $imgExt = strtolower(end($imgExt));
    if( !in_array($imgExt, $imgExtValid) ) {
        echo "<script>alert('What you uploaded is not an image!')</script>";
        return false;
    }

    //cek jika ukurannya terlalu besar
    if( $filesize > 10000000) {
        echo "<script>alert('Image size is too big!')</script>";
        return false;
    }

    //lolos pengecekan, gambar siap di upload
    // generate nama baru
    $filenameNew = uniqid();
    $filenameNew .= '.';
    $filenameNew .= $imgExt;
    move_uploaded_file($tmpname, '../dist/img/cover/' . $filenameNew);

    return $filenameNew;
}

function create_member($data) {
    global $conn;
    $code_member = htmlspecialchars($data["code_member"]);
    $fullname = htmlspecialchars($data["fullname"]);
    $email = stripslashes($data["email"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $confirm_password = mysqli_real_escape_string($conn, $data["confirm_password"]);
    $birth = htmlspecialchars($data["birth"]);
    $gender = htmlspecialchars($data["gender"]);
    $address = htmlspecialchars($data["address"]);
    $role = htmlspecialchars($data["role"]);

    //slug
    $slugTemp = strtolower($fullname);
    $slug = str_replace(' ', '-', $slugTemp);

    //upload gambar
    $img_member = uploadImageMember();
    if( !$img_member ) {
        return false;
    }

    //cek email sudah apa/blm
    $result = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
    if(mysqli_fetch_assoc($result)) {
        echo "<script>alert('Email already taken!')</script>";
        return false;
    }

    // cek confirm pass
    if($password != $confirm_password) {
        echo "<script>alert('Password does not match!')</script>";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // query insert
    $query = "INSERT INTO users VALUES
                    ('', '$code_member' ,'$fullname', '$slug', '$email', '$password', '$birth', '$gender', '$address', '$img_member', '$role', 0)
                    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function uploadImageMember() {
    $filename = $_FILES['img_member']['name'];
    $filesize = $_FILES['img_member']['size'];
    $error = $_FILES['img_member']['error'];
    $tmpname = $_FILES['img_member']['tmp_name'];

    //cek apakah tidak ada gambar yang di upload
    if( $error === 4 ) {
        echo "<script>alert('Please choose a image first!')</script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $imgExtValid = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'tiff'];
    $imgExt = explode('.', $filename);
    $imgExt = strtolower(end($imgExt));
    if( !in_array($imgExt, $imgExtValid) ) {
        echo "<script>alert('What you uploaded is not an image!')</script>";
        return false;
    }

    //cek jika ukurannya terlalu besar
    if( $filesize > 10000000) {
        echo "<script>alert('Image size is too big!')</script>";
        return false;
    }

    //lolos pengecekan, gambar siap di upload
    // generate nama baru
    $filenameNew = uniqid();
    $filenameNew .= '.';
    $filenameNew .= $imgExt;
    move_uploaded_file($tmpname, '../dist/img/imgMember/' . $filenameNew);

    return $filenameNew;
}

function create_category($data) {
    global $conn;
    $name = htmlspecialchars($data["name"]);
    $description = htmlspecialchars($data["description"]);

    // slug
    $divider = "-";
    $slugTemp = strtolower($name);
    $slug = str_replace(' ', '-', $slugTemp);

    //upload gambar
    $img = uploadImageCategory();
    if( !$img ) {
        return false;
    }

    // query insert
    $query = "INSERT INTO categories VALUES
                    ('', '$name', '$slug', '$description', '$img', '')
                    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function uploadImageCategory() {
    $filename = $_FILES['img']['name'];
    $filesize = $_FILES['img']['size'];
    $error = $_FILES['img']['error'];
    $tmpname = $_FILES['img']['tmp_name'];

    //cek apakah tidak ada gambar yang di upload
    if( $error === 4 ) {
        echo "<script>alert('Please choose a image first!')</script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $imgExtValid = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'tiff'];
    $imgExt = explode('.', $filename);
    $imgExt = strtolower(end($imgExt));
    if( !in_array($imgExt, $imgExtValid) ) {
        echo "<script>alert('What you uploaded is not an image!')</script>";
        return false;
    }

    //cek jika ukurannya terlalu besar
    if( $filesize > 10000000) {
        echo "<script>alert('Image size is too big!')</script>";
        return false;
    }

    //lolos pengecekan, gambar siap di upload
    // generate nama baru
    $filenameNew = uniqid();
    $filenameNew .= '.';
    $filenameNew .= $imgExt;
    move_uploaded_file($tmpname, '../dist/img/imgCategory/' . $filenameNew);

    return $filenameNew;
}

function create_transaction($data) {
    global $conn;
    $code_transaction = htmlspecialchars($data["code_transaction"]);
    $code_member = htmlspecialchars($data["code_member"]);
    $code_book = htmlspecialchars($data["code_book"]);
    $transaction_date = htmlspecialchars($data["transaction_date"]);

    // query insert
    $query = "INSERT INTO transactions VALUES
                    ('', '$code_transaction', '$code_member', '$code_book', '$transaction_date')
                    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function create_comment($data) {
    global $conn;
    date_default_timezone_set("Asia/Jakarta");
    $id_user = htmlspecialchars($data["id_user"]);
    $id_book = htmlspecialchars($data["id_book"]);
    $comment = htmlspecialchars($data["comment"]);
    $time = date_create('now')->format('Y-m-d H:i:s');

    // query insert
    $query = "INSERT INTO comments VALUES
                    ('', '$id_user', '$id_book', '$comment', '$time')
                    ";
    mysqli_query($conn, $query);

    // update total comment user
    $query2 = "UPDATE users SET total_comment = total_comment+1 WHERE id_user= '$id_user'";
    mysqli_query($conn, $query2);

    return mysqli_affected_rows($conn);
}

function delete($id_books) {
    global $conn;

    mysqli_query($conn, "DELETE FROM books WHERE id_books = $id_books");

    return mysqli_affected_rows($conn);
}

function delete_category($id_category) {
    global $conn;

    mysqli_query($conn, "DELETE FROM categories WHERE id_category = $id_category");

    return mysqli_affected_rows($conn);
}

function delete_member($id_user) {
    global $conn;

    mysqli_query($conn, "DELETE FROM users WHERE id_user = $id_user");

    return mysqli_affected_rows($conn);
}

function return_transaction($id_transaction, $code_transaction, $code_member, $code_book, $transaction_date, $return_date) {
    global $conn;

    mysqli_query($conn, "DELETE FROM transactions WHERE id_transaction = $id_transaction");

    // query insert to history
    mysqli_query($conn, "INSERT INTO history VALUES
                    ('', '$code_transaction', '$code_member', '$code_book', '$transaction_date', '$return_date')");

    return mysqli_affected_rows($conn);
}

function delete_transaction($id_transaction) {
    global $conn;

    mysqli_query($conn, "DELETE FROM transactions WHERE id_transaction = $id_transaction");

    return mysqli_affected_rows($conn);
}

function update($data) {
    global $conn;
    $id_books = $data["id_books"];
    $id_user = $data["id_user"];
    $author = htmlspecialchars($data["author"]);
    $title = htmlspecialchars($data["title"]);
    $category = htmlspecialchars($data["category"]);
    $description = htmlspecialchars($data["description"]);
    $oldCover = htmlspecialchars($data["oldCover"]);

    //cek apakah user upload cover baru
    if( $_FILES['cover']['error'] === 4) {
        $cover = $oldCover;
    } else {
        $cover = uploadImage();
    }

    // query update
    $query = "UPDATE books SET 
                id_user = '$id_user',
                author = '$author',
                title = '$title',
                category = '$category',
                books.description = '$description',
                cover = '$cover'
                WHERE id_books = $id_books";
                
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function update_category($data) {
    global $conn;
    $id_category = htmlspecialchars($data["id_category"]);
    $name = htmlspecialchars($data["name"]);
    $description = htmlspecialchars($data["description"]);
    $oldImg = htmlspecialchars($data["oldImg"]);

    // slug
    $slugTemp = strtolower($name);
    $slug = str_replace(' ', '-', $slugTemp);

    //cek apakah user upload img baru
    if( $_FILES['img']['error'] === 4) {
        $img = $oldImg;
    } else {
        $img = uploadImageCategory();
    }

    // query insert
    $query = "UPDATE categories SET
                    categories.name = '$name',
                    categories.description = '$description',
                    slug = '$slug',
                    img = '$img'
                    WHERE id_category = $id_category";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function update_member($data) {
    global $conn;
    $id_user = htmlspecialchars($data["id_user"]);
    $fullname = htmlspecialchars($data["fullname"]);
    $email = stripslashes($data["email"]);
    $birth = htmlspecialchars($data["birth"]);
    $gender = htmlspecialchars($data["gender"]);
    $address = htmlspecialchars($data["address"]);
    $oldImg = htmlspecialchars($data["oldImg"]);

    // slug
    $slugTemp = strtolower($fullname);
    $slug = str_replace(' ', '-', $slugTemp);

    //cek apakah user upload img baru
    if( $_FILES['img_member']['error'] === 4) {
        $img = $oldImg;
    } else {
        $img = uploadImageMember();
    }

    // query update
    $query = "UPDATE users SET
                    fullname = '$fullname',
                    email = '$email',
                    slug_user = '$slug',
                    birth = '$birth',
                    gender = '$gender',
                    users.address = '$address',
                    img_member = '$img'
                    WHERE id_user = $id_user";
    mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);
}

function search($keyword) {
    $query = "SELECT *, books.slug AS book_slug, categories.slug AS category_slug FROM books INNER JOIN categories ON books.category = categories.id_category WHERE
                author LIKE '%$keyword%' OR
                title LIKE '%$keyword%' OR
                categories.name LIKE '%$keyword%'";

    return query($query);
}

function register($data) {
    global $conn;

    $fullname = stripslashes($data["fullname"]);
    $email = stripslashes($data["email"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $confirm_password = mysqli_real_escape_string($conn, $data["confirm_password"]);
    $divider = "-";
    $slugTemp = strtolower($fullname);
    $slug = str_replace(' ', '-', $slugTemp);

    //cek email sudah apa/blm
    $result = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
    if(mysqli_fetch_assoc($result)) {
        echo "<script>alert('Email already taken!')</script>";
        return false;
    }

    // cek confirm pass
    if($password != $confirm_password) {
        echo "<script>alert('Password does not match!')</script>";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // insert ke db
    mysqli_query($conn, "INSERT INTO users VALUES ('', '$fullname', '$slug', '$email', '$password')");

    return mysqli_affected_rows($conn);
}



?>