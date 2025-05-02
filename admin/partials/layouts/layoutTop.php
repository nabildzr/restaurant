<?php session_start();
require_once __DIR__ .  '/conf/connection.php';


if (!isset($_SESSION['isAdmin'])) {
?>
    <script>
        window.location.href = "/admin/sign-in.php";
    </script>
<?php
}

$staffId = $_SESSION['accountId'];
$queryLayout = "SELECT *
FROM staff
INNER JOIN accounts
ON staff.account_id = accounts.account_id
WHERE accounts.account_id = $staffId";

$user = mysqli_query($conn, $queryLayout);
$userData = mysqli_fetch_assoc($user);

?>




<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<?php include_once __DIR__ . '/admin/partials/head.php' ?>

<body>

    <?php include_once __DIR__ . '/admin/partials/sidebar.php' ?>

    <main class="dashboard-main">
        <?php include_once __DIR__ . '/admin/partials/navbar.php' ?>

        <div class="dashboard-main-body">

            <?php include_once __DIR__ . '/admin/partials/breadcrumb.php' ?>