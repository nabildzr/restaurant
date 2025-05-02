<?php
include_once __DIR__ . '/partials/layouts/layout-top.php';
require_once __DIR__ .  '/conf/connection.php';
require_once __DIR__ . '/conf/function.php';
?>


<?php

if (isset($_GET['type'])) {
    $type = $_GET['type'];

    $query = "SELECT * FROM products WHERE type = '$type'";
    $menu = query($query);
}

?>

<div id="QuickView" class="white-popup mfp-hide">
    <div class="container bg-white">
        <div class="row">
            <div class="col-lg-7">
                <div class="product-thumb-area">
                    <div class="product-thumb-tab" data-asnavfor=".product-big-img">
                        <div class="tab-btn active">
                            <img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/menu_thumb_1_1.png" alt="Product Thumb">
                        </div>
                        <div class="tab-btn">
                            <img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/menu_thumb_1_2.png" alt="Product Thumb">
                        </div>
                        <div class="tab-btn">
                            <img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/menu_thumb_1_3.png" alt="Product Thumb">
                        </div>
                        <div class="tab-btn">
                            <img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/menu_thumb_1_4.png" alt="Product Thumb">
                        </div>
                        <div class="tab-btn">
                            <img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/menu_thumb_1_5.png" alt="Product Thumb">
                        </div>
                    </div>
                    <div class="product-big-img th-carousel" data-slide-show="1" data-md-slide-show="1" data-fade="true">
                        <div class="col-auto">
                            <div class="img"><img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/product_details_1_1.png" alt="Product Image"></div>
                        </div>
                        <div class="col-auto">
                            <div class="img"><img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/product_details_1_2.png" alt="Product Image"></div>
                        </div>
                        <div class="col-auto">
                            <div class="img"><img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/product_details_1_3.png" alt="Product Image"></div>
                        </div>
                        <div class="col-auto">
                            <div class="img"><img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/product_details_1_4.png" alt="Product Image"></div>
                        </div>
                        <div class="col-auto">
                            <div class="img"><img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/product_details_1_5.png" alt="Product Image"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 align-self-center">
                <div class="product-about">
                    <div class="product-rating">
                        <div class="star-rating" role="img" aria-label="Rated 5.00 out of 5"><span style="width:100%">Rated <strong class="rating">5.00</strong> out of 5 based on <span class="rating">1</span> customer rating</span></div>
                        <a href="shop-details.html" class="woocommerce-review-link">(<span class="count">3</span> customer reviews)</a>
                    </div>
                    <h2 class="product-title">Chicken Masala</h2>
                    <p class="price">$180.85<del>$350.99</del></p>
                    <p class="text">There are many variations of passages of lorem Ipum available theresu anything embarrassing It’s a long established fact that a reader will be looking at its layout.</p>
                    <div class="actions">
                        <div class="quantity">
                            <input type="number" class="qty-input" step="1" min="1" max="100" name="quantity" value="1" title="Qty">
                            <button class="quantity-plus qty-btn"><i class="far fa-chevron-up"></i></button>
                            <button class="quantity-minus qty-btn"><i class="far fa-chevron-down"></i></button>
                        </div>
                        <button class="th-btn">Add to Cart</button>
                        <a class="icon-btn" href="wishlist.html"><i class="fal fa-heart"></i></a>
                    </div>
                    <div class="product_meta">
                        <span class="sku_wrapper">SKU: <span class="sku">C2546</span></span>
                        <span class="posted_in">Category: <a href="shop.html" rel="tag">Chicken Pizza</a></span>
                        <span>Tags: <a href="shop.html">Fast Food</a><a href="shop.html">Grill</a></span>
                    </div>
                    <div class="share">
                        <p class="share-title"><i class="fa-solid fa-share"></i> Share</p>
                        <!-- Social Icon Url will be share action -->
                        <div class="th-social">
                            <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                            <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                            <a target="_blank" href="https://instagram.com/"><i class="fab fa-instagram"></i></a>
                            <a target="_blank" href="https://linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button title="Close (Esc)" type="button" class="mfp-close">×</button>
    </div>
</div>

