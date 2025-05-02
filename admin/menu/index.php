<?php

$title = 'Menu';
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
            window.location.href = "/admin/menu/?alert=2";
        </script>
    <?php    } else { ?>
        <script>
            window.location.href = "/admin/menu/?alert=12";
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
                                No
                            </label>
                        </div>
                    </th>

                    <th scope="col">Item ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Price</th>
                    <th scope="col">Discount Status</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $menus = query("SELECT * FROM menu");

                foreach ($menus as  $menu) :
                ?>
                    <tr>

                        <td>
                            <div class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label">
                                    <?= $no++ ?>
                                </label>
                            </div>
                        </td>
                        <td>
                            <a href="javascript:void(0)" class="text-primary-600">
                                <?= $menu['item_id'] ?>
                            </a>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="assets/images/user-list/user-list10.png" alt="" class="flex-shrink-0 me-12 radius-8">
                                <h6 class="text-md mb-0 fw-medium flex-grow-1">
                                    <?= $menu['item_name'] ?>

                                </h6>
                            </div>
                        </td>
                        <td>
                            <?= $menu['item_type'] ?>

                        </td>

                        <td>

                            <?php
                            $price = number_format($menu['item_price'], 0, ',', '.');

                            ?>
                            Rp. <?= $price ?>

                        </td>
                        <td class="text-center">

                            <!-- if discount_status == 1 then show "Yes", else show "No" -->
                            <?= $menu['discount_status'] ? '<span class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">Active</span>' : '<span class="bg-danger-focus text-danger-main px-32 py-4 rounded-pill fw-medium text-sm">Inactive</span>'  ?>

                        </td>
                        <td class="text-center">
                            <?= $menu['discount'] ?>

                        </td>




                        <td>
                            <?= $menu['item_description'] ?>

                        </td>
                        <td>
                            <!-- ternary operator -> jika image_url ada maka tampilkan image_url, jika tidak maka tampilkan blanknotfound -->
                            <img style="width: 200px; height: 200px; object-fit: cover;" class="rounded" src="../images/<?= $menu['item_image'] ?>" alt="Image">

                        </td>
                        <td>

                            <a href="edit-menu.php?item_id=<?= $menu['item_id'] ?>" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="lucide:edit"></iconify-icon>
                            </a>
                            <a href="javascript:void(0)" onclick="deleteConfirm()" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                            </a>
                            <script>
                                function deleteConfirm() {
                                    Swal.fire({
                                        text: "Are you sure delete this Menu?",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#3085d6",
                                        cancelButtonColor: "#d33",
                                        confirmButtonText: "<a href='delete-menu.php?item_id=<?= $menu['item_id'] ?>'>Yes Delete It</a>"
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
                            <input type="text" name="menu_id" placeholder="Item ID" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Item Name</label>
                            <input type="text" name="menu_name" placeholder="Menu Name" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Item Type</label>
                            <select name="menu_type" placeholder="Item Type" class="form-control" required>
                                <option value="">Select Type</option>
                                <?php

                                $enumValues = getEnumValues("menu", "item_type");
                                foreach ($enumValues as $value): ?>
                                    <option value="<?= $value ?>"><?= $value ?></option>
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
                            <label class="form-label">Discount Status</label>
                            <div class="input-group">
                                <span class="input-group-text bg-base">
                                    <iconify-icon icon="fe:check-circle" class="text-xl"></iconify-icon>
                                </span>
                                <select name="discount_status" class="form-control flex-grow-1">
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Discount</label>
                            <div class="input-group">

                                <input type="text" name="discount" class="form-control flex-grow-1" placeholder="0.00">
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
                                    <iconify-icon icon="solar:camera-outline" class="tesxt-xl text-secondary-light"></iconify-icon>
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

<?php include_once __DIR__ . '/admin/partials/layouts/layoutBottom.php'; ?>