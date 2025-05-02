<?php
require_once __DIR__ . '/conf/function.php';


if (isset($_SESSION['isLogin']) == true) {

    $memberID = $_SESSION['memberId'];
    $member = query("SELECT * FROM memberships WHERE member_id = $memberID")[0];
}
?>

<!-- /header -->
<header class="header clearfix element_to_stick">
    <div class="layer"></div><!-- Opacity Mask Menu Mobile -->
    <div class="container-fluid">
        <div id="logo">
            <a href="/">
                <img src="https://www.ansonika.com/foores/img/logo.svg" width="140" height="35" alt=""
                    class="logo_normal">
                <img src="https://www.ansonika.com/foores/img/logo_sticky.svg" width="140" height="35" alt=""
                    class="logo_sticky">
            </a>
        </div>
        <ul id="top_menu">
            <li><a href="#0" class="search-overlay-menu-btn"></a></li>

            <?php if (isset($_SESSION['isLogin']) == true) : ?><li>
                    <div class="dropdown dropdown-cart">
                        <?php $count = count(query("SELECT * FROM cart WHERE member_id = $memberID")); ?>
                        <a href="/cart/" class="cart_bt">
                            <strong>
                                <?= $count ?>
                            </strong>
                        </a>
                        <div class="dropdown-menu">
                            <ul>
                                <?php
                                $cart = query("SELECT c.quantity, m.item_name, m.item_price, m.item_image, c.added_at , m.item_id, m.discount, m.item_price
                                    FROM cart c JOIN menu m ON c.item_id = m.item_id 
                                    WHERE c.member_id = $memberID ORDER BY c.added_at DESC");


                                foreach ($cart as $item) :
                                    // Kode di bawah ini digunakan untuk menghitung harga setelah diskon
                                    // $discountPrice dihitung dari harga asli, dan dijumlahkan dengan biaya setiap item di cart
                                    // Jika item memiliki diskon, maka harga yang dihitung adalah harga setelah diskon
                                    // Jika item tidak memiliki diskon, maka harga yang dihitung adalah harga asli
                                    $discountPrice = $item['item_price'] - $item['item_price'] * ($item['discount'] / 100);
                                ?>
                                    <li>
                                        <figure>
                                            <img src="/admin/images/<?= $item['item_image'] ?>"
                                                alt="" width="50" height="50" class="lazy">
                                        </figure>
                                        <strong>
                                            <span>
                                                <?php // Kode di bawah ini digunakan untuk menampilkan jumlah item 
                                                ?>
                                                <?= $item['quantity'] . 'x ' . $item['item_name'] ?>
                                            </span>
                                            <?php
                                            //
                                            // Kode di bawah ini digunakan untuk menampilkan harga setelah diskon
                                            // - Jika item memiliki diskon maka harga yang dihitung adalah harga asli
                                            //   dikurangi diskon, contoh harga asli 10000, diskon 25% maka harga setelah diskon adalah 7500
                                            // - Jika item tidak memiliki diskon maka harga yang dihitung adalah harga asli
                                            // - Harga yang dihitung dijumlahkan dengan biaya setiap item di cart
                                            // - Lalu di format menjadi string dengan menggunakan number_format()
                                            ?>
                                            <?= 'Rp. ' . number_format(($item['discount'] > 0 ? $discountPrice : $item['item_price']) * $item['quantity'], 0, ',', '.') ?>
                                        </strong>



                                        <!-- delete cart -->
                                        <a href="/shop/delete-cart.php?itemId=<?= $item['item_id'] ?>" class="action"><i class="icon_trash_alt"></i></a>
                                    </li>


                                <?php endforeach; ?>
                            </ul>
                            <div class="total_drop">
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
                                $total = array_reduce($cart, function ($total, $item) {
                                    $discountPrice = $item['item_price'] - ($item['item_price'] * ($item['discount'] / 100));
                                    return $total + $item['quantity'] * $discountPrice;
                                }, 0); // initial value untuk $total, jika array kosong maka $total = 0
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

                                <div class="clearfix add_bottom_15">
                                    <strong>Total</strong><span>
                                        <?= 'Rp. ' . number_format($total, 0, ',', '.'); ?>
                                    </span>
                                </div>
                                <a href="/cart/" class="btn_1 outline">
                                    View Cart
                                </a>
                                <a href="/checkout"
                                    class="btn_1">
                                    Checkout
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <!-- /dropdown-cart-->
                </li>
        </ul>
        <!-- /top_menu -->
        <a href="#0" class="open_close">
            <i class="icon_menu"></i><span>Menu</span>
        </a>
        <nav class="main-menu">
            <div id="header_menu">
                <a href="#0" class="open_close">
                    <i class="icon_close"></i><span>Menu</span>
                </a>
                <a href="/"><img src="https://www.ansonika.com/foores/img/logo.svg" width="140" height="35"
                        alt=""></a>
            </div>
            <ul>
                <li class="submenu">
                    <a href="/" class="show-submenu">Home</a>
                    <ul>
                        <li><a href="index-7.html">KenBurns Slider <span class="badge text-bg-danger">New</span></a>
                        </li>
                        <li><a href="index.html">Slider 1</a></li>
                        <li><a href="index-2.html">Slider 2</a></li>
                        <li><a href="index-6.html">Slider 3</a></li>
                        <li><a href="index-3.html">Video Background</a></li>
                        <li><a href="index-5.html">Text Rotator</a></li>
                        <li><a href="index-4.html">GDPR Cookie Bar EU Law</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#0" class="show-submenu">Menu</a>
                    <ul>
                        <li><a href="menu-1.html">Menu 2 Column</a></li>
                        <li><a href="menu-2.html">Menu Add To Cart</a></li>
                        <li><a href="menu-3.html">Menu With Tabs</a></li>
                        <li><a href="menu-4.html">Menu Grid</a></li>
                        <li><a href="menu-of-the-day.html">Menu of the Day <span
                                    class="badge badge-danger">HOT</span></a></li>
                        <li><a href="order-food.html">Order Food</a></li>
                        <li><a href="confirm.html">Confirm</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#0" class="show-submenu">Other Pages</a>
                    <ul>
                        <li><a href="about.html">About</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="gallery.html">Gallery</a></li>
                        <li><a href="gallery-2.html">Gallery Masonry</a></li>
                        <li><a href="modal-advertise.html">Modal Advertise</a></li>
                        <li><a href="modal-newsletter.html">Modal Newsletter</a></li>
                        <li><a href="404.html">404 Error page</a></li>
                        <li><a href="coming-soon.html" target="_blank">Coming Soon</a></li>
                        <li><a href="leave-review.html">Leave a review</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="icon-pack-1.html">Icon Pack 1</a></li>
                        <li><a href="icon-pack-2.html">Icon Pack 2</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="/shop/" class="show-submenu">Shop</a>

                </li>
                <li><a href="/reservation/">Reservations</a></li>

                <?php if (isset($_SESSION['isLogin']) == false) { ?>
                    <li>
                        <a href="/login/" class="btn_top">Login</a>
                    </li>

                <?php } else { ?>
                    <li class="submenu">
                        <a href="#0" class="show-submenu btn_top "><i class="ri-id-card-line"
                                style="margin-right: 7px"></i><?= $member['member_name'] ?: 'Guest'  ?></a>
                        <ul>
                            <li><a href="/client/">Dashboard</a></li>

                            <!-- jika member point kosong maka akan di berikan 0 dan itupun berlaku untuk point jika null -->
                            <li><a href="javascript:0;">Points:
                                    <?= $member['points'] == null  ? '0' : $member['points'] ?></a>
                            </li>
                            <li><a href="/logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
    <!-- Search -->
    <div class="search-overlay-menu">
        <span class="search-overlay-close"><span class="closebt"><i class="icon_close"></i></span></span>
        <form role="search" id="searchform" method="get">
            <input value="" name="q" type="search" placeholder="Search..." />
            <button type="submit"><i class="icon_search"></i></button>
        </form>
    </div><!-- End Search -->
</header>
<!-- /header -->