<div class="breadcumb-wrapper " data-bg-src="https://themeholy.com/html/pizzan/demo/assets/img/update_2/bg/breadcumb_bg_2.jpg">
    <div class="container z-index-common">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">Shop Details v2</h1>
            <ul class="breadcumb-menu">
                <li><a href="index.html">Home</a></li>
                <li>Shop Details v2</li>
            </ul>
        </div>
    </div>
</div><!--==============================
    Product Details
    ==============================-->
<section class="th-product-wrapper product-details space-top space-extra-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="product-thumb-area">
                    <div class="product-thumb-tab" data-asnavfor=".product-big-img">
                        <div class="tab-btn active">
                            <img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/menu_thumb_1_1.png" alt="Product Thumb">
                        </div>
                        <div class="tab-btn">
                            <img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/menu_thumb_1_2.png" alt="Product Thumb">
                        </div>
                        <div class="tab-btn">
                            <img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/menu_thumb_1_3.png" alt="Product Thumb">
                        </div>
                        <div class="tab-btn">
                            <img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/menu_thumb_1_4.png" alt="Product Thumb">
                        </div>
                        <div class="tab-btn">
                            <img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/menu_thumb_1_5.png" alt="Product Thumb">
                        </div>
                    </div>
                    <div class="product-big-img th-carousel" data-slide-show="1" data-md-slide-show="1" data-fade="true">
                        <div class="col-auto">
                            <div class="img"><img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/product_details_1_1.png" alt="Product Image"></div>
                        </div>
                        <div class="col-auto">
                            <div class="img"><img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/product_details_1_2.png" alt="Product Image"></div>
                        </div>
                        <div class="col-auto">
                            <div class="img"><img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/product_details_1_3.png" alt="Product Image"></div>
                        </div>
                        <div class="col-auto">
                            <div class="img"><img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/product_details_1_4.png" alt="Product Image"></div>
                        </div>
                        <div class="col-auto">
                            <div class="img"><img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/product_details_1_5.png" alt="Product Image"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 align-self-center">
                <div class="product-about">
                    <div class="product-rating">
                        <div class="star-rating" role="img" aria-label="Rated 5.00 out of 5"><span style="width:100%">Rated <strong class="rating">5.00</strong> out of 5 based on <span class="rating">1</span> customer rating</span></div>
                        <a href="shop-details.html" class="woocommerce-review-link">(<span class="count">3</span> customer reviews)</a>
                    </div>
                    <h2 class="product-title">Chicken Masala</h2>
                    <p class="price">$180.85<del>$350.99</del></p>
                    <p class="text">There are many variations of passages of lorem Ipum available theresu anything embarrassing It’s a long established fact that a reader will be looking at its layout.</p>
                    <div class="actions">
                        <div class="quantity">
                            <input type="number" class="qty-input" step="1" min="1" max="100" name="quantity" value="1" title="Qty">
                            <button class="quantity-plus qty-btn"><i class="far fa-chevron-up"></i></button>
                            <button class="quantity-minus qty-btn"><i class="far fa-chevron-down"></i></button>
                        </div>
                        <button class="th-btn">Add to Cart</button>
                        <a class="icon-btn" href="wishlist.html"><i class="fal fa-heart"></i></a>
                    </div>
                    <div class="product_meta">
                        <span class="sku_wrapper">SKU: <span class="sku">C2546</span></span>
                        <span class="posted_in">Category: <a href="shop.html" rel="tag">Chicken Pizza</a></span>
                        <span>Tags: <a href="shop.html">Fast Food</a><a href="shop.html">Grill</a></span>
                    </div>
                    <div class="share">
                        <p class="share-title"><i class="fa-solid fa-share"></i> Share</p>
                        <!-- Social Icon Url will be share action -->
                        <div class="th-social">
                            <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                            <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                            <a target="_blank" href="https://instagram.com/"><i class="fab fa-instagram"></i></a>
                            <a target="_blank" href="https://linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ul class="nav product-tab-style1" id="productTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link th-btn" id="description-tab" data-bs-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="false">Product Description</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link th-btn active" id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="true">Customer Reviews</a>
            </li>
        </ul>
        <div class="tab-content" id="productTabContent">
            <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description-tab">
                <p>Conveniently build adaptive users with front-end human capital. Appropriately unleash team building technology for goal-oriented paradigms. Dynamically generate interoperable e-business vis-a-visgoal-oriented value. Completely pursue fully tested content whereas multifunctional core competencies. Progressively scale team driven process improvements before premier functionalities. Holisticly cultivate intermandated methodologies rather than virtual technology. Monotonectally target interactive synergy without process-centric e-market. Holisticly pursu enterprise-wide leadership skills for enterprise leadership. Collaboratively underwhelm standardized expertise after effective bandwidth. Conveniently productivate holistic collaboration and idea-sharing rather than granular strategic theme areas. </p>
                <p>Enthusiastically aggregate ethical systems for standardized mindshare. Energistically target resource maximizing leadership skills without backward-compatible action items. Credibly impact alternative expertise vis-a-vis economically sound results. Dynamically synergize empowered benefits through functional partnerships. Authoritatively empower prospective infomediaries for interactive content. Synergistically embrace 2.0 paradigms through professional intellectual capital. Interactively strategize parallel growth strategies without out-of-the-box web services. Assertively reinvent installed base.</p>
            </div>
            <div class="tab-pane fade show active" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                <div class="woocommerce-Reviews">
                    <div class="th-comments-wrap ">
                        <ul class="comment-list">
                            <li class="review th-comment-item">
                                <div class="th-post-comment">
                                    <div class="comment-avater">
                                        <img src="https://themeholy.com/html/pizzan/demo/assets/img/blog/comment-author-3.jpg" alt="Comment Author">
                                    </div>
                                    <div class="comment-content">
                                        <h4 class="name">Mark Jack</h4>
                                        <span class="commented-on"><i class="fal fa-calendar-alt"></i>22 April, 2023</span>
                                        <div class="star-rating" role="img" aria-label="Rated 5.00 out of 5">
                                            <span style="width:100%">Rated <strong class="rating">5.00</strong> out of 5 based on <span class="rating">1</span> customer rating</span>
                                        </div>
                                        <p class="text">Completely build enabled web-readiness and distributed customer service. Proactively customize.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="review th-comment-item">
                                <div class="th-post-comment">
                                    <div class="comment-avater">
                                        <img src="https://themeholy.com/html/pizzan/demo/assets/img/blog/comment-author-2.jpg" alt="Comment Author">
                                    </div>
                                    <div class="comment-content">
                                        <h4 class="name">Alexa Deo</h4>
                                        <span class="commented-on"><i class="fal fa-calendar-alt"></i>26 April, 2023</span>
                                        <div class="star-rating" role="img" aria-label="Rated 5.00 out of 5">
                                            <span style="width:100%">Rated <strong class="rating">5.00</strong> out of 5 based on <span class="rating">1</span> customer rating</span>
                                        </div>
                                        <p class="text">Completely build enabled web-readiness and distributed customer service. Proactively customize.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="review th-comment-item">
                                <div class="th-post-comment">
                                    <div class="comment-avater">
                                        <img src="https://themeholy.com/html/pizzan/demo/assets/img/blog/comment-author-1.jpg" alt="Comment Author">
                                    </div>
                                    <div class="comment-content">
                                        <h4 class="name">Tara sing</h4>
                                        <span class="commented-on"><i class="fal fa-calendar-alt"></i>26 April, 2023</span>
                                        <div class="star-rating" role="img" aria-label="Rated 5.00 out of 5">
                                            <span style="width:100%">Rated <strong class="rating">5.00</strong> out of 5 based on <span class="rating">1</span> customer rating</span>
                                        </div>
                                        <p class="text">Completely build enabled web-readiness and distributed customer service. Proactively customize.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="review th-comment-item">
                                <div class="th-post-comment">
                                    <div class="comment-avater">
                                        <img src="https://themeholy.com/html/pizzan/demo/assets/img/blog/comment-author-3.jpg" alt="Comment Author">
                                    </div>
                                    <div class="comment-content">
                                        <h4 class="name">Tara sing</h4>
                                        <span class="commented-on"><i class="fal fa-calendar-alt"></i>26 April, 2023</span>
                                        <div class="star-rating" role="img" aria-label="Rated 5.00 out of 5">
                                            <span style="width:100%">Rated <strong class="rating">5.00</strong> out of 5 based on <span class="rating">1</span> customer rating</span>
                                        </div>
                                        <p class="text">Completely build enabled web-readiness and distributed customer service. Proactively customize.</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div> <!-- Comment Form -->
                    <div class="th-comment-form ">
                        <div class="form-title">
                            <h3 class="blog-inner-title ">Add a review</h3>
                        </div>
                        <div class="row">
                            <div class="form-group rating-select d-flex align-items-center">
                                <label>Your Rating</label>
                                <p class="stars">
                                    <span>
                                        <a class="star-1" href="#">1</a>
                                        <a class="star-2" href="#">2</a>
                                        <a class="star-3" href="#">3</a>
                                        <a class="star-4" href="#">4</a>
                                        <a class="star-5" href="#">5</a>
                                    </span>
                                </p>
                            </div>
                            <div class="col-12 form-group">
                                <textarea placeholder="Write a Message" class="form-control"></textarea>
                                <i class="text-title far fa-pencil-alt"></i>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" placeholder="Your Name" class="form-control">
                                <i class="text-title far fa-user"></i>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" placeholder="Your Email" class="form-control">
                                <i class="text-title far fa-envelope"></i>
                            </div>
                            <div class="col-12 form-group">
                                <input id="reviewcheck" name="reviewcheck" type="checkbox">
                                <label for="reviewcheck">Save my name, email, and website in this browser for the next time I comment.<span class="checkmark"></span></label>
                            </div>
                            <div class="col-12 form-group mb-0">
                                <button class="th-btn rounded-2">Post Review</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--==============================
		Related Product  
		==============================-->
        <div class="space-extra-top mb-30">
            <div class="title-area text-center">
                <h2 class="sec-title">Related Products</h2>
                <p class="sec-text ms-auto me-auto">Objectively pontificate quality models before intuitive information. Dramatically recaptiualize multifunctional materials.</p>
            </div>
            <div class="row slider-shadow th-carousel" data-slide-show="4" data-lg-slide-show="3" data-md-slide-show="2" data-sm-slide-show="2" data-xs-slide-show="1" data-arrows="true">

                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="th-product">
                        <div class="product-img">
                            <img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/menu_1_1.png" alt="Product Image">
                        </div>
                        <div class="product-content">
                            <a href="shop.html" class="category">Chicken</a>
                            <div class="product-rating">
                                <div class="star-rating" role="img" aria-label="Rated 4.00 out of 5">
                                    <span style="width:75%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                </div>
                                (4.00)
                            </div>
                            <h3 class="product-title"><a href="shop-details.html">Daria Shevtsova</a></h3>
                            <span class="price">$80.85<del>$99.99</del></span>
                            <div class="actions">
                                <a href="#QuickView" class="icon-btn popup-content"><i class="fal fa-eye"></i></a>
                                <a href="cart.html" class="icon-btn"><i class="fal fa-cart-plus"></i></a>
                                <a href="wishlist.html" class="icon-btn"><i class="fal fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="th-product">
                        <div class="product-img">
                            <img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/menu_1_2.png" alt="Product Image">
                        </div>
                        <div class="product-content">
                            <a href="shop.html" class="category">Chicken</a>
                            <div class="product-rating">
                                <div class="star-rating" role="img" aria-label="Rated 4.00 out of 5">
                                    <span style="width:75%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                </div>
                                (4.00)
                            </div>
                            <h3 class="product-title"><a href="shop-details.html">Chicken Masala</a></h3>
                            <span class="price">$90.85</span>
                            <div class="actions">
                                <a href="#QuickView" class="icon-btn popup-content"><i class="fal fa-eye"></i></a>
                                <a href="cart.html" class="icon-btn"><i class="fal fa-cart-plus"></i></a>
                                <a href="wishlist.html" class="icon-btn"><i class="fal fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="th-product">
                        <div class="product-img">
                            <img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/menu_1_3.png" alt="Product Image">
                        </div>
                        <div class="product-content">
                            <a href="shop.html" class="category">Pizza</a>
                            <div class="product-rating">
                                <div class="star-rating" role="img" aria-label="Rated 4.00 out of 5">
                                    <span style="width:75%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                </div>
                                (4.00)
                            </div>
                            <h3 class="product-title"><a href="shop-details.html">Sicilian Pizza</a></h3>
                            <span class="price">$60.85</span>
                            <div class="actions">
                                <a href="#QuickView" class="icon-btn popup-content"><i class="fal fa-eye"></i></a>
                                <a href="cart.html" class="icon-btn"><i class="fal fa-cart-plus"></i></a>
                                <a href="wishlist.html" class="icon-btn"><i class="fal fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="th-product">
                        <div class="product-img">
                            <img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/menu_1_4.png" alt="Product Image">
                        </div>
                        <div class="product-content">
                            <a href="shop.html" class="category">Mutton</a>
                            <div class="product-rating">
                                <div class="star-rating" role="img" aria-label="Rated 4.00 out of 5">
                                    <span style="width:75%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                </div>
                                (4.00)
                            </div>
                            <h3 class="product-title"><a href="shop-details.html">Beef Masala</a></h3>
                            <span class="price">$70.85</span>
                            <div class="actions">
                                <a href="#QuickView" class="icon-btn popup-content"><i class="fal fa-eye"></i></a>
                                <a href="cart.html" class="icon-btn"><i class="fal fa-cart-plus"></i></a>
                                <a href="wishlist.html" class="icon-btn"><i class="fal fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="th-product">
                        <div class="product-img">
                            <img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/menu_1_5.png" alt="Product Image">
                        </div>
                        <div class="product-content">
                            <a href="shop.html" class="category">Breakfast</a>
                            <div class="product-rating">
                                <div class="star-rating" role="img" aria-label="Rated 4.00 out of 5">
                                    <span style="width:75%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                </div>
                                (4.00)
                            </div>
                            <h3 class="product-title"><a href="shop-details.html">Martin Widenka</a></h3>
                            <span class="price">$20.85</span>
                            <div class="actions">
                                <a href="#QuickView" class="icon-btn popup-content"><i class="fal fa-eye"></i></a>
                                <a href="cart.html" class="icon-btn"><i class="fal fa-cart-plus"></i></a>
                                <a href="wishlist.html" class="icon-btn"><i class="fal fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="th-product">
                        <div class="product-img">
                            <img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/menu_1_6.png" alt="Product Image">
                        </div>
                        <div class="product-content">
                            <a href="shop.html" class="category">Nodles</a>
                            <div class="product-rating">
                                <div class="star-rating" role="img" aria-label="Rated 4.00 out of 5">
                                    <span style="width:75%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                </div>
                                (4.00)
                            </div>
                            <h3 class="product-title"><a href="shop-details.html">Wendy Chicken</a></h3>
                            <span class="price">$10.85</span>
                            <div class="actions">
                                <a href="#QuickView" class="icon-btn popup-content"><i class="fal fa-eye"></i></a>
                                <a href="cart.html" class="icon-btn"><i class="fal fa-cart-plus"></i></a>
                                <a href="wishlist.html" class="icon-btn"><i class="fal fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="th-product">
                        <div class="product-img">
                            <img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/menu_1_7.png" alt="Product Image">
                        </div>
                        <div class="product-content">
                            <a href="shop.html" class="category">Kabab</a>
                            <div class="product-rating">
                                <div class="star-rating" role="img" aria-label="Rated 4.00 out of 5">
                                    <span style="width:75%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                </div>
                                (4.00)
                            </div>
                            <h3 class="product-title"><a href="shop-details.html">BBQ Chicken</a></h3>
                            <span class="price">$20.85</span>
                            <div class="actions">
                                <a href="#QuickView" class="icon-btn popup-content"><i class="fal fa-eye"></i></a>
                                <a href="cart.html" class="icon-btn"><i class="fal fa-cart-plus"></i></a>
                                <a href="wishlist.html" class="icon-btn"><i class="fal fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="th-product">
                        <div class="product-img">
                            <img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/menu_1_8.png" alt="Product Image">
                        </div>
                        <div class="product-content">
                            <a href="shop.html" class="category">Ice Cream</a>
                            <div class="product-rating">
                                <div class="star-rating" role="img" aria-label="Rated 4.00 out of 5">
                                    <span style="width:75%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                </div>
                                (4.00)
                            </div>
                            <h3 class="product-title"><a href="shop-details.html">Cheese Butter</a></h3>
                            <span class="price">$12.85</span>
                            <div class="actions">
                                <a href="#QuickView" class="icon-btn popup-content"><i class="fal fa-eye"></i></a>
                                <a href="cart.html" class="icon-btn"><i class="fal fa-cart-plus"></i></a>
                                <a href="wishlist.html" class="icon-btn"><i class="fal fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="th-product">
                        <div class="product-img">
                            <img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/menu_1_9.png" alt="Product Image">
                        </div>
                        <div class="product-content">
                            <a href="shop.html" class="category">Biriyani</a>
                            <div class="product-rating">
                                <div class="star-rating" role="img" aria-label="Rated 4.00 out of 5">
                                    <span style="width:75%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                </div>
                                (4.00)
                            </div>
                            <h3 class="product-title"><a href="shop-details.html">Hydrabadi Biriany</a></h3>
                            <span class="price">$20.85</span>
                            <div class="actions">
                                <a href="#QuickView" class="icon-btn popup-content"><i class="fal fa-eye"></i></a>
                                <a href="cart.html" class="icon-btn"><i class="fal fa-cart-plus"></i></a>
                                <a href="wishlist.html" class="icon-btn"><i class="fal fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="th-product">
                        <div class="product-img">
                            <img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/menu_1_10.png" alt="Product Image">
                        </div>
                        <div class="product-content">
                            <a href="shop.html" class="category">Vagetable</a>
                            <div class="product-rating">
                                <div class="star-rating" role="img" aria-label="Rated 4.00 out of 5">
                                    <span style="width:75%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                </div>
                                (4.00)
                            </div>
                            <h3 class="product-title"><a href="shop-details.html">Chicken Pokora</a></h3>
                            <span class="price">$12.85</span>
                            <div class="actions">
                                <a href="#QuickView" class="icon-btn popup-content"><i class="fal fa-eye"></i></a>
                                <a href="cart.html" class="icon-btn"><i class="fal fa-cart-plus"></i></a>
                                <a href="wishlist.html" class="icon-btn"><i class="fal fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="th-product">
                        <div class="product-img">
                            <img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/menu_1_11.png" alt="Product Image">
                        </div>
                        <div class="product-content">
                            <a href="shop.html" class="category">Fried Rice</a>
                            <div class="product-rating">
                                <div class="star-rating" role="img" aria-label="Rated 4.00 out of 5">
                                    <span style="width:75%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                </div>
                                (4.00)
                            </div>
                            <h3 class="product-title"><a href="shop-details.html">Mutton Fried Rice</a></h3>
                            <span class="price">$12.85</span>
                            <div class="actions">
                                <a href="#QuickView" class="icon-btn popup-content"><i class="fal fa-eye"></i></a>
                                <a href="cart.html" class="icon-btn"><i class="fal fa-cart-plus"></i></a>
                                <a href="wishlist.html" class="icon-btn"><i class="fal fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="th-product">
                        <div class="product-img">
                            <img src="https://themeholy.com/html/pizzan/demo/assets/img/menu/menu_1_12.png" alt="Product Image">
                        </div>
                        <div class="product-content">
                            <a href="shop.html" class="category">Vagetable</a>
                            <div class="product-rating">
                                <div class="star-rating" role="img" aria-label="Rated 4.00 out of 5">
                                    <span style="width:75%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                </div>
                                (4.00)
                            </div>
                            <h3 class="product-title"><a href="shop-details.html">Vegetable Salad</a></h3>
                            <span class="price">$10.85</span>
                            <div class="actions">
                                <a href="#QuickView" class="icon-btn popup-content"><i class="fal fa-eye"></i></a>
                                <a href="cart.html" class="icon-btn"><i class="fal fa-cart-plus"></i></a>
                                <a href="wishlist.html" class="icon-btn"><i class="fal fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
include_once __DIR__ . '/partials/layouts/layout-footer.php';

?>