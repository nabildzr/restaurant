<?php include_once __DIR__ . '/../partials/layouts/layout-top.php';

require_once __DIR__ .  '/../conf/function.php';
?>



<?php

// Mendapatkan id member yang sedang login
$userId = $_SESSION['memberId'];


if (isset($_SESSION['isLogin']) == false) {
    echo '<script>window.location.href = "/login/"</script>';
}

if (isset($_GET['id'])) {
    // Mendapatkan id item yang akan ditampilkan
    $id = $_GET['id'];

    // Query untuk mendapatkan data item dan deskripsinya
    // Join antara table menu dan menu_description berdasarkan item_id
    // Sehingga kita dapat mendapatkan data item dan deskripsinya dalam satu query
    $query = "SELECT m.*, md.* 
              FROM menu m 
              JOIN menu_description md 
              ON m.item_id = md.item_id 
              WHERE m.item_id ='$id'";

    // Original code
    // $data = query($query)[0];

    // Jalankan query dan simpan hasilnya dalam variabel $data
    $result = query($query);
    // Karena query di atas mengembalikan array 2 dimensi maka kita perlu mengambil data yang pertama
    // dengan menggunakan index array [0]
    $data = $result[0];

    // format harga, contoh = 10000 -> 10.000
    $price = number_format($data['item_price'], 0, ',', '.');

    // hitung diskon dalam persen, contoh diskon 25%
    $discountPercent = round($data['discount']);


    $discountPrice = $data['item_price'] - ($data['item_price'] * ($data['discount'] / 100));

    // format harga setelah diskon, contoh = 7500 -> 7.500
    $discountPriceFormatted = number_format($discountPrice, 0, ',', '.');




    // dapatkan cart user berdasarkan member_id dan item_id
    $queryCart = "SELECT quantity FROM cart WHERE member_id = $userId AND item_id = '$id'";
    $resultCart = query($queryCart);

    // Jika hasil query cart tidak kosong maka simpan hasilnya dalam variabel $cart
    // Jika hasil query cart kosong maka simpan null dalam variabel $cart
    $cart = (!empty($resultCart)) ? $resultCart[0] : null;
}

// Jika user menekan tombol "Add to cart" maka akan masuk ke dalam fungsi addToCart()
// Fungsi addToCart() akan mengembalikan nilai berupa angka, yang mana angka tersebut menunjukkan status dari proses add to cart
// Jika nilai yang dikembalikan adalah 1 maka statusnya adalah 1, jika nilai yang dikembalikan adalah 4 maka statusnya adalah 4, jika nilai yang dikembalikan adalah 5 maka statusnya adalah 5
// Jika nilai yang dikembalikan adalah 14 maka statusnya adalah 4
// Jika nilai yang dikembalikan adalah 3 maka statusnya adalah 3
// Redirect ke halaman shop-single.php dengan mengirimkan parameter item_id, status, item, dan quantity
if (isset($_POST['addToCart'])) {
    $result = addToCart($_POST); // Call addToCart() only once

    // Berikut ini adalah penjelasan tentang match expression yang digunakan
    // untuk mengubah nilai yang dikembalikan oleh fungsi addToCart() menjadi status yang sesuai
    // Nilai yang dikembalikan oleh addToCart() dapat berupa angka, maka kita gunakan match expression untuk mengubahnya menjadi status yang sesuai
    // Contoh, jika nilai yang dikembalikan adalah 1 maka statusnya adalah 1, jika nilai yang dikembalikan adalah 4 maka statusnya adalah 4, jika nilai yang dikembalikan adalah 5 maka statusnya adalah 5, jika nilai yang dikembalikan adalah 14 maka statusnya adalah 4, jika nilai yang dikembalikan adalah 3 maka statusnya adalah 3
    // Jika nilai yang dikembalikan tidak ada di dalam match expression maka statusnya adalah 0
    $status = match ($result) {
        1 => 1,
        4 => 4,
        5 => 5,
        14 => 4,
        3 => 3,
        default => 0,
    };

    echo "<script>window.location.href = '/shop/shop-single.php?id=" . $_POST['item_id'] . "&status=" . $status . "&item=" . $data['item_name'] . "&quantity=" . $_POST['quantity_1'] . "'</script>";
}



?>

<?php
$heading = "
	   <!-- SPECIFIC CSS -->
    <link href='/assets/css/shop.css' rel='stylesheet'>
    ";

