<?php
require 'connection.php';

function query($query)
{
    global $conn;

    $rows =  [];

    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function addMembership($data)
{
    global $conn;

    $idAccount = htmlspecialchars($data['account_id']);
    $idMember = htmlspecialchars($data['member_id']);
    $memberName = htmlspecialchars($data['member_name']);
    $points = htmlspecialchars($data['points']);
    $email = htmlspecialchars($data['email'] ?? '');
    $phoneNumber = htmlspecialchars($data['phone_number'] ?? '');
    $registerDate = htmlspecialchars($data['register_date']);
    $password = htmlspecialchars($data['password']);
    $passwordhash = password_hash($password, PASSWORD_DEFAULT);

    $query1 = "INSERT INTO accounts (email, register_date, phone_number, password) VALUES (
    '$email',
    '$registerDate',
    '$phoneNumber',
    '$passwordhash'
    )";

    mysqli_query($conn, $query1);

    $query2 = "INSERT INTO memberships (member_id, member_name, points, account_id) VALUES (
    $idMember,
    '$memberName',
    '$points',
    $idAccount
    )";

    mysqli_query($conn, $query2);


    return mysqli_affected_rows($conn);
}

function editMembership($data)
{
    global $conn;

    $memberId = htmlspecialchars($data['member_id']);
    $memberName = htmlspecialchars($data['member_name']);
    $points = htmlspecialchars($data['points']);

    $query = "UPDATE memberships SET member_name = '$memberName', points = $points WHERE member_id = $memberId";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function deleteMemberships($id)
{
    global $conn;

    $query2 = "DELETE FROM memberships WHERE account_id = $id";
    mysqli_query($conn, $query2);

    $query1 = "DELETE FROM accounts WHERE account_id = $id";
    mysqli_query($conn, $query1);

    return mysqli_affected_rows($conn);
}
























function addStaff($data)
{
    global $conn;

    $idAccount = htmlspecialchars($data['account_id']);
    $idStaff = htmlspecialchars($data['staff_id']);
    $staffName = htmlspecialchars($data['staff_name']);
    $staffPassword = htmlspecialchars($data['password']);
    $passwordhash = password_hash($staffPassword, PASSWORD_DEFAULT);
    $staffEmail = htmlspecialchars($data['staff_email']);
    $staffRole = htmlspecialchars($data['staff_role']);
    $registerDate = htmlspecialchars($data['register_date']);
    $staffPhone = htmlspecialchars($data['staff_phone']);

    // account
    $query1 = "INSERT INTO accounts (email, phone_number, register_date, password) VALUES (
    '$staffEmail',
    '$staffPhone',
    '$registerDate',
    '$passwordhash'
    )
    ";

    mysqli_query($conn, $query1);

    // staff
    $query2 = "INSERT INTO staff (staff_id, staff_name, staff_role, account_id) VALUES (
    '$idStaff',
    '$staffName',
    '$staffRole',
    '$idAccount'
    )";

    mysqli_query($conn, $query2);



    // $query = "INSERT INTO staff (staff_name, password, staff_email, staff_role, register_date, staff_phone, account_id) VALUES(
    //     '$staffName', '$passwordhash', '$staffEmail', '$staffRole', '$registerDate', $staffPhone, $AccountID
    // )";


    return mysqli_affected_rows($conn);
}

function editStaff($data)
{
    global $conn;

    $accountId = htmlspecialchars($data['account_id']);
    $staffId = htmlspecialchars($data['staff_id']);
    $staffName = htmlspecialchars($data['staff_name']);
    $email = htmlspecialchars($data['email']);
    $staffRole = htmlspecialchars($data['staff_role']);
    $registerDate = htmlspecialchars($data['register_date']);
    $phoneNumber = htmlspecialchars($data['phone_number']);


    $queryStaff = $conn->prepare("UPDATE staff SET staff_name = ?, staff_role = ? WHERE staff_id = ?");
    $queryStaff->bind_param("ssi", $staffName, $staffRole, $staffId);
    $queryStaff->execute();



    $queryAccount = "UPDATE  accounts SET 
   email = '$email',
   register_date =  '$registerDate',
   phone_number = '$phoneNumber'
   WHERE account_id = $accountId
   ";


    mysqli_query($conn, $queryAccount);


    return mysqli_affected_rows($conn);
}

function deleteStaff($id)
{
    global $conn;

    $query2 = "DELETE FROM staff WHERE account_id = $id";
    mysqli_query($conn, $query2);
    $query1 = "DELETE FROM accounts WHERE account_id = $id";
    mysqli_query($conn, $query1);


    return mysqli_affected_rows($conn);
}
















// Function to get the next available account ID
function getNextAvailableAccountID()
{
    global $conn;

    $sql = "SELECT MAX(account_id) as max_account_id FROM Accounts";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $next_account_id = $row['max_account_id'] + 1;
    return $next_account_id;
}




