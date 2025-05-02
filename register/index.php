<?php
include_once __DIR__ . '/../partials/layouts/layout-top.php';
require_once __DIR__ .  '/../register/reg-check.php';

if (isset($_SESSION['isLogin']) == true) {
?>
    <script>
        window.location.href = "../../index.php"
    </script>
<?php
}

if (isset($_POST['signup'])) {
    if (register($_POST) > 0) {
        echo "<script>window.location.href = '../../login/?reg=1'</script>";
    } else {
        echo "<script>window.location.href = '../../register/?reg=-1'</script>";
    }
}

?>


<main>



    <form action="" method="post">
        <div style="background: black; padding: 100px;  height: 100vh; justify-content: center; display: flex;">
            <div class="submit ">
                <h3 class="main_question" style="color: white;"><strong>100%</strong> Please fill with your details to
                    register an account</h3>
                <div class="col-lg-12">

                    <div class="form-group">
                        <input type="email" name="email" class="form-control required" placeholder="Email" required>
                    </div>
                </div>


                <div class="col-lg-12">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control required" placeholder="Username">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <input type="password" name="password" class="form-control required" placeholder="Password">
                    </div>
                </div>

                <div class="form-group">
                    <label class="" style="color: white;">Already Have an account? <a
                            href="/login/">Login</a></label>
                </div>

                <div class="form-group terms">
                    <label class="container_check" style="color: white;">Please accept our <a href="#"
                            data-bs-toggle="modal" data-bs-target="#terms-txt">Terms and conditions</a>
                        <input type="checkbox" name="terms" value="Yes" class="required" required>
                        <span class="checkmark"></span>
                    </label>
                </div>



                <div class="col-lg-6">
                    <div class="form-group">
                        <button type="submit" name="signup" class="btn_1">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- /step-->


</main>
<!-- /main -->

<?php
// $script = '
// <script>
//     // memvalidasi apakah password dan konfirmasi password sama
//     document.getElementById("password").addEventListener("input", validatePassword);
//     document.getElementById("passwordCheck").addEventListener("input", validatePassword);

//     function validatePassword() {
//         // mendapatkan nilai password dan konfirmasi password
//         var password = document.getElementById("password").value;
//         var passwordCheck = document.getElementById("passwordCheck").value;
//         var icon = document.getElementById("passwordMatchIcon");

//         // jika konfirmasi password kosong maka tidak perlu memvalidasi
//         if (passwordCheck === "") {
//             icon.className = "";
//             return;
//         }



//         // jika password dan konfirmasi password sama (cocok) maka tampilkan icon check
//         if (password === passwordCheck) {
//             icon.innerHTML = "    Correct!  ";
//             icon.className = "fa fa-check-circle text-success";
//         } else {
//             // jika password dan konfirmasi password tidak sama (tidak cocok) maka tampilkan icon times
//             icon.innerHTML = "   Try Again!    ";
//             icon.className = "fa fa-times-circle text-danger";
//         }
//     }
// </script>';

// echo $script;
?>
<!-- footer -->
<?php include_once __DIR__ . '/../partials/layouts/layout-bottom.php' ?>