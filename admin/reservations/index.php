<?php

$title = 'Tables';
$subTitle = 'Restaurant';

require_once __DIR__ . '/../conf/function.php';
require_once __DIR__ . '/../conf/connection.php';

?>

<?php include_once __DIR__ . '/../partials/layouts/layoutTop.php'; ?>

<?php
if (isset($_POST['add'])) {
    if (addTable($_POST) > 0) {
?>
        <script>
            window.location.href = "?alert=2";
        </script>
    <?php    } else { ?>
        <script>
            window.location.href = "?alert=12";
        </script>
<?php
    }
}

?>


<div class="card basic-data-table">
    <div class="card-header">
        <h5 class="card-title mb-3">Tables</h5>

        <button type="button" data-bs-toggle="modal" data-bs-target="#addMenuModal" class=" btn btn-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2">
            <iconify-icon icon="gridicons:user-add" class="text-xl"></iconify-icon> Table
        </button>

    </div>
    <div class="card-body">

        <table class="table bordered-table mb-0 table-responsive" id="dataTable" data-page-length='10'>

            <thead>

                <tr>
                    <th scope="col">
                        Table ID
                    </th>

                    <th scope="col">Capacity</th>
                    <th scope="col">Availability</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $tables = query("SELECT * FROM restaurant_tables");

                foreach ($tables as  $table) :
                ?>
                    <tr>

                        <td>
                            <!-- class = form-check style-check 
                             
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label">
                            
                            -->
                            <?= htmlspecialchars($table['table_id']) ?>
                        </td>


                        <td>
                            <?= htmlspecialchars($table['capacity']) ?> Person

                        </td>
                        <td>
                            <?= $table['is_available'] ? '<span class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">YES</span>' : '<span class="bg-success-focus text-danger-main px-32 py-4 rounded-pill fw-medium text-sm">NO</span>'  ?>

                        </td>
                        <td>

                            <a href="edit-table.php?table_id=<?= htmlspecialchars($table['table_id']) ?>" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="lucide:edit"></iconify-icon>
                            </a>
                            <a href="javascript:void(0)" onclick="deleteConfirm()" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                            </a>

                            <script>
                                function deleteConfirm() {
                                    Swal.fire({
                                        text: "Are you sure delete this Table?",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#3085d6",
                                        cancelButtonColor: "#d33",
                                        confirmButtonText: "<a href='delete-table.php?table_id=<?= $table['table_id'] ?>'>Yes Delete It</a>"
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

$tableID = getNextAvailableTableID();

?>


<!-- Modal -->
<div class="modal fade" id="addMenuModal" tabindex="-1" aria-labelledby="addMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="POST" action="">
                <div class="modal-header">
                    <span class="d-flex gap-2 align-items-center">
                        <iconify-icon icon="material-symbols-light:menu-book-outline-rounded" class="text-2xl text-primary"></iconify-icon>
                        <h5 class="modal-title" id="exampleModalLabel">Add Menu</h5>

                    </span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body card">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label class="form-label">Table ID</label>
                            <input type="text" placeholder="<?= htmlspecialchars($tableID) ?>" class="form-control" readonly>
                            <input type="hidden" name="table_id" value="<?= $tableID ?>" hidden>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Capacity</label>
                            <input type="text" name="capacity" placeholder="Capacity" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add" class="btn btn-primary">Add Table</button>
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

                <script>
                
                </script>
                
                
                ';

?>

<?php include_once __DIR__ . '/../partials/layouts/layoutBottom.php'; ?>