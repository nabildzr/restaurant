<?php

$title = 'Menu';
$subTitle = 'Restaurant';

require_once $_SERVER['DOCUMENT_ROOT'] . '/admin-restaurant/conf/function.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin-restaurant/conf/connection.php';

?>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/admin-restaurant/partials/layouts/layoutTop.php'; ?>

<?php
if (isset($_POST['addMember'])) {
    if (addMembership($_POST) > 0) {
?>
        <script>
            window.location.href = "/admin-restaurant/memberships/?alert=2";
        </script>
    <?php    } else { ?>
        <script>
            window.location.href = "/admin-restaurant/memberships/?alert=4";
        </script>
<?php
    }
}

?>


<div class="card basic-data-table">
    <div class="card-header">
        <h5 class="card-title mb-3">Menu</h5>

        <button type="button" data-bs-toggle="modal" data-bs-target="#addMemberModal" class=" btn btn-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2">
            <iconify-icon icon="gridicons:user-add" class="text-xl"></iconify-icon> Menu
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
                                Item ID
                            </label>
                        </div>
                    </th>

                    <th scope="col">Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">action</th>

                </tr>
            </thead>
            <tbody>
                <?php

                $menus = query("SELECT * FROM menu");

                foreach ($menus as  $mmenu) :
                ?>
                    <tr>
                        <td>
                            <div class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label">
                                    <?= $member['member_id'] ?>
                                </label>
                            </div>
                        </td>
                        <!-- <td><a href="javascript:void(0)" class="text-primary-600">
                        
                    </a></td> -->
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="assets/images/user-list/user-list10.png" alt="" class="flex-shrink-0 me-12 radius-8">
                                <h6 class="text-md mb-0 fw-medium flex-grow-1">
                                    <?= $member['member_name'] ?>

                                </h6>
                            </div>
                        </td>
                        <td>
                            <?= $member['points'] ?>

                        </td>
                        <td>
                            <?= $member['account_id'] ?>

                        </td>
                        <td>

                            <a href="javascript:void(0)" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="lucide:edit"></iconify-icon>
                            </a>
                            <a href="javascript:void(0)" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<?php
//? Mengambil nilai account_id terbesar dan menginisialisasinya sebagai kodeTerbesar
$query = mysqli_query($conn, "SELECT max(account_id) as kodeTerbesar FROM memberships");

//? Mengambil hasil query sebagai array
$data = mysqli_fetch_array($query);



$idAccount = (int) $data['kodeTerbesar']; //? Mengonversi langsung ke integer

switch ($idAccount) {
        // jika 0 maka ganti ke 1
    case 0:
        $idAccount = 1;
        break;
        // mengembalikan seperti normal
    default:
        $idAccount++;
        break;
}



//? Menggunakan nilai integer langsung tanpa mengonversi ke string
?>


<!-- Modal -->
<div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="">
                <div class="modal-header">
                    <span class="d-flex gap-2 align-items-center">
                        <iconify-icon icon="gridicons:user-add" class="text-2xl text-primary"></iconify-icon>
                        <h5 class="modal-title" id="exampleModalLabel">Add Membership</h5>

                    </span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body card">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label class="form-label">Membership Name</label>
                            <input type="text" name="member_name" placeholder="Name" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Points</label>
                            <div class="input-group">
                                <span class=" input-group-text bg-base">
                                    <iconify-icon icon="ph:coins" class="text-xl"></iconify-icon>
                                </span>
                                <input type="text" name="points" class="form-control flex-grow-1" placeholder="Points">
                            </div>
                        </div>


                        <input type="text" name="account_id" value="<?= $idAccount ?>" placeholder="Account ID" hidden>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="addMember" class="btn btn-primary">Add Member</button>
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

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/admin-restaurant/partials/layouts/layoutBottom.php'; ?>