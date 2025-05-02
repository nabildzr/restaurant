<!--==============================
    All Js File
============================== -->

<!-- COMMON SCRIPTS -->
<script src="/assets/js/common_scripts.min.js"></script>
<script src="/assets/js/slider.js"></script>
<script src="/assets/js/common_func.js"></script>
<script src="/assets/phpmailer/validate.js"></script>

<!-- SPECIFIC SCRIPTS (wizard form) -->
<script src="/assets/js/wizard/wizard_scripts.min.js"></script>
<script src="/assets/js/wizard/wizard_func.js"></script>

<!-- SPECIFIC SCRIPTS -->
<script src="/assets/js/specific_shop.js"></script>
<script src="/assets/js/sticky_sidebar.min.js"></script>


<script>
    // Sticky sidebar
    $('#sidebar_fixed').theiaStickySidebar({
        minWidth: 991,
        updateSidebarHeight: true,
        additionalMarginTop: 90
    });
</script>
<?php

if (isset($_GET['in'])) {
    $x = intval($_GET['in']);
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            var x = $x;
            if (x == 1) {
                    Swal.fire({
                        icon: 'success',
                        text: 'Successfully Login!',
                        showConfirmButton: false,
                        position: 'bottom-right',
                        timer: 2500,
                    })
                }
            else if (x == 0) {

                    Swal.fire({
                        icon: 'error',
                        text: 'Failed to Login, Username or Password Incorrect!',
                        showConfirmButton: false,
                        timer: 2500,
                    })
                }
            else if (x == -1) {

                    Swal.fire({
                        icon: 'error',
                        text: 'Account not found!.',
                        showConfirmButton: false,
                        position: 'bottom-right',
                        timer: 2500,
                    })
                }
            else if (x == -2) {

                    Swal.fire({
                        icon: 'error',
                        text: 'Something wrong, Username or password incorrect!.',
                        showConfirmButton: false,
                        position: 'bottom-right',
                        timer: 2500,
                    })
                }
            else if (x == -3) {

                    Swal.fire({
                        icon: 'error',
                        text: 'Something wrong, Member not found!.',
                        showConfirmButton: false,
                        position: 'bottom-right',
                        timer: 2500,
                    })
                }
            else if (x == -4) {

                    Swal.fire({
                        icon: 'error',
                        text: 'You must Sign-in to Reserve a table!.',
                        showConfirmButton: false,
                        timer: 2500,
                    })
                }
                     // Remove the 'in' parameter from the URL
        var url = new URL(window.location.href);
        url.searchParams.delete('in');
        window.history.replaceState({}, document.title, url.toString());
           
                }
                )
                </script>
                ";
}

if (isset($_GET['reservation'])) {
    $x = $_GET['reservation'];
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            var x = '$x';
            if (x == 'success') {
                    Swal.fire({
                        icon: 'success',
                        text: 'Reservation success, wait for the confirmation!',
                        showConfirmButton: false,
                        timer: 2500,
                    })
                }
            else if (x == 'failed') {
                    Swal.fire({
                        icon: 'warning',
                        text: 'You already reserved a table, wait for the confirmation!',
                        showConfirmButton: false,
                        timer: 2500,
                    })
                }
            
                     // Remove the 'reservation' parameter from the URL
        var url = new URL(window.location.href);
        url.searchParams.delete('reservation');
        window.history.replaceState({}, document.title, url.toString());
           
                }
                )
                </script>
                ";
}



?>


<?php

if (isset($_GET['reg'])) {
    $x = intval($_GET['reg']);
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        var x = $x;
        if (x == 1) {
            Swal.fire({
                icon: 'success',
                text: 'Register Success, Login!',
                showConfirmButton: false,
                position: 'bottom-right',
                timer: 2500,
            });
          
        } else if (x == 0) {
            Swal.fire({
                icon: 'error',
                text: 'Failed to Register, Try again!',
                showConfirmButton: false,
                position: 'bottom-right',
                timer: 2500,
            });
        
        }
        else if (x == -1) {
            Swal.fire({
                icon: 'error',
                text: 'Failed to register, your password and confirmation password is not same',
                showConfirmButton: false,
                position: 'bottom-right',
                timer: 2500,
            });
        
        }
        else if (x == -2) {
            Swal.fire({
                icon: 'error',
                text: 'Failed to register, the email you entered is already in use',
                showConfirmButton: false,
                position: 'bottom-right',
                timer: 2500,
            });
        
        }

        // Remove the 'reg' parameter from the URL
        var url = new URL(window.location.href);
        url.searchParams.delete('reg');
        window.history.replaceState({}, document.title, url.toString());
    });
