
				<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
					<div class="navbar-collapse">
						<a href="index.php" class="navbar-brand mb-0">TBATMPC - Admin</a>
						<ul class="nav navbar-nav mr-auto">
							<li class="nav-item"><a class="nav-link" href="index.php">My Dashboard</a></li>
							<li class="nav-item"><a class="nav-link" href="brands.php">Brands</a></li>
							<li class="nav-item"><a class="nav-link" href="categories.php">Categories</a></li>
							<li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
							<li class="nav-item"><a class="nav-link" href="archived.php">Archived</a></li>
							<li class="nav-item dropdown"><a href="" class="nav-link dropdown-toggle" data-toggle="dropdown">Rentals</a>
								<ul class="dropdown-menu" role="meun">
									<li><a class="dropdown-item" href="requesttable.php">Rental Requests</a></li>
									<li><a class="dropdown-item" href="van.php">Cars</a></li>
									<li><a class="dropdown-item" href="package.php">Packages</a></li>
									<li><a class="dropdown-item" href="fullcalendarshit/index.php">Add Schedule</a></li>
								</ul>
							</li>
							<?php if (has_permission('admin')): ?>
								<li class="nav-item"><a class="nav-link" href="users.php">Users</a></li>
							<?php endif; ?>
							<li class="nav-item dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Hello <?= $user_data['first'].'!'; ?></a>
								<ul class="dropdown-menu" role="meun">
									<li><a class="dropdown-item" href="change_password.php">Change Password</a></li><hr>
									<li><a class="dropdown-item" href="logout.php">Logout</a></li>
								</ul>
							</li>
							<!-- <li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" value=""></a>
								<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
									<li><a href="#" class="dropdown-item" value=""></a></li>
								</ul>
							</li> -->
						</ul>
					</div>
				</nav>
	