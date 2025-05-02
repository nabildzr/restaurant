<?php

$title = 'Bills';
$subTitle = 'Restaurant';

require_once __DIR__ . '/admin/conf/function.php';
require_once __DIR__ . '/admin/conf/connection.php';

?>

<?php include_once __DIR__ . '/admin/partials/layouts/layoutTop.php'; ?>

<?php
if (isset($_POST['addMenu'])) {
    if (addMenu($_POST) > 0) {
?>
        <script>
            window.location.href = "/admin/menu/?alert=10";
        </script>
    <?php    } else { ?>
        <script>
            window.location.href = "/admin/menu/?alert=11";
        </script>
<?php
    }
}

?>


<div class="card basic-data-table">
    <div class="card-header">
        <h5 class="card-title mb-3">Menu</h5>

        <button type="button" data-bs-toggle="modal" data-bs-target="#addMenuModal" class=" btn btn-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2">
            <iconify-icon icon="gridicons:user-add" class="text-xl"></iconify-icon> Menu
        </button>


    </div>
    <div class="card-body">

        <table class="table bordered-table mb-0 table-responsive" id="dataTable" data-page-length='10'>

            <thead>

                <tr>
                    <th scope="col">
                        <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">
                                Bill ID
                            </label>
                        </div>
                    </th>

                    <th scope="col">Staff ID</th>
                    <th scope="col">Member ID</th>
                    <th scope="col">Reservation ID</th>
                    <th scope="col">Table ID</th>
                    <th scope="col">Card ID</th>
                    <th scope="col">Payment Method</th>
                    <th scope="col">Bill Time</th>
                    <th scope="col">Payment Time</th>
                    <th scope="col">Receipt</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $menus = query("SELECT * FROM bills");

                foreach ($menus as  $menu) :
                ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>



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
                            <label class="form-label">Item ID</label>
                            <input type="text" name="menu_id" placeholder="Item ID" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Item Name</label>
                            <input type="text" name="menu_name" placeholder="Item ID" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Item Type</label>
                            <select name="menu_type" placeholder="Item Type" class="form-control" required>
                                <option value="">Select Type</option>
                                <option value="Steak and Ribs">Steak and Ribs</option>
                                <option value="Seafood">Seafood</option>

                                <!-- mengambil isi/values length dari enum type -->
                                <!-- <?php

                                        $enumValues = getEnumValues('menu', 'item_type');
                                        foreach ($enumValues as $value): ?>
                                    <option name="menu_type" value="<?= $value ?>"><?= $value ?></option>
                                <?php endforeach; ?> -->
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Item Category</label>
                            <select name="menu_category" placeholder="Item Category" class="form-control">
                                <option value="">Select Category</option>

                                <!-- mengambil isi/values length dari enum type -->
                                <?php
                                $query2 = "SHOW COLUMNS FROM menu LIKE 'item_category'";
                                $result2 = $conn->query($query2);
                                $row2 = $result2->fetch_assoc();
                                $category = $row2['Type'];
                                preg_match('/^enum\((.*)\)$/', $category, $matches2);
                                $enum2 = explode(',', $matches2[1]);

                                ?>

                                <!-- menerapkan -->
                                <?php foreach ($enum2 as $value2): ?>
                                    <option value="<?= trim($value2, "'") ?>"><?= trim($value2, "'") ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Item Price</label>
                            <div class="input-group">
                                <span class=" input-group-text bg-base">
                                    <iconify-icon icon="fe:money" class="text-xl"></iconify-icon>
                                </span>
                                <input type="text" name="menu_price" class="form-control flex-grow-1" placeholder="12.345">
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea type="text" name="menu_description" placeholder="Enter Description" class="form-control"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Image Menu</label>

                            <div class="upload-image-wrapper d-flex align-items-center gap-3">
                                <div class="uploaded-img d-none position-relative h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50">
                                    <button type="button" class="uploaded-img__remove position-absolute top-0 end-0 z-1 text-2xxl line-height-1 me-8 mt-8 d-flex">
                                        <iconify-icon icon="radix-icons:cross-2" class="text-xl text-danger-600"></iconify-icon>
                                    </button>
                                    <img id="uploaded-img__preview" class="w-100 h-100 object-fit-cover" src="assets/images/user.png" alt="image">
                                </div>

                                <label class="upload-file h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1" for="upload-file">
                                    <iconify-icon icon="solar:camera-outline" class="text-xl text-secondary-light"></iconify-icon>
                                    <span class="fw-semibold text-secondary-light">Upload</span>
                                    <input id="upload-file" type="file" name="item_image" required>
                                </label>
                            </div>
                        </div>




                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="addMenu" class="btn btn-primary">Add Menu</button>
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
                
                '; ?>

<?php include_once __DIR__ . '/../partials/layouts/layoutBottom.php'; ?>