<?php

$title = 'Staff';
$subTitle = 'Restaurant';

require_once __DIR__ . '/admin/conf/function.php';
require_once __DIR__ . '/admin/conf/connection.php';

?>

<?php include_once __DIR__ . '/admin/partials/layouts/layoutTop.php'; ?>

<?php
if (isset($_POST['addStaff'])) {
    if (addStaff($_POST) > 0) {
?>
        <script>
            window.location.href = "/admin/staff/?alert=2";
        </script>
    <?php    } else { ?>
        <script>
            window.location.href = "/admin/staff/?alert=12";
        </script>
<?php
    }
}

?>


<div class="card basic-data-table">
    <div class="card-header">
        <h5 class="card-title mb-3">Staff</h5>

        <button type="button" data-bs-toggle="modal" data-bs-target="#addStaffModal" class=" btn btn-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2">
            <iconify-icon icon="gridicons:user-add" class="text-xl"></iconify-icon> Staff
        </button>


    </div>
    <div class="card-body">

        <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>

            <thead>

                <tr>
                    <th scope="col">
                        <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">
                                Staff ID
                            </label>
                        </div>
                    </th>

                    <th scope="col">Staff Name</th>
                    <th scope="col">Staff Role</th>
                    <th scope="col">Account ID</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $staffs = query("SELECT * FROM staff");

                foreach ($staffs as  $staff) :
                ?>
                    <tr>
                        <td>
                            <div class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label">
                                    <?= $staff['staff_id'] ?>
                                </label>
                            </div>
                        </td>
                        <!-- <td><a href="javascript:void(0)" class="text-primary-600">
                        
                    </a></td> -->
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="assets/images/user-list/user-list10.png" alt="" class="flex-shrink-0 me-12 radius-8">
                                <h6 class="text-md mb-0 fw-medium flex-grow-1">
                                    <?= $staff['staff_name'] ?>

                                </h6>
                            </div>
                        </td>
                        <td>
                            <?= $staff['staff_role'] ?>

                        </td>
                        <td>
                            <?= $staff['account_id'] ?>

                        </td>
                        <td>

                            <a href="edit-staff.php?staff_id=<?= $staff['staff_id'] ?>" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="lucide:edit"></iconify-icon>
                            </a>
                            <a href="javascript:void(0)" onclick="deleteConfirm()" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                            </a>
                            <script>
                                function deleteConfirm() {
                                    Swal.fire({
                                        text: "Are you sure delete this Staff?",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#3085d6",
                                        cancelButtonColor: "#d33",
                                        confirmButtonText: "<a href='delete-staff.php?staff_id=<?= $staff['staff_id'] ?>&account_id=<?= $staff['account_id'] ?>'>Yes Delete It</a>"
                                    })

                                }
                            </script>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<?php
//? Mengambil nilai account_id terbesar dan menginisialisasinya sebagai kodeTerbesar
// $query = mysqli_query($conn, "SELECT max(account_id) as kodeTerbesar FROM staff");

//? Mengambil hasil query sebagai array
// $data = mysqli_fetch_array($query);



// $idAccount = (int) $data['kodeTerbesar']; //? Mengonversi langsung ke integer

// switch ($idAccount) {
//         // jika 0 maka ganti ke 1
//     case 0:
//         $idAccount = 1;
//         break;
//         // mengembalikan seperti normal
//     default:
//         $idAccount++;
//         break;
// }



//? Menggunakan nilai integer langsung tanpa mengonversi ke string
?>

<?php
$idAccount = getNextAvailableAccountID();
$idStaff = getNextAvailableStaffID();
?>

<!-- Modal -->
<div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="">
                <div class="modal-header">
                    <span class="d-flex gap-2 align-items-center">
                        <iconify-icon icon="gridicons:user-add" class="text-2xl text-primary"></iconify-icon>
                        <h5 class="modal-title" id="addStaffModalLabel">Add Staff</h5>

                    </span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body card">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label for="" class="form-label">Account ID</label>
                            <input type="text" class="form-control" name="account_id" value="<?= $idAccount ?>" placeholder="Account ID" readonly>
                        </div>
                        <div class="col-12">
                            <label for="" class="form-label">Staff ID</label>
                            <input type="text" class="form-control" name="staff_id" value="<?= $idStaff ?>" placeholder="Staff ID" readonly>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Staff Name</label>
                            <input type="text" name="staff_name" placeholder="Name" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Staff Email</label>
                            <input type="text" name="staff_email" placeholder="nabildzikrika@gmail.com" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Staff Password</label>
                            <input type="password" name="password" placeholder="******" class="form-control styled-password" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Staff Role</label>
                            <select name="staff_role" placeholder="Select Role" class="form-control">
                                <option value="">Select Type</option>

                                <!-- mengambil isi/values length dari enum type -->
                                <?php
                                $query = "SHOW COLUMNS FROM staff LIKE 'staff_role'";
                                $result = $conn->query($query);
                                $row = $result->fetch_assoc();
                                $type = $row['Type'];
                                preg_match('/^enum\((.*)\)$/', $type, $matches);
                                $enum = explode(',', $matches[1]);

                                ?>

                                <!-- menerapkan -->
                                <?php foreach ($enum as $value): ?>
                                    <option value="<?= trim($value, "'") ?>"><?= trim($value, "'") ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Register Date</label>
                            <input type="date" name="register_date" class="form-control">
                        </div>

                        <div class="col-12">
                            <label for="" class="form-label">Staff Phone Number</label>
                            <input type="number" class="form-control" name="staff_phone" placeholder="+62 12345678910">
                        </div>



                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="addStaff" class="btn btn-primary">Add Member</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $script = '<script>
                    let table = new DataTable("#dataTable");
                </script>
                <script>
                var myModal = document.getElementById("myModal");
                var myInput = document.getElementById("myInput");

                myModal.addEventListener("shown.bs.modal", function () {
                myInput.focus()
                });
                </script>
                
                '; ?>

<?php include_once __DIR__ . '/admin/partials/layouts/layoutBottom.php'; ?>