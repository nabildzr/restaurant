<?php

require_once __DIR__ . '/connection.php';



// query yang disini digunakan untuk bagian beranda/didepan saja atau bagian client saja

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


function getNextAvailableAccountID()
{
    global $conn;
    // query untuk mendapatkan nilai terbesar dari kolom account_id di table Accounts
    // nilai terbesar di tambah 1 untuk mendapatkan nilai yang belum di gunakan
    $query = "SELECT MAX(account_id) as max_account_id FROM Accounts";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $next_account_id = $row['max_account_id'] + 1;
    return $next_account_id;

}

function getNextAvailableMemberID()
{
    global $conn;
    // query untuk mendapatkan nilai terbesar dari kolom member_id di table memberships
    // nilai terbesar di tambah 1 untuk mendapatkan nilai yang belum di gunakan
    $query = "SELECT MAX(member_id) as max_member_id FROM memberships";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $next_member_id = $row['max_member_id'] + 1;
    return $next_member_id;
}


// hanya perlu mengisi parameter nya saja jadi function ini dapat di gunakan lagi tidak hanya untuk member_id, account_id saja tapi hanya dengan 1 function bisa di gunakan lagi untuk lain hal NextAvailable
function getNextAvailable($column, $as, $table)
{
    global $conn;


    // query untuk mendapatkan nilai terbesar dari kolom yang di tentukan
    // misal kita ingin mendapatkan nilai terbesar dari kolom member_id di table memberships
    // maka query nya akan seperti ini
    $query = "SELECT MAX(" . $column . ") as " . $as . " FROM " . $table;
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $next_member_id = $row[$as] + 1;
    return $next_member_id;
}


function register($data)
{
    global $conn;
    $accountId = getNextAvailableAccountID();
    $memberId = getNextAvailableMemberID();

    // data yang di kirimkan dari form
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $email = htmlspecialchars($data['email']);

    // enkripsi password
    $passwordhash = password_hash($password, PASSWORD_DEFAULT);

    // cek apakah email sudah ada di database
    $queryEmail = query("SELECT email FROM accounts WHERE email = '$email'");

    if (count($queryEmail) > 0) {
        echo "<script>window.location.href = '/register/?reg=-1'</script>";
        return false;
    }

    // tanggal pendaftaran
    $registerDate = date('Y-m-d');

    // insert data ke database
    $queryAccount = "INSERT INTO accounts (email, password, register_date) VALUES (
    '$email',
    '$passwordhash',
    '$registerDate'
  )";

    mysqli_query($conn, $queryAccount);

    // insert data ke table memberships
    $queryMembership = "INSERT INTO memberships (member_id, member_name, account_id) VALUES (
    $memberId,
    '$username',
    $accountId
    )
    ";
    mysqli_query($conn, $queryMembership);


    return mysqli_affected_rows($conn);
}


function addToCart($data)
{
    // Mendapatkan id cart yang akan di tambahkan dengan 1
    global $conn;
    $cartId = getNextAvailable("cart_id", "next_cart_id", "cart");

    // Mendapatkan data yang di kirimkan dari form
    $itemId = htmlspecialchars($data['item_id']);
    $memberId = $data['member_id'];
    $quantity = $data['quantity_1'];

    // Jika quantity lebih dari 10 maka akan di arahkan ke halaman shop-single.php dengan parameter status = 3
    if ($quantity > 10) {
        echo "<script>window.location.href = '/shop/shop-single.php?id=" . $itemId . "&status=3</script>";
        return 5;
    }

    // Jika quantity lebih dari 11 maka akan di arahkan ke halaman shop-single.php dengan parameter status = 5
    if($quantity > 11) {
        echo "<script>window.location.href = '/shop/shop-single.php?id=" . $itemId . "&status=5</script>";
        return 4;
    }


    // Mengecek apakah item yang akan di tambahkan sudah ada di dalam cart
    $query = "SELECT * FROM cart WHERE member_id = $memberId AND item_id = '$itemId'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Jika item sudah ada di dalam cart maka akan di update quantity nya
    if (mysqli_num_rows($result) > 0) {
        // Jika quantity yang akan di tambahkan lebih dari 10 maka akan di arahkan ke halaman shop-single.php dengan parameter status = 4
        if($row['quantity'] + $quantity > 10) {
            echo "<script>window.location.href = '/shop/shop-single.php?id=" . $itemId . "&status=4</script>";
            return 14;
        }


        // added_at = now() artinya mengupdate waktu saat item di tambahkan ke cart dengan waktu sekarang
        $query = "UPDATE cart SET quantity = quantity + $quantity, added_at = NOW() WHERE member_id = $memberId AND item_id = '$itemId'";


        mysqli_query($conn, $query);

        
    } else {
        // Jika item belum ada di dalam cart maka akan di tambahkan ke dalam cart
        $query = "INSERT INTO cart (cart_id, member_id, item_id, quantity, purchased, status, added_at) VALUES (
            $cartId,
            $memberId,
            '$itemId',
            $quantity,
            0,
            'waiting',
            NOW()
        )";
        mysqli_query($conn, $query);
    }

    // Mengembalikan nilai yang di kembalikan oleh mysqli_affected_rows()
    return mysqli_affected_rows($conn);
}

function deleteCart($memberId, $itemId) {
    global $conn;
    $query = "DELETE FROM cart WHERE member_id = $memberId AND item_id = '$itemId'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}