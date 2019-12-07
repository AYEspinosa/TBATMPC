<?php
	require_once('../core/init.php');
	if(!is_logged_in()){
		header("Location: login.php");
	}
?>

<?php
	$txnQuery = "SELECT t.id, t.cart_id, t.full_name, t.txn_date, t.grand_amount, c.items, c.paid, c.shipped FROM transactions t
		LEFT JOIN cart c ON t.cart_id = c.id
		WHERE c.paid = 1 AND c.shipped = 0
		ORDER BY t.txn_date";
	$txnResults = $db->query($txnQuery);

	include('includes/head_gen.php');
	include('includes/navigation.php');
?>
<div class="container-fluid colulu" align="left">
	<div class="col-md-12">
		<h3 class="text-center">Orders To Ship/Pick Up</h3>
		<table class="table table-bordered table-condensed table-striped">
			<thead>
				<th></th>
				<th>Name</th>
				<th>Total</th>
				<th>Date</th>
			</thead>
			<tbody>
				<?php while($order = mysqli_fetch_assoc($txnResults)): ?>
					<tr>
						<td><a href="orders.php?txn_id=<?= $order['id']; ?>" class="btn btn-sm btn-info">Details</a></td>
						<td><?= $order['full_name']; ?></td>
						<td><?= money($order['grand_amount']); ?></td>
						<td><?= pretty_date($order['txn_date']); ?></td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
	<div class="row">
		<?php
			$thisYr = date("Y");
			$lastYr = $thisYr - 1;
			$thisYrQ = $db->query("SELECT grand_amount, txn_date FROM transactions WHERE YEAR(txn_date) = '{$thisYr}'");
			$lastYrQ = $db->query("SELECT grand_amount, txn_date FROM transactions WHERE YEAR(txn_date) = '{$lastYr}'");
			$current = array();
			$last = array();
			$current_total = 0;
			$last_total = 0;
			while($x = mysqli_fetch_assoc($thisYrQ)){
				$month = date("m", strtotime($x['txn_date']));
				if (!array_key_exists($month,$current)) {
					$current[(int)$month] = $x['grand_amount'];
				}else{
					$current[(int)$month] += $x['grand_amount'];
				}
				$current_total += $x['grand_amount'];
			}

			while($y = mysqli_fetch_assoc($lastYrQ)){
				$month = date("m", strtotime($y['txn_date']));
				if (!array_key_exists($month,$last)) {
					$last[(int)$month] = $y['grand_amount'];
				}else{
					$last[(int)$month] += $y['grand_amount'];
				}
				$last_total += $y['grand_amount'];
			}
		?>
		<div class="col-md-4">
			<h3 class="text-center">Sales by Month</h3>
			<table class="table table-condensed table-striped table-bordered">
				<thead>
					<th></th>
					<th><?= $lastYr; ?></th>
					<th><?= $thisYr; ?></th>
				</thead>
				<tbody>
					<?php 
					for($i = 1; $i <= 12; $i++):
						$dt = DateTime::createFromFormat('!m',$i);
					?>
						<tr<?= ((date("m") == $i)?' class="bg-primary"':""); ?>>
							<td><?= $dt->format("F"); ?></td>
							<td><?= ((array_key_exists($i, $last))?money($last[$i]):money(0)); ?></td>
							<td><?= ((array_key_exists($i, $current))?money($current[$i]):money(0)); ?></td>
						</tr>
					<?php endfor; ?>
					<tr>
						<td>Total</td>
						<td><?= money($last_total); ?></td>
						<td><?= money($current_total); ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php 
			$iQuery = $db->query("SELECT * FROM products WHERE deleted = 0");
			$lowItems = array();
			while($product = mysqli_fetch_assoc($iQuery)){
				$item = array();
				$sizes = sizesToArray($product['sizes']);
				foreach ($sizes as $size) {
					if($size['quantity'] <= $size['threshold']){
						$cat = get_category($product['categories']);
						$item = array(
							'title' 	=> $product['title'],
							'size'		=> $size['size'],
							'quantity'	=> $size['quantity'],
							'threshold'	=> $size['threshold'],
							'category'	=> $cat['parent']."~".$cat['child'],
						);
						$lowItems[] = $item;
					}
				}
			}
		?>
		<div class="col-md-8">
			<h3 class="text-center">Low Inventory</h3>
			<table class="table table-condensed table-striped table-bordered">
				<thead>
					<th>Product</th>
					<th>Category</th>
					<th>Size</th>
					<th>Quantity</th>
					<th>Threshold</th>
				</thead>
				<tbody>
					<?php foreach ($lowItems as $item): ?>
						<tr<?= (($item['quantity'] == 0)?' class="bg-danger"':''); ?>>
							<td><?= $item['title']; ?></td>
							<td><?= $item['category']; ?></td>
							<td><?= $item['size']; ?></td>
							<td><?= $item['quantity']; ?></td>
							<td><?= $item['threshold']; ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="rounded border border-secondary col-md-12">
		<div id="chartdiv">
				
		</div>
	</div>
	<!-- <div class="container-fluid colulu">
		<h2 class="text-center">Dashboard</h2>
		<hr>
	</div> -->
</div>
		
<?php
	include ('includes/footer.php');
?>