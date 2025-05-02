<?php

/*
 * Cek Login
 *
 * Cek apakah user berhasil login
 *
 */
session_start();
require_once __DIR__ .  '/../conf/connection.php';
require_once __DIR__ . '/../conf/function.php';

if (isset($_POST['signin'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    /*
     * Pertama, cek apakah email ada di database
     */
    $query = "SELECT email, account_id FROM accounts WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query gagal: " . mysqli_error($conn));
    }

    $row = mysqli_num_rows($result);

    // Cek jika query mengembalikan baris
    if ($row > 0) {

        $account = mysqli_fetch_assoc($result);

        if ($account) {

            $accountID = $account['account_id'];
            /*
             * Kedua, cek apakah password benar
             */
            // Dapatkan password dari table accounts berdasarkan account_id
            $accountQuery = "SELECT password FROM accounts WHERE account_id = $accountID";
            $accountResult = mysqli_query($conn, $accountQuery);

            // Jika query gagal, tampilkan pesan error
            if (!$accountResult) {
                die("Query gagal: " . mysqli_error($conn));
            }

            $accountPassword = mysqli_fetch_assoc($accountResult);

            if ($accountPassword && password_verify($password, $accountPassword['password'])) {

                /**
                 * Ketiga, dapatkan data member dari table memberships
                 */
                $members = mysqli_query($conn, "SELECT * FROM memberships WHERE account_id = $accountID");

                if (!$members) {
                    die("Query gagal: " . mysqli_error($conn));
                }

                $member = mysqli_fetch_assoc($members);

                if ($member) {
                    session_unset();
                    // Set session variable
                    $_SESSION['username'] = $member['member_name'];
                    $_SESSION['points'] = $member['points'];
                    $_SESSION['memberId'] = $member['member_id'];
                    $_SESSION['accountId'] = $member['account_id'];
                    $_SESSION['memberImage'] = $member['member_image'];
                    $_SESSION['isLogin'] = true;

                    // Redirect ke halaman index
                    header('location: /?in=1');
                    exit();
                } else {

                    // Redirect ke halaman login dengan pesan error
                    header('location: /login/?in=-3');
                }
            } else {

                // Redirect ke halaman login dengan pesan error
                header('location: /login/?in=-2');
            }
        } else {

            // Redirect ke halaman login dengan pesan error
            header('location: /login/?in=-1');
        }
    } else {

        // Redirect ke halaman login dengan pesan error
        header('location: /login/?in=0');
    }
}