// Function to generate UUID
// Function to generate random ID with specified length
function generateRandomID($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomID = '';
    for ($i = 0; $i < $length; $i++) {
        $randomID .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomID;
}






function addMenu($data)
{
    global $conn;

    $menuID = htmlspecialchars($data['menu_id']);
    $menuName = htmlspecialchars($data['menu_name']);
    $menuType = htmlspecialchars($data['menu_type']);
    $menuPrice = htmlspecialchars($data['menu_price']);
    $menuDiscountStatus = htmlspecialchars($data['discount_status']);
    $menuDiscount = htmlspecialchars($data['discount']);
    $menuDescription = htmlspecialchars($data['menu_description']);

    // Validasi jika input discount lebih dari sama dengan 100 maka akan di redirect dan gagal menambahkan
    if ($menuDiscount >= 100) {
        echo "<script>window.location.href = 'index.php?alert=22'</script>";
        return false;
    }

    // Validasi jika ada kesalahan pada proses uploadGambar()
    $menuImage = uploadGambar();
    if (!$menuImage) {
        return false;
    }

    // Validasi untuk discount
    if ($menuDiscount < 0 || $menuDiscount > 999.99) {
        echo "<script>window.location.href = 'index.php?alert=20'</script>";
        return false;
    }

    
  

    // Generate random sale_id with length 11
    // $saleID = generateRandomID(11);

    $query = "INSERT INTO menu (item_id, item_name, item_type, item_price, item_description, item_image, discount_status, discount) VALUES(
        '$menuID', '$menuName', '$menuType',  $menuPrice, '$menuDescription', '$menuImage', $menuDiscountStatus, $menuDiscount
    )";
    mysqli_query($conn, $query);

  // Ambil item_description_id terbesar untuk menambahkan yang terbaru
  $queryDescriptionID = "SELECT MAX(item_description_id) as max_item_description_id FROM menu_description";
  $resultDescriptionID = mysqli_query($conn, $queryDescriptionID);
  $rowDescriptionID = mysqli_fetch_assoc($resultDescriptionID);
  $itemDescriptionID = $rowDescriptionID['max_item_description_id'] + 1;


  $queryDescription = "INSERT INTO menu_description (item_description_id, item_id) VALUES ($itemDescriptionID,'$menuID')";
  mysqli_query($conn, $queryDescription);





    // $queryImage = "INSERT INTO images (image_name) VALUES ('$menuName') WHERE item_id = '$menuID'";


    // $image = file_get_contents(__DIR__ ."\images\$menuImage");

    // $stmt = mysqli_prepare($conn, $queryImage);

    // mysqli_stmt_bind_param($stmt, "ss", $menuName);

    return mysqli_affected_rows($conn);
}


function deleteMenu($id)
{
    global $conn;

    $querySale = "DELETE FROM menu_sales WHERE item_id = '$id'";
    mysqli_query($conn, $querySale);

    $query1 = "DELETE FROM menu WHERE item_id = '$id'";
    mysqli_query($conn, $query1);


    return mysqli_affected_rows($conn);
}

function editMenu($data)
{
    global $conn;

    $menuName = htmlspecialchars($data['item_name']);
    $menuType = htmlspecialchars($data['item_type']);
    $menuPrice = htmlspecialchars($data['item_price']);
    $menuDiscountStatus = htmlspecialchars($data['discount_status']);
    $menuDiscount = htmlspecialchars($data['discount']);
    $menuDescription = htmlspecialchars($data['item_description']);
    $menuId = htmlspecialchars($data['item_id']);

    $query = "UPDATE menu SET
        item_name = '$menuName',
        item_type = '$menuType',
        item_price = $menuPrice,
        item_description = '$menuDescription',
        discount = $menuDiscount,
        discount_status = $menuDiscountStatus
        ";


    // Cek apakah ada file gambar yang diunggah
    if ($_FILES['item_image'] && $_FILES['item_image']['error'] !== 4) {
        $menuImage = uploadGambar();
        if ($menuImage) {
            $query .= ", item_image = '$menuImage'";
        }
    }

    $query .= " WHERE item_id = '$menuId'";


    mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);
}







// upload gambar ini hanya digunakan untuk photo menu saja
function uploadGambar()
{


    // ambil data file gambar dari variable $_FILES
    $namaFile = $_FILES['item_image']['name'];
    $ukuranFile = $_FILES['item_image']['size'];
    $error = $_FILES['item_image']['error'];
    $tmpName = $_FILES['item_image']['tmp_name'];

    if ($error === 4) {
        echo "<script>alert('None Selected')</script>";
        return false;
    }

    // Validasi ukuran gambar
    // [$width, $height] = getimagesize($tmpName);
    // if ($width < 500 || $height < 500) {
    //     echo "<script>window.location.href = 'index.php?alert=21'</script>";
    //     return false;
    // }

    // cek apakah yang diupload adalah gambar

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'gif'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>alert('Format gambar yang diupload salah')</script>";
        return false;
    }

    // cek jika ukuran file terlalu besar
    if ($ukuranFile > 10000000) {
        echo "
        <script>
            alert('File size too big.')
        </script>";
        return false;
    }

    // generate nama baru untuk gambar
    $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
    // $namaFileBaru = uniqid();
    // $namaFileBaru .= '.';
    // $namaFileBaru .= $ekstensiGambar;


    // upload gambar ke folder images
    move_uploaded_file($tmpName, '../images/' . $namaFileBaru);

    return $namaFileBaru;
}


