<?php

$title = 'Edit Staff';
$subTitle = 'Restaurant';

require_once __DIR__ . '/admin/conf/function.php';
require_once __DIR__ . '/admin/conf/connection.php';

?>

<?php include_once __DIR__ . '/admin/partials/layouts/layoutTop.php'; ?>

<?php
if (isset($_POST['confirm'])) {
    if (editStaff($_POST) < 0) {
?>
        <script>
            window.location.href = "/admin/staff/edit-staff.php?staff_id=<?= $staffId ?>&alert=13";
        </script>
    <?php    } else { ?>
        <script>
            window.location.href = "/admin/staff/?alert=3";
        </script>
    <?php
    }
}

if (isset($_GET['staff_id'])) {
    $staffId = $_GET['staff_id'];
    if (empty($_GET['staff_id'])) {
    ?>
        <script>
            window.location.href = "/admin/staff/?alert=21";
        </script>
<?php
    } else {
        $data = query("SELECT * FROM staff INNER JOIN accounts ON staff.account_id = accounts.account_id WHERE staff.staff_id = $staffId")[0];
    }
}

?>


<div class="card basic-data-table">
    <div class="card-header">
        <h5 class="card-title mb-3">Staff</h5>


    </div>
    <div class="card-body">
        <form method="post" action="">


            <div class="col-12">
                <label class="form-label">Account ID</label>
                <input class="form-control" type="text" value="<?= $staffId ?>" name="account_id" placeholder="Account ID" value="<?= $data['account_id'] ?>" readonly>
            </div>
            <div class="col-12">
                <label class="form-label">Staff ID</label>
                <input class="form-control" type="text" value="<?= $staffId ?>" name="staff_id" placeholder="Staff ID" value="<?= $data['staff_name'] ?>" readonly>
            </div>
            <div class="col-12">
                <label class="form-label">Staff Name</label>
                <input type="text" name="staff_name" value="<?= $data['staff_name'] ?>" placeholder="Name" class="form-control" required>
            </div>
            <div class="col-12">
                <label class="form-label">Staff Email</label>
                <input type="text" name="email" value="<?= $data['email'] ?>" placeholder="nabildzikrika@gmail.com" class="form-control">
            </div>

            <div class="col-12">
                <label class="form-label">Staff Role</label>
                <select name="staff_role" class="form-control">
                    <option value="<?= $data['staff_role'] ?>" hidden><?= $data['staff_role'] ?></option>

                    <option value='Waiter'>Waiter</option>
                    <option value='Chef'>Chef</option>
                    <option value='Manager'>Manager</option>

                </select>
            </div>

            <div class="col-12">
                <label class="form-label">Register Date</label>
                <input type="date" name="register_date" value="<?= $data['register_date'] ?>" class="form-control">
            </div>

            <div class="col-12">
                <label for="" class="form-label">Staff Phone Number</label>
                <input type="number" class="form-control" value="<?= $data['phone_number'] ?>" name="phone_number" placeholder="+62 12345678910">
            </div>
            <div class="modal-footer gap-10">
                <a href="index.php">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                </a>
                <button type="submit" name="confirm" class="btn btn-primary">Confirm</button>
            </div>
        </form>
    </div>
</div>

<?php include_once __DIR__ . '/admin/partials/layouts/layoutBottom.php'; ?>