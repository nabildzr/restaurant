<?php
session_start();
include_once __DIR__ .  '/conf/function.php';

// user

$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);
$segments = explode('/', trim($path, '/'));

// Check if we're in the client directory and have a username
if (count($segments) >= 3 && $segments[1] == 'client') {
    $requestedUsername = urldecode($segments[2]);

    // Check if the user is logged in and the requested profile matches their username
    if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] === true && $_SESSION['username'] === $requestedUsername) {
?>

        <?php

        // variable userData dengan array assoc nya itu dibuat di layoutTop.php

        $title = 'View Profile';
        $subTitle = 'View Profile';
        ?>
        <?php include_once './partials/layouts/layoutTop.php' ?>


        <?php
        if (isset($_POST['saveProfile'])) {
            if (updateProfileMemberships($_POST) > 0) {
        ?>
                <script>
                    window.location.href = "/client/<?= $_SESSION['username'] ?>?updated=1";
                </script>

            <?php
            } else {
            ?>
                <script>
                    window.location.href = "/client/<?= $_SESSION['username'] ?>?updated=0";
                </script>
        <?php
            }
        }

        ?>
        <?php
        if (isset($_POST['savePassword'])) {
            if (updatePassword($_POST) > 0) {
        ?>
                <script>
                    window.location.href = "/client/<?= $_SESSION['username'] ?>?updated=1";
                </script>

            <?php
            } else {
            ?>
                <script>
                    window.location.href = "/client/<?= $_SESSION['username'] ?>?updated=0";
                </script>
        <?php
            }
        }


        ?>




        <div class="row gy-4">
            <div class="col-lg-4">
                <div class="user-grid-card position-relative border radius-16 overflow-hidden bg-base h-100">
                    <img src="https://i.pinimg.com/736x/e9/83/d1/e983d1695c904346be3cf43449d108ef.jpg" alt="" class="w-100 object-fit-cover  h-30">
                    <div class="pb-24 ms-16 mb-24 me-16  mt--100">
                        <div class="text-center border border-top-0 border-start-0 border-end-0">
                            <img src="/assets/images/users/<?= htmlspecialchars($userData['member_image'] ?? 'default.jpg') ?>" alt="" class="border br-white border-width-2-px w-200-px h-200-px rounded-circle object-fit-cover">
                            <h6 class="mb-0 mt-16"><?= htmlspecialchars($userData['member_name'])  ?></h6>
                            <span class="text-secondary-light mb-16"><?= htmlspecialchars($userData['email']) ?></span>
                        </div>
                        <div class="mt-24">
                            <h6 class="text-xl mb-16">Personal Info</h6>
                            <ul>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light">Full Name</span>
                                    <span class="w-70 text-secondary-light fw-medium">: <?= htmlspecialchars($userData['member_name']) ?></span>
                                </li>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light"> Email</span>
                                    <span class="w-70 text-secondary-light fw-medium">: <?= htmlspecialchars($userData['email'])  ?></span>
                                </li>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light"> Phone Number</span>
                                    <span class="w-70 text-secondary-light fw-medium">: <?= $userData['phone_number'] ? htmlspecialchars($userData['phone_number']) : htmlspecialchars('Not added yet.') ?></span>
                                </li>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light"> Register Date</span>
                                    <span class="w-70 text-secondary-light fw-medium">: <?= htmlspecialchars($userData['register_date']) ?></span>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card h-100">
                    <div class="card-body p-24">
                        <ul class="nav border-gradient-tab nav-pills mb-20 d-inline-flex" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link d-flex align-items-center px-24 active" id="pills-edit-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-edit-profile" type="button" role="tab" aria-controls="pills-edit-profile" aria-selected="true">
                                    Edit Profile
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link d-flex align-items-center px-24" id="pills-change-passwork-tab" data-bs-toggle="pill" data-bs-target="#pills-change-passwork" type="button" role="tab" aria-controls="pills-change-passwork" aria-selected="false" tabindex="-1">
                                    Change Password
                                </button>
                            </li>

                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-edit-profile" role="tabpanel" aria-labelledby="pills-edit-profile-tab" tabindex="0">
                                <h6 class="text-md text-primary-light mb-16">Profile Image</h6>
                                <!-- Upload Image Start -->
                                <form method="POST" action="#" enctype="multipart/form-data">
                                    <div class="mb-24 mt-16">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit position-absolute bottom-0 end-0 me-24 mt-16 z-1 cursor-pointer">
                                                <input type='file' name="user_image" id="imageUpload" accept=".png, .jpg, .jpeg" hidden>
                                                <label for="imageUpload" class="w-32-px h-32-px d-flex justify-content-center align-items-center bg-primary-50 text-primary-600 border border-primary-600 bg-hover-primary-100 text-lg rounded-circle">
                                                    <iconify-icon icon="solar:camera-outline" class="icon"></iconify-icon>
                                                </label>
                                            </div>
                                            <div class="avatar-preview">
                                                <div id="imagePreview" style='
                                                background-image: url(
                                                "/assets/images/users/<?= htmlspecialchars($userData['member_image'] ?? 'default.jpg') ?>"
                                                ); 
                                                background-size: cover;
                                                background-repeat: no-repeat;
                                                background-position: center;
                                                '>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Upload Image End -->
                                    <input type="text" name="user_image_old" value="<?= htmlspecialchars($userData['member_image']) ?>" hidden>
                                    <input type="text" name="account_id" value="<?= htmlspecialchars($userData['account_id']) ?>" hidden>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-20">
                                                <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Full Name <span class="text-danger-600">*</span></label>
                                                <input type="text" class="form-control radius-8" id="name" value="<?= htmlspecialchars($userData['member_name']) ?>" name="username" placeholder="Enter Username">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-20">
                                                <label for="email" class="form-label fw-semibold text-primary-light text-sm mb-8">Email <span class="text-danger-600">*</span></label>
                                                <input type="email" class="form-control radius-8" id="email"
                                                    placeholder="<?= htmlspecialchars($userData['email']) ?>" readonly>
                                            </div>
                                        </div>
                                        <style>
                                            input[type="number"]::-webkit-outer-spin-button,
                                            input[type="number"]::-webkit-inner-spin-button {
                                                -webkit-appearance: none;
                                                margin: 0;
                                            }
                                        </style>
                                        <div class="col-sm-6">
                                            <div class="mb-20">
                                                <label for="number" class="form-label fw-semibold text-primary-light text-sm mb-8">Phone</label>
                                                <input type="number" class="form-control radius-8" name="phone_number" id="number" value="<?= htmlspecialchars($userData['phone_number']) ?? htmlspecialchars('') ?>" placeholder="Enter phone number">
                                            </div>
                                        </div>


                                    </div>
                                    <div class="d-flex gap-3">

                                        <button type="submit" name="saveProfile" class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                                            Save
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <form action="" method="POST">
                                <input type="text" name="account_id" value="<?= htmlspecialchars($userData['account_id']) ?>" hidden>

                                <div class="tab-pane fade" id="pills-change-passwork" role="tabpanel" aria-labelledby="pills-change-passwork-tab" tabindex="0">
                                    <div class="mb-20">
                                    </div>
                                    <div class="mb-20">
                                        <label for="your-password" class="form-label fw-semibold text-primary-light text-sm mb-8">New Password <span class="text-danger-600">*</span></label>
                                        <div class="position-relative">
                                            <input type="password" name="passwordNew" class="form-control radius-8" id="your-password" placeholder="Enter New Password*">
                                            <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span>
                                        </div>

                                    </div>
                                    <div class="mb-20">
                                        <label for="confirm-password" class="form-label fw-semibold text-primary-light text-sm mb-8">Confirmed Password <span class="text-danger-600">*</span></label>
                                        <div class="position-relative">
                                            <input type="password" name="passwordConfirm" class="form-control radius-8" id="confirm-password" placeholder="Confirm Password*">
                                            <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#confirm-password"></span>
                                        </div>
                                    </div>
                                    <span id="validateNote" style="letter-spacing: 3px; top: 100px;" class=" "></span>
                                    <div id="savePassword" class="d-flex  gap-3 mt-10">
                                    </div>
                                </div>
                            </form>

                            <!-- <div class="tab-pane fade" id="pills-notification" role="tabpanel" aria-labelledby="pills-notification-tab" tabindex="0">
                                <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                    <label for="companzNew" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                    <div class="d-flex align-items-center gap-3 justify-content-between">
                                        <span class="form-check-label line-height-1 fw-medium text-secondary-light">Company News</span>
                                        <input class="form-check-input" type="checkbox" role="switch" id="companzNew">
                                    </div>
                                </div>
                                <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                    <label for="pushNotifcation" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                    <div class="d-flex align-items-center gap-3 justify-content-between">
                                        <span class="form-check-label line-height-1 fw-medium text-secondary-light">Push Notification</span>
                                        <input class="form-check-input" type="checkbox" role="switch" id="pushNotifcation" checked>
                                    </div>
                                </div>
                                <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                    <label for="weeklyLetters" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                    <div class="d-flex align-items-center gap-3 justify-content-between">
                                        <span class="form-check-label line-height-1 fw-medium text-secondary-light">Weekly News Letters</span>
                                        <input class="form-check-input" type="checkbox" role="switch" id="weeklyLetters" checked>
                                    </div>
                                </div>
                                <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                    <label for="meetUp" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                    <div class="d-flex align-items-center gap-3 justify-content-between">
                                        <span class="form-check-label line-height-1 fw-medium text-secondary-light">Meetups Near you</span>
                                        <input class="form-check-input" type="checkbox" role="switch" id="meetUp">
                                    </div>
                                </div>
                                <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                    <label for="orderNotification" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                    <div class="d-flex align-items-center gap-3 justify-content-between">
                                        <span class="form-check-label line-height-1 fw-medium text-secondary-light">Orders Notifications</span>

                                        <input class="form-check-input" type="checkbox" role="switch" id="orderNotification" checked>
                                    </div>
                                </div>
                            </div> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php $script = ' <script>
                        // ======================== Upload Image Start =====================
                        function readURL(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    $("#imagePreview").css("background-image", "url(" + e.target.result + ")");
                                    $("#imagePreview").hide();
                                    $("#imagePreview").fadeIn(650);
                                }
                                reader.readAsDataURL(input.files[0]);
                            }
                        }
                        $("#imageUpload").change(function() {
                            readURL(this);
                        });
                        // ======================== Upload Image End =====================

                        // ================== Password Show Hide Js Start ==========
                        function initializePasswordToggle(toggleSelector) {
                            $(toggleSelector).on("click", function() {
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
                        initializePasswordToggle(".toggle-password");
                        // ========================= Password Show Hide Js End ===========================
                  
    document.getElementById("your-password").addEventListener("input", validatePassword)
    document.getElementById("confirm-password").addEventListener("input", validatePassword)



    function validatePassword() {
        
    var newPassword = document.getElementById("your-password").value;
    var verifyPassword = document.getElementById("confirm-password").value;
    var validateNote = document.getElementById("validateNote");
    var savePassword = document.getElementById("savePassword");

    if(verifyPassword && newPassword != "") {
        savePassword.innerHTML = `
     
                                        <button type="submit" name="savePassword" class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                                            Save
                                        </button>
                            
        `
    } else {
        savePassword.innerHTML = "";
    }
        
  

    if (verifyPassword === "") {
            validateNote.innerHTML = ""
        validateNote.className = "";
        return;
    }
        if (newPassword === verifyPassword) {
            validateNote.className = "text-success";
            validateNote.innerHTML = "Passwords match"
        } else {
            validateNote.className = "text-danger";
            validateNote.innerHTML = "Password Doesn&apos;t match"

        }
    }
                        
                        </script>'; ?>


        <?php include './partials/layouts/layoutBottom.php' ?>

<?php

    } else {
        // Either not logged in or trying to access someone else's profile
        header('Location: /login.php');
        exit;
    }
} else {
    // Not found
    $user = $_SESSION['username'];
    if (isset($_SESSION['isLogin'])) {
        header("location: /client/$user");
    } else {
        header("location: /login/");
    }
    echo "404 Not Found";
}

?>