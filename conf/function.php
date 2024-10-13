<?php
require 'connection.php';

function query($query)
{
    global $conn;

    $rows =  [];

    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function addMembership($data)
{
    global $conn;

    $idAccount = htmlspecialchars($data['account_id']);
    $idMember = htmlspecialchars($data['member_id']);
    $memberName = htmlspecialchars($data['member_name']);
    $points = htmlspecialchars($data['points']);
    $email = htmlspecialchars($data['email'] ?? '');
    $phoneNumber = htmlspecialchars($data['phone_number'] ?? '');
    $registerDate = htmlspecialchars($data['register_date']);
    $password = htmlspecialchars($data['password']);
    $passwordhash = password_hash($password, PASSWORD_DEFAULT);
    
    $query1 = "INSERT INTO accounts (email, register_date, phone_number, password) VALUES (
    '$email',
    '$registerDate',
    '$phoneNumber',
    '$passwordhash'
    )";

    mysqli_query($conn, $query1);

    $query2 = "INSERT INTO memberships (member_id, member_name, points, account_id) VALUES (
    '$idMember',
    '$memberName',
    '$points',
    '$idAccount
    )";

        mysqli_query($conn, $query2);
        

    return mysqli_affected_rows($conn);
}

function editMembership($data) {
    global $conn;

    $memberId = htmlspecialchars($data['member_id']);
    $memberName = htmlspecialchars($data['member_name']);
    $points = htmlspecialchars($data['points']);

    $query = "UPDATE memberships SET member_name = '$memberName', points = $points WHERE member_id = $memberId";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}



function addStaff($data)
{
    global $conn;
    
    $idAccount = htmlspecialchars($data['account_id']);
    $idStaff = htmlspecialchars($data['staff_id']);
    $staffName = htmlspecialchars($data['staff_name']);
    $staffPassword = htmlspecialchars($data['password']);
    $passwordhash = password_hash ($staffPassword, PASSWORD_DEFAULT);
    $staffEmail = htmlspecialchars($data['staff_email']);
    $staffRole = htmlspecialchars($data['staff_role']);
    $registerDate = htmlspecialchars($data['register_date']);
    $staffPhone = htmlspecialchars($data['staff_phone']);

    // account
    $query1 = "INSERT INTO accounts (email, phone_number, register_date, password) VALUES (
    '$staffEmail',
    '$staffPhone',
    '$registerDate',
    '$passwordhash'
    )
    ";

    mysqli_query($conn, $query1);

    // staff
    $query2 = "INSERT INTO staff (staff_id, staff_name, staff_role, account_id) VALUES (
    '$idStaff',
    '$staffName',
    '$staffRole',
    '$idAccount'
    )";

    mysqli_query($conn, $query2);



    // $query = "INSERT INTO staff (staff_name, password, staff_email, staff_role, register_date, staff_phone, account_id) VALUES(
    //     '$staffName', '$passwordhash', '$staffEmail', '$staffRole', '$registerDate', $staffPhone, $AccountID
    // )";


    return mysqli_affected_rows($conn);
}

function editStaff($data) {
    global $conn;

    $staffId = htmlspecialchars($data['staff_id']);
    $staffName = htmlspecialchars($data['staff_name']);
    $staffEmail = htmlspecialchars($data['staff_email']);
    $staffRole = htmlspecialchars($data['staff_role']);
    $registerDate = htmlspecialchars($data['register_date']);
    $staffPhone = htmlspecialchars($data['staff_phone']);

    $staffRoleOld = mysqli_query($conn, "SELECT staff_role FROM staff WHERE staff_id = '$staffId'");

    $query = $staffRole == $staffRoleOld ?
    "UPDATE staff SET
        staff_name = '$staffName',
        staff_email = '$staffEmail',
        staff_role = '$staffRole',
        register_date = '$registerDate',
        staff_phone = '$staffPhone'
        WHERE staff_id = '$staffId'
    " : "UPDATE staff SET
        staff_name = '$staffName',
        staff_email = '$staffEmail',
        register_date = '$registerDate',
        staff_phone = '$staffPhone'
        WHERE staff_id = '$staffId'
    ";

  

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Function to get the next available account ID
    function getNextAvailableAccountID() {
        global $conn;

        $sql = "SELECT MAX(account_id) as max_account_id FROM Accounts";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $next_account_id = $row['max_account_id'] + 1;
        return $next_account_id;
    }

    // Function to get the next available Staff ID
    function getNextAvailableStaffID() {
        global $conn;

        $sql = "SELECT MAX(staff_id) as max_staff_id FROM Staff";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $next_staff_id = $row['max_staff_id'] + 1;
        return $next_staff_id;
    }


    // Function to get the next available Staff ID
    function getNextAvailableMemberID() {
        global $conn;

        $sql = "SELECT MAX(member_id) as max_member_id FROM memberships";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $next_member_id = $row['max_member_id'] + 1;
        return $next_member_id;
    }

// this is for add menu
function addMenu($data)
{
    global $conn;

    $menuID = htmlspecialchars($data['menu_id']);
    $menuName = htmlspecialchars($data['menu_name']);
    $menuType = htmlspecialchars($data['menu_type']);
    $menuCategory = htmlspecialchars($data['menu_category']);
    $menuPrice = htmlspecialchars($data['menu_price']);
    $menuDescription = htmlspecialchars($data['menu_description']);
    $menuUrl = htmlspecialchars($data['menu_url']);

    $query = "INSERT INTO menu (item_id, item_name, item_type, item_category, item_price, item_description, item_image_url) VALUES(
        '$menuID', '$menuName', '$menuType', '$menuCategory', $menuPrice, '$menuDescription', '$menuUrl'
        )";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