echo $heading;

?>

<main>
    <div class="hero_single inner_pages background-image" data-background="url(img/hero_menu.jpg)">
        <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-9 col-lg-10 col-md-8">
                        <h1>Our Shop</h1>
                        <p>Order food with home delivery or take away</p>
                    </div>
                </div>
                <!-- /row -->
            </div>
        </div>
        <div class="frame white"></div>
    </div>
    <!-- /hero_single -->

    <div class="container margin_60_40">
        <div class="row">
            <div class="col-lg-6 magnific-gallery">
                <p>
                    <a href="/admin/images/<?= $data['item_image'] ?>" title="<?= $data['item_name'] ?>"
                        data-effect="mfp-zoom-in" style="justify-content: center; display: flex;"><img
                            src="/admin/images/<?= $data['item_image'] ?>" alt=""
                            style="width: 20em; height: 20em; " class="img-fluid"></a>
                </p>

                <!-- IF YOU WANT TO ADD ANOTHER IMAGE THEN WILL HAVE STATIC SCROLL -->
                <!-- <p>
                    <a href="img/shop/2-small.jpg" title="Photo title" data-effect="mfp-zoom-in"><img src="/assets/img/shop/2-small.jpg" alt="" class="img-fluid lazy"></a>
                </p> -->
            </div>
            <div class="col-lg-6" id="sidebar_fixed">
                <div class="prod_info">

                    <!-- form start -->
                    <form action="" method="POST">
                        <input type="text" name="item_id" value="<?= $data['item_id'] ?>" class="form-control" hidden />
                        <input type="text" name="member_id" value="<?= $userId ?>" class="form-control" hidden />

                        <?php

                        $lastPrice = ($data['discount_status'] > 0) ? $discountPrice : $data['item_price'];

                        ?>
                        <input type="text" name="price" value="<?= $lastPrice ?>" class="form-control" hidden />

                        <span class="rating"><i class="icon_star voted"></i><i class="icon_star voted"></i><i
                                class="icon_star voted"></i><i class="icon_star voted"></i><i
                                class="icon_star"></i><em>4
                                reviews</em></span>
                        <h1><?= $data['item_name'] ?></h1>
                        <p><?= $data['item_description'] ?></p>
                        <!-- <p>Vix patrioque cotidieque ad, iusto probatus volutpat id pri. Amet dicam omnesque at est, voluptua assueverit ut has, modo hinc nec ea. Quas nulla labore est ne, est in quod solet labitur, sit ne probo mandamus.</p> -->
                        <div class="prod_options">
                            <div class="row">
                                <div class="col-auto">
                                    <?php if ($cart): ?>
                                        <p class="mb-0">This item is already in your cart, if you want to change the quantity or remove it, please <a href="/client/ ">Check your cart.</a></p>
                                    <?php else: ?>
                                        <p class="mb-0"><a>You haven't add this item to your cart yet.</a></p>
                                    <?php endif; ?>
                                </div>

                                <div class="col">
                                    <p class="mb-0">In Cart: <b> <?= $cart ? $cart['quantity'] : 0 ?> <?= $data['item_name'] ?></b></p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-xl-5 col-lg-5  col-md-6 col-6"><strong>Quantity</strong></label>
                                <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                    <div class="numbers-row">
                                        <input type="text" value="1" id="quantity_1" class="qty2" name="quantity_1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                <div class="price_main">

                                    <!-- NEW PRICE  -->


                                    <?= $data['discount_status'] ? "
                                    <span class='new_price'>Rp. $discountPriceFormatted </span>
                                    " :

                                        "<span class='new_price'>Rp. $price </span>" ?>


                                    <!-- PERCENT -->
                                    <!-- if discount is true then will show these -->
                                    <?= $data['discount_status'] ? "
                                
                                <span class='percentage'>$discountPercent%</span>
                                " : "" ?>


                                    <!-- OLD PRICE -->
                                    <?= $data['discount_status'] ? "<span class='old_price'>Rp. $price </span>" : "" ?>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="btn_add_to_cart">
                                    <button type="submit" name="addToCart" style="width: 100%;" class="btn_1">
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- form end -->

                </div>
                <!-- /prod_info -->
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->

    <div class="tabs_product">
        <div class="container">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a id="tab-A" href="#pane-A" class="nav-link active" data-bs-toggle="tab" role="tab">Description</a>
                </li>
                <li class="nav-item">
                    <a id="tab-B" href="#pane-B" class="nav-link" data-bs-toggle="tab" role="tab">Reviews</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- /tabs_product -->
    <div class="tab_content_wrapper">
        <div class="container">
            <div class="tab-content" role="tablist">
                <div id="pane-A" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-A">
                    <div class="card-header" role="tab" id="heading-A">
                        <h5 class="mb-0">
                            <a class="collapsed" data-bs-toggle="collapse" href="#collapse-A" aria-expanded="false"
                                aria-controls="collapse-A">
                                Description
                            </a>
                        </h5>
                    </div>
                    <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Details and ingredients</h3>
                                    <p><?= $data['ingredients'] ?? "Not added yet." ?></p>
                                </div>
                                <div class="col-md-6">
                                    <h3>Specifications <?= $data['ingredients'] ?? "" ?></h3>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-striped">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Calories</strong></td>
                                                    <td><?= $data['calories'] ?? "Not added yet." ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Protein</strong></td>
                                                    <td><?= $data['protein'] ?? "Not added yet." ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Carboidrates</strong></td>
                                                    <td><?= $data['carboidrates'] ?? "Not added yet." ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Fat</strong></td>
                                                    <td><?= $data['fat'] ?? "Not added yet." ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /table-responsive -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                    <div class="card-header" role="tab" id="heading-B">
                        <h5 class="mb-0">
                            <a class="collapsed" data-bs-toggle="collapse" href="#collapse-B" aria-expanded="false"
                                aria-controls="collapse-B">
                                Reviews
                            </a>
                        </h5>
                    </div>
                    <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col-lg-6">
                                    <div class="review_content">
                                        <div class="clearfix add_bottom_10">
                                            <span class="rating"><i class="icon_star"></i><i class="icon_star"></i><i
                                                    class="icon_star"></i><i class="icon_star"></i><i
                                                    class="icon_star"></i><em>5.0/5.0</em></span>
                                            <em>Published 54 minutes ago</em>
                                        </div>
                                        <h4>"Commpletely satisfied"</h4>
                                        <p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea.
                                            Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere
                                            fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer
                                            petentium cu his.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="review_content">
                                        <div class="clearfix add_bottom_10">
                                            <span class="rating"><i class="icon_star"></i><i class="icon_star"></i><i
                                                    class="icon_star"></i><i class="icon_star empty"></i><i
                                                    class="icon_star empty"></i><em>4.0/5.0</em></span>
                                            <em>Published 1 day ago</em>
                                        </div>
                                        <h4>"Always the best"</h4>
                                        <p>Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere
                                            fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer
                                            petentium cu his.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                            <div class="row justify-content-between">
                                <div class="col-lg-6">
                                    <div class="review_content">
                                        <div class="clearfix add_bottom_10">
                                            <span class="rating"><i class="icon_star"></i><i class="icon_star"></i><i
                                                    class="icon_star"></i><i class="icon_star"></i><i
                                                    class="icon_star empty"></i><em>4.5/5.0</em></span>
                                            <em>Published 3 days ago</em>
                                        </div>
                                        <h4>"Outstanding"</h4>
                                        <p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea.
                                            Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere
                                            fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer
                                            petentium cu his.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="review_content">
                                        <div class="clearfix add_bottom_10">
                                            <span class="rating"><i class="icon_star"></i><i class="icon_star"></i><i
                                                    class="icon_star"></i><i class="icon_star"></i><i
                                                    class="icon_star"></i><em>5.0/5.0</em></span>
                                            <em>Published 4 days ago</em>
                                        </div>
                                        <h4>"Excellent"</h4>
                                        <p>Sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius
                                            essent fuisset ut. Viderer petentium cu his.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                            <p class="text-end"><a href="leave-review.html" class="btn_1">Leave a review</a></p>
                        </div>
                        <!-- /card-body -->
                    </div>
                </div>
            </div>
            <!-- /tab-content -->
        </div>
    </div>
</main>

<?php
$script = "
	<script>
		// Sticky sidebar
		$('#sidebar_fixed').theiaStickySidebar({
			minWidth: 991,
			updateSidebarHeight: true,
			additionalMarginTop: 90
		});
	</script>
    ";



echo $script;

?>





<?php include_once __DIR__ . '/../partials/layouts/layout-bottom.php';
