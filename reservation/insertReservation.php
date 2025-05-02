<?php
// reservation.php
// digunakan untuk menghandle form reservation
require_once __DIR__ .  '/../conf/function.php';

session_start();

// jika form di submit maka jalankan kode di bawah
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // dapatkan nilai dari form
    $member_name = $_POST["member_name"];
    $table_id = intval($_POST["table_id"]);
    $reservation_time = $_POST["reservation_time"];
    $reservation_date = $_POST["reservation_date"];
    $special_request = $_POST["special_request"];
    $member_id = $_SESSION['memberId']; // dapatkan member_id dari session

    // cek apakah user sudah pernah reservation sebelumnya
    $check_reservation_query = "SELECT * FROM reservations WHERE member_id='$member_id'";
    $check_reservation_result = mysqli_query($conn, $check_reservation_query);
    $check_reservation_count = mysqli_num_rows($check_reservation_result);

    // jika user sudah pernah reservation sebelumnya maka redirect ke halaman utama dengan parameter reservation=failed
    if ($check_reservation_count > 0) {
        header("Location: index.php?reservation=failed");

        exit();
    }

    // dapatkan capacity dari table yang dipilih
    $select_query_capacity = "SELECT capacity FROM restaurant_tables WHERE table_id='$table_id';";
    $results_capacity = mysqli_query($conn, $select_query_capacity);

    // jika data capacity berhasil di dapatkan maka jalankan kode di bawah
    if ($results_capacity) {
        $row = mysqli_fetch_assoc($results_capacity);
        $head_count = $row['capacity']; // dapatkan head_count dari tabel restaurant_tables

        // generate reservation_id dengan cara menggabungkan reservation_time, reservation_date, dan table_id
        $reservation_id = intval($reservation_time)  . intval($reservation_date)  . intval($table_id);

        // siapkan query untuk insert data ke tabel Reservations dan Table_Availability
        $insert_query1 = "INSERT INTO Reservations (reservation_id, member_id, member_name, table_id, reservation_time, reservation_date, head_count, special_request) 
                        VALUES ('$reservation_id', $member_id, '$member_name', '$table_id', '$reservation_time', '$reservation_date', '$head_count', '$special_request');";

        // jika user sudah pernah reservation sebelumnya maka redirect ke halaman utama dengan parameter reservation=failed
        if ($check_reservation_count > 0) {
            echo "<script>alert('Anda sudah mereservasi sebelumnya, tunggu staff menerima pesan reservasi anda.'); window.location.href = 'index.php';</script>";
            exit();
        }
        

        $insert_query2 = "INSERT INTO Table_Availability (availability_id, table_id, reservation_date, reservation_time, status) 
                        VALUES ('$reservation_id', '$table_id', '$reservation_date', '$reservation_time',  1);";

        // jalankan query insert
        mysqli_query($conn, $insert_query1);
        
        mysqli_query($conn, $insert_query2);

        // set session untuk menyimpan nama member yang melakukan reservation
        $_SESSION['member_name'] = $member_name;

        // redirect ke halaman utama dengan parameter reservation=success dan reservation_id=$reservation_id
        header("Location: index.php?reservation=success&reservation_id=$reservation_id");
    } else {
        // handle jika query gagal
        echo "Error fetching table capacity: " . mysqli_error($conn);
    }
}
?>

