<?php

$title = 'Edit Menu';
$subTitle = 'Restaurant';

require_once __DIR__ . '/admin/conf/function.php';
require_once __DIR__ . '/admin/conf/connection.php';

?>

<?php include_once __DIR__ . '/admin/partials/layouts/layoutTop.php'; ?>

<?php
if (isset($_POST['confirm'])) {
    if (editMenu($_POST) > 0) {
?>
        <script>
            window.location.href = "/admin/menu/?alert=3";
        </script>
    <?php    } else { ?>
        <script>
            window.location.href = "/admin/menu/edit-menu.php?item_id=<?= $menuId ?>&alert=13";
        </script>
    <?php
    }
}

if (isset($_GET['item_id'])) {
    $menuId = $_GET['item_id'];
    if (empty($_GET['item_id'])) {
    ?>
        <script>
            window.location.href = "/admin/menu/?alert=400";
        </script>
<?php
    } else {
        $data = query("SELECT * FROM menu WHERE item_id = '$menuId'")[0];
    }
}

?>


<div class="card basic-data-table">
    <div class="card-header">
        <h5 class="card-title mb-3">Menu</h5>


    </div>
    <div class="card-body">
        <form method="post" action="" enctype="multipart/form-data">

            <div class="col-12">
                <label class="form-label">Item ID</label>
                <input type="text" name="item_id" placeholder="Item ID" value="<?= $menuId ?>" class="form-control" readonly>
            </div>
            <div class="col-12">
                <label class="form-label">Item Name</label>
                <input type="text" name="item_name" placeholder="Item ID" value="<?= $data['item_name'] ?>" class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label">Item Type</label>
                <select name="item_type" placeholder="Item Type" class="form-control">
                    <option value="<?= $data['item_type'] ?>" hidden><?= $data['item_type'] ?></option>
                    <option value="Steak and Ribs">Steak and Ribs</option>
                    <option value="Seafood">Seafood</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label">Item Category</label>
                <select name="item_category" placeholder="Item Category" class="form-control">
                    <option value="<?= $data['item_category'] ?>" hidden><?= $data['item_category'] ?></option>
                    <option value="Main Dishes">Main Dishes</option>
                    <option value="Side Snacks">Side Snacks</option>
                    <option value="Drinks">Drinks</option>

                    <!-- mengambil isi/values length dari enum type -->

                </select>
            </div>
            <div class="col-12">
                <label class="form-label">Item Price</label>
                <div class="input-group">
                    <span class=" input-group-text bg-base">
                        <iconify-icon icon="fe:money" class="text-xl"></iconify-icon>
                    </span>
                    <input type="text" name="item_price" value="<?= $data['item_price'] ?>" class="form-control flex-grow-1" placeholder="12.345">
                </div>
            </div>
            <div class="col-12">
                <label class="form-label">Discount Status</label>
                <div class="input-group">
                    <span class="input-group-text bg-base">
                        <iconify-icon icon="fe:check-circle" class="text-xl"></iconify-icon>
                    </span>
                    <select name="discount_status" class="form-control flex-grow-1">
                        <option value="<?= $data['discount_status'] ?>" hidden><?= ($data['discount_status'] == 1) ? "Active" : "Inactive" ?></option>

                        <option value="0">Inactive</option>
                        <option value="1">Active</option>
                    </select>
                </div>
            </div>
            <div class="col-12">
                <label class="form-label">Discount</label>
                <div class="input-group">

                    <input type="text" name="discount" class="form-control flex-grow-1" value="<?= $data['discount'] ?>" placeholder="0.00">
                </div>
            </div>



            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea type="text" name="item_description" placeholder="Enter Description" class="form-control"><?= $data['item_description'] ?></textarea>
            </div>
            <div class="col-12">
                <label class="form-label">Image Menu</label>

                <div class="upload-image-wrapper d-flex align-items-center gap-3">
                    <div class="uploaded-img position-relative h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50">
                        <button type="button" class="uploaded-img__remove position-absolute top-0 end-0 z-1 text-2xxl line-height-1 me-8 mt-8 d-flex" onclick="removeImage()">
                            <iconify-icon icon="radix-icons:cross-2" class="text-xl text-danger-600"></iconify-icon>
                        </button>
                        <img id="uploaded-img__preview" class="w-100 h-100 object-fit-cover" src="/admin/images/<?= $data['item_image'] ?>" alt="image">
                    </div>

                    <label class="upload-file h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1" for="upload-file">
                        <iconify-icon icon="solar:camera-outline" class="tesxt-xl text-secondary-light"></iconify-icon>
                        <span class="fw-semibold text-secondary-light">Upload</span>
                        <input id="upload-file" type="file" name="item_image" onchange="previewImage(event)">
                    </label>
                </div>


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

                <script>
            function previewImage(event) {
                const input = event.target;
                const reader = new FileReader();
                reader.onload = function(){
                    const imgElement = document.getElementById("uploaded-img__preview");
                    imgElement.src = reader.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
                </script>
                
                '; ?>

<?php include_once __DIR__ . '/admin/partials/layouts/layoutBottom.php'; ?>