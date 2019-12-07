<?php
	$parent_query = $db->query("SELECT * FROM categories WHERE parent = 0");
?>

		<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
			<div class="navbar-collapse">
				<a href="index.php" class="navbar-brand mb-0">TBATMPC - Mang Boni Total Care Care</a>
				<ul class="nav navbar-nav mr-auto">
					<?php while($parent_category = mysqli_fetch_assoc($parent_query)): 
						$parent_id = $parent_category['id'];
						$child_query = $db->query("SELECT * FROM categories WHERE parent = '$parent_id'");
					?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" value="<?= $parent_id; ?>"> <?= $parent_category['category'];?> </a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<?php while($child_category = mysqli_fetch_assoc($child_query)): ?>
							<li><a href="category.php?cat=<?= $child_category['id']; ?>" class="dropdown-item" value="<?= $child_category['id']; ?>"> <?= $child_category['category']; ?> </a></li>
						<?php endwhile; ?>
						</ul>
					</li>
				<?php endwhile; ?>
					<li class="nav-item"><a href="cart.php" class="nav-link"><i class="fas fa-shopping-cart"></i> My Cart</a></li>
				</ul>
			</div>
		</nav>
