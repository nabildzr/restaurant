<?php
include_once __DIR__ . '/../partials/layouts/layout-top.php';
require_once __DIR__ .  '/../conf/connection.php';
require_once __DIR__ . '/../conf/function.php';

if (isset($_SESSION['isLogin']) == true) {
?>
    <script>
        window.location.href = "../index.php"
    </script>
<?php
}


?>


<main>



    <form action="log-check.php" method="post">
        <div style="background: black; padding: 100px;  height: 100vh; justify-content: center; display: flex;">
            <div class="submit ">
                <h3 class="main_question" style="color: white;"><strong>100%</strong> Please fill with your details to
                    access member area</h3>
                <div class="col-lg-12">

                    <div class="form-group">
                        <input type="email" name="email" class="form-control required" placeholder="Email" required>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <input type="password" name="password" class="form-control required" placeholder="Password">
                    </div>
                </div>

                <div class="form-group">
                    <label class="" style="color: white;">Don't have an account? <a
                            href="/register/">Register</a></label>
                </div>



                <div class="form-group terms">
                    <label class="container_check" style="color: white;">Please accept our <a href="#"
                            data-bs-toggle="modal" data-bs-target="#terms-txt">Terms and conditions</a>
                        <input type="checkbox" name="terms" value="Yes" class="required">
                        <span class="checkmark"></span>
                    </label>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <button type="submit" name="signin" class="btn_1">Add to cart</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- /step-->


</main>
<!-- /main -->


<?php include_once __DIR__ . '/../partials/layouts/layout-bottom.php' ?>