<?php include_once __DIR__ . '/partials/layouts/layout-top.php';

require_once __DIR__ .  '/conf/function.php';

$memberId = $_SESSION['memberId'];
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
                        <h1>Your orders</h1>
                        <p>Order food with home delivery or take away</p>
                    </div>
                </div>
                <!-- /row -->
            </div>
        </div>
        <div class="frame gray"></div>
    </div>
    <!-- /hero_single -->

    <div class="bg_gray">
        <div class="container margin_60_40">

            <form method="post">
                <table class="table table-striped cart-list">
                    <thead>
                        <tr>
                            <th>
                                Product
                            </th>
                            <th>
                                Price
                            </th>
                            <th>
                                Quantity
                            </th>
                            <th>
                                Subtotal
                            </th>
                            <th>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $item = query("SELECT c.*, m.* FROM cart c JOIN menu m ON c.item_id = m.item_id WHERE member_id = $memberId");

                        // jika cart masih kosong maka tampilkan
                        // pesan bahwa cart masih kosong
                        if (count($item) == 0) {
                            echo "<tr><td colspan='5' class='text-center'>Cart is empty</td></tr>";
                        }
                        foreach ($item as $cart) :

                            // terpapkan price dan discount ke dalam variable
                            // jika item memiliki diskon maka harga yang dihitung adalah harga asli dikurangi diskon
                            // jika item tidak memiliki diskon maka harga yang dihitung adalah harga asli
                            $priceBefore = $cart['discount_status'] > 0 ?
                                $cart['item_price'] - ($cart['item_price'] * ($cart['discount'] / 100))
                                :
                                $cart['item_price'];

                            // format harga setelah diskon, contoh = 7500 -> 7.500
                            $price = number_format($priceBefore, 0, ',', '.');

                            $originalPrice = number_format($cart['item_price'], 0, ',', '.');
                        ?>
                            <tr>
                                <td>
                                    <div class="thumb_cart">
                                        <img src="/admin/images/<?= $cart['item_image'] ?>" data-src="/admin/images/<?= $cart['item_image'] ?>" class="lazy" alt="Image">
                                    </div>
                                    <span class="item_cart"><?= $cart['quantity'] ?>x <?= $cart['item_name'] ?></span>
                                </td>
                                <td>
                                    <strong>Rp. <?= $originalPrice ?></strong>
                                </td>
                                <td>
                                    <div class="numbers-row">
                                        <input type="text" name="quantity<?= $cart['item_id'] ?>" value="<?= $cart['quantity'] ?>" id="quantity_1" class="qty2" name="quantity_1">
                                        <div class="inc button_inc">+</div>
                                        <div class="dec button_inc">-</div>
                                    </div>
                                </td>
                                <td>
                                    <strong>Rp. <?= $price ?></strong>
                                </td>
                                <td class="options">
                                    <a href="#"><i class="ti-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <?php
                // jika ada data di dalam array $item maka akan menampilkan list cart
                // jika tidak ada maka akan menampilkan pesan "Let's go shopping!"
                if (count($item) > 0) :
                ?>
                    <div class="row add_top_30 flex-sm-row-reverse cart_actions">

                        <div class="col-sm-4 text-end">
                            <button type="submit" name="updateCart" class="btn_1 outline">Update Cart</button>
                        </div>
                        <div class="col-sm-8">
                            <div class="apply-coupon">
                                <div class="form-group form-inline">
                                    <input type="text" name="coupon-code" value="" placeholder="Promo code" class="form-control d-inline" style="width: 150px;"><button type="button" class="btn_1 outline">Apply Coupon</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /cart_actions -->

                <?php endif; ?>


            </form>

            <?php

            if (isset($_POST['updateCart'])) {
                // menambil isi tabel cart, dan menu yang dimana berdasarkan member_id (isi cart yang dimiliki oleh member)
                $item = query("SELECT c.*, m.* FROM cart c JOIN menu m ON c.item_id = m.item_id WHERE member_id = $memberId");


                foreach ($item as $cart) {
                    $quantity = $_POST['quantity' . $cart['item_id']];
                    $itemId = $cart['item_id'];

                    if ($quantity == 0) {
                        // jika quantity item itu 0 maka akan dihapus dari cart
                        if (deleteCart($memberId, $itemId) > 0) {
                            echo "<script>window.location.href = '/cart/?deleted=1'</script>";
                        } else {
                            echo "<script>window.location.href = '/cart/?deleted=0'</script>";
                        };
                    }

                    // Jika quantity lebih dari 10 maka akan di arahkan ke halaman shop-single.php dengan parameter status = 3


                    // Jika quantity lebih dari 11 maka akan di arahkan ke halaman shop-single.php dengan parameter status = 5
                    if ($quantity > 11 || $quantity == 11) {
                        echo "<script>window.location.href = '/cart/?updated=-1'</script>";
                        exit;
                    }

                    $query = "UPDATE cart SET quantity = $quantity WHERE member_id = $memberId AND item_id = '$itemId'";
                    $result = mysqli_query($conn, $query);

                    // jika gagal dan jika berhasil akan mengarahkan ke halaman cart lagi tetapi diberikan juga notifikiasi nya, gagal atau berhasil itu berdasarkan isi parameter 0 atau 1
                    if (mysqli_affected_rows($conn) > 0) {
                        echo "<script>window.location.href = '/cart/?updated=1'</script>";
                    }
                }
            }


            // echo "affected rows: " . mysqli_affected_rows($conn) . "<br>";

            ?>
        </div>

        <!-- /container -->
    </div>



    <div class="box_cart">
        <div class="container">
            <div class="row justify-content-end">
                <?php
                // jika tidak ada item di dalam cart maka akan menampilkan pesan "Let's go shopping!"
                // jika ada item di dalam cart maka akan menampilkan list cart
                if (count($item) == 0) :
                ?>
                    <tr>
                        <td colspan='5' class='text-center'><a href="/shop" class="btn_1">Let's go shopping!</a></td>
                    </tr>
                <?php else: ?>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <?php
                        // Kode di bawah ini digunakan untuk menghitung total biaya
                        // yang dihitung dari setiap item di cart, lalu dijumlahkan
                        // menjadi total biaya yang harus dibayarkan
                        //
                        // array_reduce() digunakan untuk menggabungkan nilai-nilai
                        // di dalam array dengan menggunakan fungsi yang di
                        // tentukan, dan mengembalikan nilai yang dihasilkan
                        //
                        // $total diinisialisasi dengan 0, lalu dijumlahkan dengan
                        // biaya setiap item di cart
                        //
                        // $discountPrice dihitung dari harga asli, dan dijumlahkan
                        // dengan biaya setiap item di cart. Jika item memiliki
                        // diskon, maka harga yang dihitung adalah harga asli
                        // dikurangi diskon.
                        $total = array_reduce($item, function ($total, $item) {
                            $discountPrice = $item['item_price'] - ($item['item_price'] * ($item['discount'] / 100));
                            return $total + $item['quantity'] * $discountPrice;
                        }, 0);
                        $subtotal = 0;
                        foreach ($item as $cart) {

                            $subtotal += $cart['quantity'] * $cart['item_price'];
                        }
                        $subtotal = number_format($subtotal, 0, ',', '.');
                        $total = number_format($total, 0, ',', '.');
                        ?>


                        <?php
                        // kode di bawah ini digunakan untuk menghitung total biaya
                        // yang dihitung dari setiap item di cart, lalu dijumlahkan
                        // menjadi total biaya yang harus dibayarkan
                        //
                        //* Diskon dihitung dari harga asli, dan dijumlahkan dengan biaya setiap item di cart
                        //* Jika item memiliki diskon, maka harga yang dihitung adalah harga setelah diskon
                        //* Jika item tidak memiliki diskon, maka harga yang dihitung adalah harga asli
                        //
                        ?>

                        <ul>
                            <li>
                                <b <span>Subtotal</span><?= 'Rp. <s>' . $subtotal ?></b></s>

                            </li>
                            <?php
                            // kode di bawah ini digunakan untuk menghitung total biaya
                            // yang dihitung dari setiap item di cart, lalu dijumlahkan
                            // menjadi total biaya yang harus dibayarkan
                            //
                            //foreach digunakan untuk mengulang setiap item di cart
                            //
                            // Jika item memiliki diskon, maka harga yang dihitung
                            // adalah harga asli dikurangi diskon
                            //
                            // number_format() digunakan untuk memformat biaya agar
                            // terlihat lebih bagus
                            //
                            foreach ($item as $cart) :
                            ?>
                                <?php
                                // jika item memiliki diskon, maka tampilkan diskonya
                                //
                                if ($cart['discount'] > 0) :
                                ?>
                                    <li>
                                        <span>
                                            <?= $cart['item_name'] ?> (<?= $cart['discount'] ?>% off)
                                        </span>
                                        <?= 'Rp. ' . number_format($cart['quantity'] * ($cart['item_price'] - $cart['item_price'] * ($cart['discount'] / 100)), 0, ',', '.') ?>
                                    </li>
                            <?php
                                endif;
                            endforeach;
                            ?>
                            <li>
                                <span>Total</span> <?= "Rp. $total"; ?>
                            </li>
                        </ul>
                        <a href="/checkout/" class="btn_1 full-width cart">Proceed to Checkout</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- /box_cart -->
</main>

<!-- footer -->
<?php include_once __DIR__ . '/partials/layouts/layout-bottom.php' ?>