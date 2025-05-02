<?php include_once __DIR__ . '/partials/layouts/layout-top.php';

require_once __DIR__ .  '/conf/connection.php';
?>

<?php
$heading = '
  <!-- SPECIFIC CSS -->
      <link href="/assets/css/shop.css" rel="stylesheet">';

echo $heading;
?>

<main>
	<div class="hero_single inner_pages background-image" data-background="url(https://images.pexels.com/photos/994605/pexels-photo-994605.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1)">
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

	<div class="filters_full clearfix">
		<div class="container">
			<div class="count_results">Showing 1–6 Of 12 Results</div>
			<div class="sort_select">
				<select name="sort" id="sort">
					<option value="popularity" selected="selected">Sort by Popularity</option>
					<option value="rating">Sort by Average rating</option>
					<option value="date">Sort by newness</option>
					<option value="price">Sort by Price: low to high</option>
					<option value="price-desc">Sort by Price: high to low</option>
				</select>
			</div>
			<a href="#collapseFilters" data-bs-toggle="collapse" class="btn_filters"><i class="icon_adjust-vert"></i><span>Filters</span></a>
		</div>
	</div>
	<!-- /filters_full -->

	<div class="collapse filters_2" id="collapseFilters">
		<div class="container margin_detail">
			<div class="row">
				<div class="col-md-4">
					<div class="filter_type">
						<h6>Categories</h6>
						<ul>
							<li>
								<label class="container_check">Pizza - Italian <small>12</small>
									<input type="checkbox">
									<span class="checkmark"></span>
								</label>
							</li>
							<li>
								<label class="container_check">Japanese - Sushi <small>24</small>
									<input type="checkbox">
									<span class="checkmark"></span>
								</label>
							</li>
							<li>
								<label class="container_check">Burghers <small>23</small>
									<input type="checkbox">
									<span class="checkmark"></span>
								</label>
							</li>
							<li>
								<label class="container_check">Vegetarian <small>11</small>
									<input type="checkbox">
									<span class="checkmark"></span>
								</label>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-4">
					<div class="filter_type">
						<h6>Rating</h6>
						<ul>
							<li>
								<label class="container_check">Superb 9+ <small>06</small>
									<input type="checkbox">
									<span class="checkmark"></span>
								</label>
							</li>
							<li>
								<label class="container_check">Very Good 8+ <small>12</small>
									<input type="checkbox">
									<span class="checkmark"></span>
								</label>
							</li>
							<li>
								<label class="container_check">Good 7+ <small>17</small>
									<input type="checkbox">
									<span class="checkmark"></span>
								</label>
							</li>
							<li>
								<label class="container_check">Pleasant 6+ <small>43</small>
									<input type="checkbox">
									<span class="checkmark"></span>
								</label>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-4">
					<div class="filter_type">
						<h6>Price</h6>
						<ul>
							<li>
								<label class="container_check">$0 — $50<small>11</small>
									<input type="checkbox">
									<span class="checkmark"></span>
								</label>
							</li>
							<li>
								<label class="container_check">$50 — $100<small>08</small>
									<input type="checkbox">
									<span class="checkmark"></span>
								</label>
							</li>
							<li>
								<label class="container_check">$100 — $150<small>05</small>
									<input type="checkbox">
									<span class="checkmark"></span>
								</label>
							</li>
							<li>
								<label class="container_check">$150 — $200<small>18</small>
									<input type="checkbox">
									<span class="checkmark"></span>
								</label>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- /row -->
		</div>
	</div>
	<!-- /filters -->

	<div class="container margin_60_40">

		<div class="row small-gutters">

			<?php

			if (isset($_GET['page']) == true) {
				$page = $_GET['page'];
			} else {
				$page = 1;
			}

			$limit = 8;
			$offset = ($page - 1) * $limit;


			$menus = query("SELECT * FROM menu LIMIT $limit OFFSET $offset");

			foreach ($menus as $menu) :
			?>

				<div class="col-6 col-md-4 col-xl-3" data-cue="slideInUp">
					<div class="grid_item">
						<figure>

							<?php

							// format price, ex = 10000 -> 10.000
							$price = number_format($menu['item_price'], 0, ',', '.');
							$discountPercent = round($menu['discount']);

							$discountPrice = $menu['item_price'] - ($menu['item_price'] * ($menu['discount'] / 100));
							$discountPriceFormatted = number_format($discountPrice, 0, ',', '.');


							?>
							<?= $menu['discount_status'] == true ? "<span class='ribbon off'>$discountPercent%</span>" : "" ?>

							<a href="shop-single.php?id=<?= $menu['item_id'] ?>">
								<style>
									.img-shop {
										width: 250px;
										height: 250px;
										object-fit: cover;
										object-position: center
									}

									@media screen and (max-width: 800px) {
										.img-shop {
											width: 165px;
											height: 165px;
										}
									}
								</style>
								<img class="img-fluid img-shop lazy" src="/assets/img/menu_items/menu_items_placeholder.png" data-src="/admin/images/<?= $menu['item_image']; ?>" alt="">
								<div class="add_cart"><span class="btn_1">Add to cart</span></div>
							</a>
						</figure>
						<div class="rating"><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i></div>
						<a href="shop-single.html">
							<h3><?= $menu['item_name'] ?></h3>
						</a>
						<div class="price_box">
							<!-- new price -->
							<?=
							$menu['discount_status'] ? "<span class='new_price'>Rp.  $discountPriceFormatted </span>" : "<span class='new_price'>Rp.  $price </span>";
							?>



							<!-- old price -->
							<?php
							if ($menu['discount_status'] == true) {
							?>
								<span class="old_price">Rp. <?= $price ?></span>
							<?php
							}
							?>
						</div>
					</div>
					<!-- /grid_item -->
				</div>

			<?php endforeach; ?>
			<!-- /col -->
		</div>
		<!-- /row -->



		<?php

		$total_item = count(query("SELECT * FROM menu"));
		$pagination = ceil($total_item / 8);

		if (isset($_GET['page']) == true) {
			$page = $_GET['page'];
		} else {
			$page = 1;
		}

		$prev = $page - 1;
		$next = $page + 1;
		?>

		<div class="pagination_fg add_bottom_15" data-cue="slideInUp">
			<?php if ($page > 1) { ?>
				<a href="?page=<?= $prev ?>">&laquo;</a>
			<?php } ?>

			<?php for ($i = 1; $i <= $pagination; $i++) : ?>
				<a href="?page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
			<?php endfor; ?>

			<?php if ($page < $pagination) { ?>
				<a href="?page=<?= $next ?>">&raquo;</a>
			<?php } ?>
		</div>

	</div>
	<!-- /container -->

</main>
<!-- /main -->
<?php include_once __DIR__ . '/partials/layouts/layout-bottom.php'; ?>