<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/restaurant/conf/function.php';


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
            <a href="/restaurant/">
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
                        <a href="javascript:0;" class="cart_bt"><strong>2</strong></a>
                        <div class="dropdown-menu">
                            <ul>
                                <?php
                                $cart = query("SELECT c.quantity, m.item_name, m.item_price, m.item_image, c.added_at 
                                    FROM cart c JOIN menu m ON c.item_id = m.item_id 
                                    WHERE c.member_id = $memberID ORDER BY c.added_at DESC");
                                foreach ($cart as $item) :
                                ?>
                                    <li>
                                        <figure><img src="/restaurant/admin/images/<?= $item['item_image'] ?>"
                                                alt="" width="50" height="50" class="lazy"></figure>
                                        <strong><span><?= $item['quantity'] . 'x ' . $item['item_name'] ?></span><?= 'Rp. ' . number_format($item['quantity'] * $item['item_price'], 0, ',', '.') ?></strong>
                                        <a href="#0" class="action"><i class="icon_trash_alt"></i></a>
                                    </li>


                                <?php endforeach; ?>
                            </ul>
                            <div class="total_drop">
                                <?php
                                // hitung total biaya dengan menjumlahkan setiap item di cart
                                // foreach digunakan untuk mengulang setiap item di cart
                                // $total diinisialisasi dengan 0, lalu dijumlahkan dengan biaya setiap item di cart
                                $total = array_reduce($cart, function ($total, $item) {
                                    return $total + ($item['quantity'] * $item['item_price']);
                                }, 0);
                                ?>

                                <!-- menghitung total biaya dengan menjumlahkan setiap item di cart -->


                                <!-- number_format digunakan untuk memformat angka menjadi format rupiah -->
                                <!-- number_format memiliki 4 parameter, yaitu: nilai yang ingin diformat, berapa banyak angka di belakang koma, karakter pemisah ribuan, dan karakter pemisah desimal -->
                                <!-- dalam contoh ini, kita menggunakan 0 untuk berapa banyak angka di belakang koma, ',' sebagai karakter pemisah ribuan, dan '.' sebagai karakter pemisah desimal -->
                                 
                                <div class="clearfix add_bottom_15"><strong>Total</strong><span><?= 'Rp. ' . number_format($total, 0, ',', '.'); ?></span></div>
                                <a href="javascript:0;" class="btn_1 outline">View Cart</a><a href="shop-checkout.html"
                                    class="btn_1">Checkout</a>
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
                <a href="/restaurant/"><img src="https://www.ansonika.com/foores/img/logo.svg" width="140" height="35"
                        alt=""></a>
            </div>
            <ul>
                <li class="submenu">
                    <a href="#0" class="show-submenu">Home</a>
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
                    <a href="/restaurant/shop/" class="show-submenu">Shop</a>

                </li>
                <li><a href="/restaurant/reservation/">Reservations</a></li>

                <?php if (isset($_SESSION['isLogin']) == false) { ?>
                    <li>
                        <a href="/restaurant/login/" class="btn_top">Login</a>
                    </li>

                <?php } else { ?>
                    <li class="submenu">
                        <a href="#0" class="show-submenu btn_top "><i class="ri-id-card-line"
                                style="margin-right: 7px"></i><?= $member['member_name'] ?: 'Guest'  ?></a>
                        <ul>
                            <li><a href="/restaurant/client/">Dashboard</a></li>

                            <!-- jika member point kosong maka akan di berikan 0 dan itupun berlaku untuk point jika null -->
                            <li><a href="javascript:0;">Points:
                                    <?= $member['points'] == null  ? '0' : $member['points'] ?></a>
                            </li>
                            <li><a href="/restaurant/logout.php">Logout</a></li>
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