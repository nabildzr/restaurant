<?php
session_start();
require_once('conf/connection.php');

if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
    header('Location: /admin/index.php');
    exit();
}









// if username and password has wrong, use buku-tamu.php?error=1
// if ($rows > 0) {
//     $user = mysqli_fetch_assoc($result);
//         $_SESSION['role'] = $user['role'];                                  

//     if (password_verify($password, $user['password'])) {
//         // Login successful, redirect to buku-tamu.php
//         $_SESSION['username'] = $username;
//         $_SESSION['isLogin'] = true;
//         header("Location: app/index.php");
//         exit();
//     } else {
//         header("Location: index.php?error=1");
//         // Login failed, redirect to buku-tamu.php with error=1
//         exit();
//     }
// } else {
//     header("Location: index.php?error=1");
//     // Login failed, redirect to buku-tamu.php with error=1
//     exit();
// }

// if($row && isset($row['password'])) {
//   if($row) {
//     $_SESSION['role'] = $row['staff_role'];
//     $_SESSION['username'] = $row['staff_name'];
//     header('Location: index.php');
//   } else {
//         echo '<script>alert("Ada kesalahan")</script>';
//   }
// } else {
//     echo "<script>alert('Username atau password salah!')</script>";
// }

?>


<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wowdash - Bootstrap 5 Admin Dashboard HTML Template</title>
    <link rel="icon" type="image/png" href="/assets_dashboard/assets/images/favicon.png" sizes="16x16">
    <!-- remix icon font css  -->
    <link rel="stylesheet" href="/assets_dashboard/assets/css/remixicon.css">
    <!-- BootStrap css -->
    <link rel="stylesheet" href="/assets_dashboard/assets/css/lib/bootstrap.min.css">
    <!-- Apex Chart css -->
    <link rel="stylesheet" href="/assets_dashboard/assets/css/lib/apexcharts.css">
    <!-- Data Table css -->
    <link rel="stylesheet" href="/assets_dashboard/assets/css/lib/dataTables.min.css">
    <!-- Text Editor css -->
    <link rel="stylesheet" href="/assets_dashboard/assets/css/lib/editor-katex.min.css">
    <link rel="stylesheet" href="/assets_dashboard/assets/css/lib/editor.atom-one-dark.min.css">
    <link rel="stylesheet" href="/assets_dashboard/assets/css/lib/editor.quill.snow.css">
    <!-- Date picker css -->
    <link rel="stylesheet" href="/assets_dashboard/assets/css/lib/flatpickr.min.css">
    <!-- Calendar css -->
    <link rel="stylesheet" href="/assets_dashboard/assets/css/lib/full-calendar.css">
    <!-- Vector Map css -->
    <link rel="stylesheet" href="/assets_dashboard/assets/css/lib/jquery-jvectormap-2.0.5.css">
    <!-- Popup css -->
    <link rel="stylesheet" href="/assets_dashboard/assets/css/lib/magnific-popup.css">
    <!-- Slick Slider css -->
    <link rel="stylesheet" href="/assets_dashboard/assets/css/lib/slick.css">
    <!-- prism css -->
    <link rel="stylesheet" href="/assets_dashboard/assets/css/lib/prism.css">
    <!-- file upload css -->
    <link rel="stylesheet" href="/assets_dashboard/assets/css/lib/file-upload.css">

    <link rel="stylesheet" href="/assets_dashboard/assets/css/lib/audioplayer.css">

    <!-- sweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- main css -->
    <link rel="stylesheet" href="/assets_dashboard/assets/css/style.css">
</head>