</script>";
}

?>



<?php

if (isset($_GET['updated'])) {
    $x = intval($_GET['updated']);
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        var x = $x;
           if (x == 1) {
            Swal.fire({
                icon: 'success',
                html: 'Item updated in cart successfully!',
                showConfirmButton: false,
                timer: 2500,
            });
        } else if (x == 0) {
            Swal.fire({
                icon: 'error',
                text: 'Failed to update your cart, please try again!',
                showConfirmButton: false,
                timer: 2500,
            });
        } else if (x == -1) {
            Swal.fire({
                icon: 'error',
                text: 'Failed to update your cart, item can\'t more than 10!',
                showConfirmButton: false,
                timer: 2500,
            });
        }

        // Remove the 'updated' parameter from the URL
        var url = new URL(window.location.href);
        url.searchParams.delete('updated');
        window.history.replaceState({}, document.title, url.toString());
    });
</script>";
}

?>

<?php



if (isset($_GET['cart_deleted'])) {
    $x = intval($_GET['cart_deleted']);
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        var x = $x;
           if (x == 1) {
            Swal.fire({
                icon: 'success',
                html: 'Item deleted from your cart',
                showConfirmButton: false,
                timer: 2500,
            });
        } else if (x == 0) {
            Swal.fire({
                icon: 'error',
                text: 'Failed to delete item from your cart, please try again!',
                showConfirmButton: false,
                timer: 2500,
            });
        }
            
        // Remove the 'cart_deleted' parameter from the URL
        var url = new URL(window.location.href);
        url.searchParams.delete('cart_deleted');
        window.history.replaceState({}, document.title, url.toString());
    });
</script>";
}

?>

<script>
    <!-- JIKA ADA SCRIPT TAMBAHAN DENGAN FILE YANG BERBEDA (except one or another one) 
    -->
    <?php echo (isset($script) ? $script   : '') ?>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        const quantity = urlParams.get('quantity');
        const itemName = urlParams.get('item');


        if (status) {
            const x = parseInt(status, 10);

            if (x == 1) {
                Swal.fire({
                    icon: 'success',
                    html: 'Successfully added <b>' + quantity + '</b>' + '<b> ' + itemName +
                        '</b> to cart successfully!',
                    showConfirmButton: false,
                    timer: 2500,
                });
            } else if (x == 2) {
                Swal.fire({
                    icon: 'success',
                    html: 'Item quantity updated in cart successfully!',
                    showConfirmButton: false,
                    timer: 2500,
                });
            } else if (x == 4) {
                Swal.fire({
                    icon: 'error',
                    html: 'You already added <b>10</b> ' + itemName +
                        ' to cart, you can\'t add more than 10 items in one item, please <a href="/client/">Check your cart.</a>',
                    showConfirmButton: false,
                    timer: 2500,
                });
            } else if (x == 5) {
                Swal.fire({
                    icon: 'error',
                    html: 'You can\'t add more than 10 items in one item',
                    showConfirmButton: false,
                    timer: 2500,
                });
            } else if (x == 11) {
                Swal.fire({
                    icon: 'error',
                    text: 'Failed to add item, you need to login first!',
                    showConfirmButton: false,
                    timer: 2500,
                });
            }

            // Remove the 'status' parameter from the URL
            var url = new URL(window.location.href);
            url.searchParams.delete('status');
            window.history.replaceState({}, document.title, url.toString());

            // Remove the 'Quantity' parameter from the URL
            var url = new URL(window.location.href);
            url.searchParams.delete('quantity');
            window.history.replaceState({}, document.title, url.toString());
        }
    });
</script>