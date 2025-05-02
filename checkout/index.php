<?php include_once __DIR__ . '/partials/layouts/layout-top.php';

require_once __DIR__ .  '/conf/function.php';

$memberId = $_SESSION['memberId'];

?>

<main class="pattern_2">

	<div class="container margin_60_40">
		<div class="row justify-content-center">
			<div class="col-xl-6 col-lg-8">
				<div class="box_booking_2 style_2">
					<div class="head">
						<div class="title">
							<h3>Personal Details</h3>
						</div>
					</div>
					<!-- /head -->
					<div class="main">
						<div class="form-group">
							<label>First and Last Name</label>
							<input class="form-control" placeholder="First and Last Name">
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Email Address</label>
									<input class="form-control" placeholder="Email Address">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Phone</label>
									<input class="form-control" placeholder="Phone">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Full Address</label>
							<input class="form-control" placeholder="Full Address">
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>City</label>
									<input class="form-control" placeholder="City">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Postal Code</label>
									<input class="form-control" placeholder="0123">
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /box_booking -->
				<div class="box_booking_2 style_2">
					<div class="head">
						<div class="title">
							<h3>Payment Method</h3>
						</div>
					</div>
					<!-- /head -->
					<div class="main">
						<div class="payment_select">
							<label class="container_radio">Credit Card
								<input type="radio" value="" checked name="payment_method">
								<span class="checkmark"></span>
							</label>
							<i class="icon_creditcard"></i>
						</div>
						<div class="form-group">
							<label>Name on card</label>
							<input type="text" class="form-control" id="name_card_order" name="name_card_order" placeholder="First and last name">
						</div>
						<div class="form-group">
							<label>Card number</label>
							<input type="text" id="card_number" name="card_number" class="form-control" placeholder="Card number">
						</div>
						<div class="row">
							<div class="col-md-6">
								<label>Expiration date</label>
								<div class="row">
									<div class="col-md-6 col-6">
										<div class="form-group">
											<input type="text" id="expire_month" name="expire_month" class="form-control" placeholder="mm">
										</div>
									</div>
									<div class="col-md-6 col-6">
										<div class="form-group">
											<input type="text" id="expire_year" name="expire_year" class="form-control" placeholder="yyyy">
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Security code</label>
									<div class="row">
										<div class="col-md-4 col-6">
											<div class="form-group">
												<input type="text" id="ccv" name="ccv" class="form-control" placeholder="CCV">
											</div>
										</div>
										<div class="col-md-8 col-6">
											<img src="img/icon_ccv.gif" width="50" height="29" alt="ccv"><small>Last 3 digits</small>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--End row -->
						<div class="payment_select" id="paypal">
							<label class="container_radio">Pay with Paypal
								<input type="radio" value="" name="payment_method">
								<span class="checkmark"></span>
							</label>
						</div>
						<div class="payment_select">
							<label class="container_radio">Pay with Cash
								<input type="radio" value="" name="payment_method">
								<span class="checkmark"></span>
							</label>
							<i class="icon_wallet"></i>
						</div>
					</div>
				</div>
				<!-- /box_booking -->
			</div>
			<!-- /col -->
			<div class="col-xl-4 col-lg-4" id="sidebar_fixed">
				<div class="box_booking">
					<div class="head">
						<h3>Order Summary</h3>
					</div>
					<!-- /head -->
					<div class="main">
						<ul class="clearfix">

							<?php

							$item = query("SELECT c.*, m.* FROM cart c JOIN menu m ON c.item_id = m.item_id WHERE member_id = $memberId ORDER BY c.added_at DESC");

							foreach ($item as $i) :

								$priceProcess = (isset($i['discount_status']) > 0) ?
									$i['item_price'] - ($i['item_price']  * $i['discount'] / 100)
									:
									$i['item_price'];


								$totalPerItem = $priceProcess * $i['quantity'];

								$quantity = $i['quantity'];
							?>
								<li>
									<a href="#0">
										<?php echo $quantity ?>x <?php echo $i['item_name'] ?>
									</a>
									<span>
										<?php
										$price = number_format($totalPerItem, 0, ',', '.');



										echo "Rp. $price" ?>
									</span>
								</li>
							<?php endforeach; ?>
						</ul>

						<ul class="clearfix">
							<li>Subtotal<span>
									<?php
									$subtotal = 0;
									foreach ($item as $i) :
										$priceProcess = (isset($i['discount_status']) == 0) ?
											$i['item_price'] - ($i['item_price']  * $i['discount'] / 100)
											:
											$i['item_price'];

										$totalPerItem = $priceProcess * $i['quantity'];

										$subtotal += $totalPerItem;
									endforeach;

									$subtotal = number_format($subtotal, 0, ',', '.');



									if ($subtotal > 0) {
										echo "<s>Rp. $subtotal</s>";
									}
									?>
								</span>
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
										<?= $cart['item_name'] ?> (<b><?= $cart['discount'] ?>% off</b>)
										<span>
											<?= 'Rp. ' . number_format($cart['quantity'] * ($cart['item_price'] - $cart['item_price'] * ($cart['discount'] / 100)), 0, ',', '.') ?>
										</span>
									</li>
							<?php
								endif;
							endforeach;
							?>
							<!-- <li>Delivery fee<span>$10</span></li> -->
							<li class="total">Total<span>
									<?php

									$total = array_reduce($item, function ($total, $item) {
										$discountPrice = $item['item_price'] - ($item['item_price'] * $item['discount'] / 100);
										return $total + $item['quantity'] * $discountPrice;
									});


									$total = number_format($total, 0, ',', '.');
									echo "Rp. $total"
									?>
								</span></li>
						</ul>
						<a href="confirm.html" class="btn_1 full-width mb_5">Order Now</a>
						<div class="text-center"><small>Or Call Us at <strong>0432 48432854</strong></small></div>
					</div>
				</div>
				<!-- /box_booking -->
			</div>

		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</main>
<!-- /main -->
<!-- footer -->
<?php include_once __DIR__ . '/partials/layouts/layout-bottom.php' ?>