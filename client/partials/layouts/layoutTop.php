<?php
include_once __DIR__ .  '/client/conf/function.php';
require_once __DIR__ .  '/conf/connection.php';
if (!isset($_SESSION['isLogin'])) {
?>
    <script>
        window.location.href = "../index.php"
    </script>
<?php
}

$memberId = $_SESSION['accountId'];
$queryLayout = "SELECT *
FROM memberships
INNER JOIN accounts
ON memberships.account_id = accounts.account_id
WHERE accounts.account_id = $memberId";

$user = mysqli_query($conn, $queryLayout);
$userData = mysqli_fetch_assoc($user);

?>

<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<?php include_once __DIR__ . '/client/partials/head.php' ?>

<body>

    <?php include_once __DIR__ . '/client/partials/sidebar.php' ?>

    <main class="dashboard-main">
        <?php include_once __DIR__ . '/client/partials/navbar.php' ?>

        <div class="dashboard-main-body">

            <?php include_once __DIR__ . '/client/partials/breadcrumb.php' ?>