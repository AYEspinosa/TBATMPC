<?php
	require_once('core/init.php');
	include('includes/head.php');
	include('includes/navigation.php');
	include('includes/headerpartial.php');
	include('includes/leftbar.php');

	if(isset($_GET['cat'])){
		$cat_id = sanitize($_GET['cat']);
	}else{
		$cat_id = '';
	}

	$featured = $db->query("SELECT * FROM products WHERE categories = '$cat_id' AND deleted != 1");
	$category = get_category($cat_id);
?>
			<!-- main content -->
			<div class="col-md-8">
				<h3 class="text-center"><?= $category['parent'].' - '.$category['child'] ?></h3>
					<div class="row text-center">
						<?php while($product = mysqli_fetch_assoc($featured)): ?>
							<div class="col-md-3">
								<h5 class="text-center"> <?= $product['title']; ?> </h5>
								<?php $photos = explode(",", $product['image']); ?>
								<img src="<?= $photos[0]; ?>" alt="<?= $product['title']; ?>" class="img"/>
								<p class="list-price text-danger">List Price: <s>₱<?= $product['list_price']; ?></s> </p>
								<p class="price">Our Price: ₱<?= $product['price']; ?></p>
								<button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?= $product['id']; ?>)">Details</button>
							</div>
						<?php endwhile; ?>
					</div>
			</div>

<?php
	include('includes/rightbar.php');
	include('includes/footer.php');
?>
		