<body>

    <?php

    if (isset($_POST['signin'])) {
        $idStaff = $_POST['staff_id'];
        $password = $_POST['password'];

        $query = "SELECT * FROM staff WHERE staff_id = '$idStaff'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_num_rows($result);

        if (
            $row > 0
        ) {
            $staff = mysqli_fetch_assoc($result);
            $accountID = $staff['account_id'];

            // ambil password yang ada di tabel accounts sesuai id
            $accountQuery = "SELECT password FROM accounts WHERE account_id = '$accountID'";
            $accountResult = mysqli_query($conn, $accountQuery);
            $accountPassword = mysqli_fetch_assoc($accountResult);

            if (password_verify($password, $accountPassword['password'])) {
                session_unset();
                $_SESSION['username'] = $staff['staff_name'];
                $_SESSION['accountId'] = $staff['account_id'];
                $_SESSION['role'] = $staff['staff_role'];
                $_SESSION['isAdmin'] = true;



                header('location: index.php');
                exit();
            } else {
                echo "<script> Swal.fire({
                    icon: 'warning',
                    text: 'Invalid Staff ID or Password. Please try again.',
                    timer: 1500,
                    showConfirmButton: false
                })</script>";
            }
        } else {
            echo "<script>
          setTimeout(() => {
                Swal.fire({
                    icon: 'error',
                    text: 'Invalid Staff ID or Password. Please try again.',
                    timer: 1500,
                    showConfirmButton: false
                })
                setTimeout(() => {
                    window.location.href = 'sign-in.php';
                }, 1600)
          }, 1244)

          
          
        </script>";

            exit();
        }
    }

    ?>

    <section class="auth bg-base d-flex flex-wrap">

        <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
            <div class="max-w-464-px mx-auto w-100">
                <div>
                    <a href="index.php" class="mb-40 max-w-290-px">
                        <img src="/assets/img/logo.svg" alt="">
                    </a>
                    <h4 class="mb-12">Sign In with your Staff ID</h4>
                    <p class="mb-32 text-secondary-light text-lg">Welcome back! please enter your detail</p>
                </div>
                <form method="POST" action="#">
                    <div class="icon-field mb-16">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="mage:user"></iconify-icon>
                        </span>
                        <input type="text" name="staff_id" class="form-control h-56-px bg-neutral-50 radius-12" placeholder="Staff ID">
                    </div>
                    <div class="position-relative mb-20">
                        <div class="icon-field">
                            <span class="icon top-50 translate-middle-y">
                                <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                            </span>
                            <input type="password" class="form-control h-56-px bg-neutral-50 radius-12" name="password" id="your-password" placeholder="Password">
                        </div>
                        <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span>
                    </div>
                    <div class="">
                        <div class="d-flex justify-content-between gap-2">
                            <div class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input border border-neutral-300" type="checkbox" value="" id="remeber">
                                <label class="form-check-label" for="remeber">Remember me </label>
                            </div>
                            <a href="javascript:void(0)" class="text-primary-600 fw-medium">Forgot Password?</a>
                        </div>
                    </div>

                    <button type="submit" name="signin" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32"> Sign In</button>

                    <div class="mt-32 center-border-horizontal text-center">
                        <span class="bg-base z-1 px-4">Or sign in with</span>
                    </div>
                    <div class="mt-32 d-flex align-items-center gap-3">
                        <button type="button" class="fw-semibold text-primary-light py-16 px-24 w-50 border radius-12 text-md d-flex align-items-center justify-content-center gap-12 line-height-1 bg-hover-primary-50">
                            <iconify-icon icon="ic:baseline-facebook" class="text-primary-600 text-xl line-height-1"></iconify-icon>
                            Google
                        </button>
                        <button type="button" class="fw-semibold text-primary-light py-16 px-24 w-50 border radius-12 text-md d-flex align-items-center justify-content-center gap-12 line-height-1 bg-hover-primary-50">
                            <iconify-icon icon="logos:google-icon" class="text-primary-600 text-xl line-height-1"></iconify-icon>
                            Google
                        </button>
                    </div>
                    <div class="mt-32 text-center text-sm">
                        <p class="mb-0">Don’t have an account? <a href="sign-up.php" class="text-primary-600 fw-semibold">Sign Up</a></p>
                    </div>

                </form>
            </div>
        </div>
        <div class="auth-left d-lg-block d-none">
            <div class="d-flex  flex-column h-100 justify-content-center">
                <img style="width: 100%; height: 100%; object-fit: cover;" class="" src="https://i.pinimg.com/originals/7e/05/75/7e05759481fa150d06c259c8d81b97da.gif" alt="">


            </div>
        </div>
    </section>

    <!-- jQuery library js -->
    <script src="/assets_dashboard/assets/js/lib/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap js -->
    <script src="/assets_dashboard/assets/js/lib/bootstrap.bundle.min.js"></script>
    <!-- Apex Chart js -->
    <script src="/assets_dashboard/assets/js/lib/apexcharts.min.js"></script>
    <!-- Data Table js -->
    <script src="/assets_dashboard/assets/js/lib/dataTables.min.js"></script>
    <!-- Iconify Font js -->
    <script src="/assets_dashboard/assets/js/lib/iconify-icon.min.js"></script>
    <!-- jQuery UI js -->
    <script src="/assets_dashboard/assets/js/lib/jquery-ui.min.js"></script>
    <!-- Vector Map js -->
    <script src="/assets_dashboard/assets/js/lib/jquery-jvectormap-2.0.5.min.js"></script>
    <script src="/assets_dashboard/assets/js/lib/jquery-jvectormap-world-mill-en.js"></script>
    <!-- Popup js -->
    <script src="/assets_dashboard/assets/js/lib/magnifc-popup.min.js"></script>
    <!-- Slick Slider js -->
    <script src="/assets_dashboard/assets/js/lib/slick.min.js"></script>
    <!-- prism js -->
    <script src="/assets_dashboard/assets/js/lib/prism.js"></script>
    <!-- file upload js -->
    <script src="/assets_dashboard/assets/js/lib/file-upload.js"></script>
    <!-- audioplayer -->
    <script src="/assets_dashboard/assets/js/lib/audioplayer.js"></script>

    <!-- sweetalertsssss -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.all.min.js"></script>


    <!-- main js -->
    <script src="/assets_dashboard/assets/js/app.js"></script>

    <script>
        // ================== Password Show Hide Js Start ==========
        function initializePasswordToggle(toggleSelector) {
            $(toggleSelector).on('click', function() {
                $(this).toggleClass("ri-eye-off-line");
                var input = $($(this).attr("data-toggle"));
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        }
        // Call the function
        initializePasswordToggle('.toggle-password');
        // ========================= Password Show Hide Js End ===========================
    </script>



</body>

</html>