// 
function getEnumValues($table, $column)
{
    global $conn;

    $query = "SHOW COLUMNS FROM $table LIKE '$column'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $type = $row['Type'];
    preg_match('/^enum\((.*)\)$/', $type, $matches);
    $enum = explode(',', $matches[1]);
    return array_map(function ($value) {
        return trim($value, "'");
    }, $enum);
}


// Function to get the next available Staff ID
function getNextAvailableStaffID()
{
    global $conn;

    $sql = "SELECT MAX(staff_id) as max_staff_id FROM Staff";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $next_staff_id = $row['max_staff_id'] + 1;
    return $next_staff_id;
}


// Function to get the next available Staff ID
function getNextAvailableMemberID()
{
    global $conn;

    $sql = "SELECT MAX(member_id) as max_member_id FROM memberships";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $next_member_id = $row['max_member_id'] + 1;
    return $next_member_id;
}

// this is for add menu





function updateProfileStaff($data)
{
    global $conn;

    $accountId = $data['account_id'];
    $name = $data['username'];
    $email = $data['email'];
    $phoneNumber = $data['phone_number'];
    $userImageOld = $data['user_image_old'];

    $userImage = ($_FILES['user_image']['error'] === 4) ? $userImageOld : changeProfileImage();

    $phoneNumber = trim($phoneNumber);

    $query = "UPDATE accounts SET email = '$email' , phone_number = '$phoneNumber' WHERE account_id = $accountId";



    mysqli_query($conn, $query);
    $result1 = mysqli_affected_rows($conn);

    $queryUser = "UPDATE staff SET staff_name = '$name', staff_image = '$userImage' WHERE account_id = $accountId";

    mysqli_query($conn, $queryUser);
    $result2 = mysqli_affected_rows($conn);

    return $result1 + $result2;
}

function updatePassword($data)
{
    global $conn;
    $accountId = $data['account_id'];

    $passwordNew = htmlspecialchars($data['passwordNew']);
    $passwordConfirm = htmlspecialchars($data['passwordConfirm']);
    $passwordhash = password_hash($passwordNew, PASSWORD_DEFAULT);



    if ($passwordNew !== $passwordConfirm) {
        echo "<script>
               Swal.fire({
                        icon: 'error',
                        text: 'Failed to Update, Password not matching',
                        showConfirmButton: false,

                        timer: 2500,
                    })
        </script>";
        return false;
    }

    $query = "UPDATE accounts SET password = '$passwordhash' WHERE account_id = $accountId";
    mysqli_query($conn, $query);



    return mysqli_affected_rows($conn);
}

function changeProfileImage()
{


    // ambil data file gambar dari variable $_FILES
    $namaFile = $_FILES['user_image']['name'];
    $ukuranFile = $_FILES['user_image']['size'];
    $error = $_FILES['user_image']['error'];
    $tmpName = $_FILES['user_image']['tmp_name'];




    // Check if a new image was uploaded
    if ($error === 4) { // 4 means no file was uploaded
        echo "<script>aler('Photo belum di isi.')</script>";

        return false; // Return null to indicate no new image
    }



    // cek apakah yang diupload adalah gambar

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'gif'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>alert('Format gambar yang diupload salah')</script>";
        return false;
    }

    // cek jika ukuran file terlalu besar
    if ($ukuranFile > 10000000) {
        echo "
        <script>
            alert('File size too big.')
        </script>";
        return false;
    }

    // generate nama baru untuk gambar
    $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
    // $namaFileBaru = uniqid();
    // $namaFileBaru .= '.';
    // $namaFileBaru .= $ekstensiGambar;


    // upload gambar ke folder images
    move_uploaded_file($tmpName, __DIR__ . '/assets/images/users/' . $namaFileBaru);

    return $namaFileBaru;
}


// 
// TABLES
// 

function getNextAvailableTableID()
{
    global $conn;
    $query = "SELECT MAX(table_id) as max_table_id FROM Restaurant_Tables";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $next_table_id = $row['max_table_id'] + 1;
    return $next_table_id;
}


function addTable($data) {
    global $conn;

    $tableID = $data['table_id'];
    $tableCapacity = htmlspecialchars($data['capacity']);

    $query = "INSERT INTO restaurant_tables (table_id, capacity) VALUES ($tableID, $tableCapacity)";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function deleteTable($tableID) {
    global $conn;


    $query = "DELETE FROM restaurant_tables WHERE table_id = $tableID";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function editTable($data) {
    global $conn;

    $tableID = $data['table_id'];
    $tableCapacity = $data['capacity'];

    $query = "UPDATE restaurant_tables SET capacity = $tableCapacity WHERE table_id = $tableID";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}