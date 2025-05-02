<?php

$title = 'Edit Menu';
$subTitle = 'Restaurant';

require_once __DIR__ . '/admin/conf/function.php';
require_once __DIR__ . '/admin/conf/connection.php';

?>

<?php include_once __DIR__ . '/admin/partials/layouts/layoutTop.php'; ?>


<?php
if (isset($_GET['table_id'])) {
    $tableID = $_GET['table_id'];
    if (empty($_GET['table_id'])) {
?>
        <script>
            window.location.href = "/admin/tables/?alert=400";
        </script>
<?php
    } else {
        $data = query("SELECT * FROM restaurant_tables WHERE table_id = $tableID")[0];
    }
}

?>

<?php
if (isset($_POST['confirm'])) {
    if (editTable($_POST) > 0) {
?>
        <script>
            window.location.href = "/admin/tables/?alert=3";
        </script>
    <?php    } else { ?>
        <script>
            window.location.href = "/admin/tables/edit-table.php?tszable_id=<?= $tableID ?>&alert=13";
        </script>
<?php
    }
}


?>


<div class="card basic-data-table">
    <div class="card-header">
        <h5 class="card-title mb-3">Table</h5>


    </div>
    <div class="card-body">
        <form method="post" action="" enctype="multipart/form-data">

            <div class="col-12">
                <label class="form-label">Table ID</label>
                <input type="text" placeholder="<?= $tableID ?>" class="form-control" readonly>
                <input type="hidden" name="table_id" value="<?= $tableID ?>" hidden>
            </div>

            <div class="col-12">
                <label class="form-label">Capacity</label>
                <input type="text" placeholder="Capacity" name="capacity" value="<?= $data['capacity'] ?>" class="form-control">
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