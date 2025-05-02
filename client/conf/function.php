<?php
require_once __DIR__ . '/../conf/connection.php';

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

/**
 * Fungsi untuk mengupdate profil membership
 * 
 * @param array $data array yang berisi data untuk diupdate
 * @return int jumlah baris yang terpengaruh
 */
function updateProfileMemberships($data)
{
    global $conn;

    $accountId = $data['account_id'];
    $name = $data['username'];
    $phoneNumber = $data['phone_number'];
    $userImageOld = $data['user_image_old']; // image yang lama
    $userImageOld = $data['user_image_old'];

    // jika user tidak upload image maka gunakan image yang lama
    // jika user upload image maka gunakan image yang baru
    $userImage = ($_FILES['user_image']['error'] === 4) ? $userImageOld : changeProfileImage();

    // update data di table accounts
    $query1 = "UPDATE accounts SET phone_number = '$phoneNumber' WHERE account_id = $accountId";
    mysqli_query($conn, $query1);
    $affectedRows1 = mysqli_affected_rows($conn);

    // update data di table memberships
    $query2 = "UPDATE memberships SET member_name = '$name', member_image = '$userImage'  WHERE account_id = $accountId";
    mysqli_query($conn, $query2);
    $affectedRows2 = mysqli_affected_rows($conn);

    // return total baris yang terpengaruh
    // karena update dilakukan di 2 tabel maka perlu dijumlahkan
    // agar nilai yang dikembalikan sesuai dengan jumlah baris yang terpengaruh
    return $affectedRows1 + $affectedRows2;
}




function updatePassword($data)
{
    global $conn;
    $accountId = $data['account_id'];

    $passwordNew = htmlspecialchars($data['passwordNew']);
    $passwordConfirm = htmlspecialchars($data['passwordConfirm']);
    $passwordhash = password_hash($passwordNew, PASSWORD_DEFAULT);

    if ($passwordNew !== $passwordConfirm) {
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