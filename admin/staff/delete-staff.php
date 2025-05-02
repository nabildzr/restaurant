<?php
require_once __DIR__ . '/admin/conf/function.php';

if(isset($_GET['account_id'])) {
    $idAccount = $_GET['account_id'];
    
    if (deleteStaff($idAccount) > 0) {
        header('location: index.php?alert=1');
    } else {
        header('location: index.php?alert=11');
    }
}

?>