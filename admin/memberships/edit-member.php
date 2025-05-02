<?php

$title = 'Edit Memberships';
$subTitle = 'Restaurant';

require_once __DIR__ . '/admin/conf/function.php';
require_once __DIR__ . '/admin/conf/connection.php';

?>

<?php include_once __DIR__ . '/admin/partials/layouts/layoutTop.php'; ?>

<?php
if (isset($_POST['confirm'])) {
    if (editMembership($_POST) > 0) {
?>
        <script>
            window.location.href = "/admin/memberships/?alert=3";
        </script>
    <?php    } else { ?>
        <script>
            window.location.href = "/admin/memberships/edit-members?member_id=<?= $memberId ?>&alert=13";
        </script>
    <?php
    }
}

if (isset($_GET['member_id'])) {
    $memberId = $_GET['member_id'];
    if (empty($_GET['member_id'])) {
    ?>
        <script>
            window.location.href = "/admin/memberships/?alert=21";
        </script>
<?php
    } else {
        $data = query("SELECT * FROM memberships WHERE member_id = $memberId")[0];
    }
}

?>


<div class="card basic-data-table">
    <div class="card-header">
        <h5 class="card-title mb-3">Memberships</h5>


    </div>
    <div class="card-body">
        <form method="post" action="">

            <input type="text" name="member_id" value="<?= $memberId ?>" hidden>

            <div class="col-12">
                <label class="form-label">Membership Name</label>
                <input class="form-control" type="text" name="member_name" placeholder="Name" value="<?= $data['member_name'] ?>">
            </div>
            <div class="col-12">
                <label class="form-label">Points</label>
                <div class="input-group">
                    <span class=" input-group-text bg-base">
                        <iconify-icon icon="ph:coins" class="text-xl"></iconify-icon>
                    </span>
                    <input type="text" name="points" class="form-control flex-grow-1" placeholder="Points" value="<?= $data['points'] ?>">
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

<?php include_once __DIR__ . '/admin/partials/layouts/layoutBottom.php'; ?>