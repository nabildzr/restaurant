<?php
session_start();
$title = 'Purchase History';
$subTitle = 'Purchase History';
?>
<?php include './partials/layouts/layoutTop.php';



?>

<div class="card">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div class="d-flex flex-wrap align-items-center gap-3">
            <div class="d-flex align-items-center gap-2">
                <span>Show</span>
                <select class="form-select form-select-sm w-auto">
                    <option>10</option>
                    <option>15</option>
                    <option>20</option>
                </select>
            </div>
            <div class="icon-field">
                <input type="text" name="#0" class="form-control form-control-sm w-auto" placeholder="Search">
                <span class="icon">
                    <iconify-icon icon="ion:search-outline"></iconify-icon>
                </span>
            </div>
        </div>
        <div class="d-flex flex-wrap align-items-center gap-3">
            <select class="form-select form-select-sm w-auto">
                <option value="" hidden>Status</option>
                <option value="">Waiting</option>
                <option value="">Success</option>
                <option value="">Failed</option>

            </select>
            <a href="invoice-add.php" class="btn btn-sm btn-primary-600"><i class="ri-add-line"></i> Create Invoice</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table bordered-table mb-0">
            <thead>
                <tr>
                    <th scope="col" class="text-center"> Cart ID</th>
                    <th scope="col" class="text-center">Item Name</th>
                    <th scope="col" class="text-center">Date</th>
                    <th scope="col" class="text-center">Total</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $memberID = $_SESSION['memberId'];
                $carts = query("SELECT c.quantity, m.item_name, m.item_price, m.item_image, c.added_at, c.status, c.cart_id
                    FROM cart c JOIN menu m ON c.item_id = m.item_id 
                    WHERE c.member_id = $memberID ORDER BY c.added_at DESC");
                foreach ($carts as $cart) :
                ?>
                    <tr>
                        <td class="text-center"><?= $cart['cart_id'] ?></td>

                        <td class="text-center">
                            <div class="d-flex align-items-center">
                                <img src="/admin/images/<?= $cart['item_image'] ?>" alt="" class="flex-shrink-0 me-12 radius-8" width="50" height="50">
                                <h6 class="text-md mb-0 fw-medium flex-grow-1"><?= $cart['item_name'] ?></h6>
                            </div>
                        </td>
                        <td class="text-center"><?= $cart['added_at'] ?></td>
                        <td class="text-center"><?= 'Rp. ' . number_format($cart['quantity'] * $cart['item_price'], 0, ',', '.') ?></td>
                        <td class="text-center">
                            <?php
                            switch ($cart['status']) {
                                case 'success':
                                    echo '<span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Success</span>';
                                    break;
                                case 'failed':
                                    echo '<span class="bg-danger-focus text-danger-main px-24 py-4 rounded-pill fw-medium text-sm">Failed</span>';
                                    break;
                                case 'waiting':
                                    echo '<span class="bg-warning-focus text-warning-main px-24 py-4 rounded-pill fw-medium text-sm">Waiting</span>';
                                    break;
                                default:
                                    echo '<span class="bg-gray-200 text-gray-600 px-24 py-4 rounded-pill fw-medium text-sm">-</span>';
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <a href="javascript:void(0)" class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                            </a>
                            <a href="javascript:void(0)" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="lucide:edit"></iconify-icon>
                            </a>
                            <a href="javascript:void(0)" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mt-24">
            <span>Showing 1 to 10 of 12 entries</span>
            <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                <li class="page-item">
                    <a class="page-link text-secondary-light fw-medium radius-4 border-0 px-10 py-10 d-flex align-items-center justify-content-center h-32-px w-32-px bg-base" href="javascript:void(0)">
                        <iconify-icon icon="ep:d-arrow-left" class="text-xl"></iconify-icon>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-primary-600 text-white fw-medium radius-4 border-0 px-10 py-10 d-flex align-items-center justify-content-center h-32-px w-32-px" href="javascript:void(0)">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-primary-50 text-secondary-light fw-medium radius-4 border-0 px-10 py-10 d-flex align-items-center justify-content-center h-32-px w-32-px" href="javascript:void(0)">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-primary-50 text-secondary-light fw-medium radius-4 border-0 px-10 py-10 d-flex align-items-center justify-content-center h-32-px w-32-px" href="javascript:void(0)">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link text-secondary-light fw-medium radius-4 border-0 px-10 py-10 d-flex align-items-center justify-content-center h-32-px w-32-px bg-base" href="javascript:void(0)">
                        <iconify-icon icon="ep:d-arrow-right" class="text-xl"></iconify-icon>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>





<?php include './partials/layouts/layoutBottom.php' ?>