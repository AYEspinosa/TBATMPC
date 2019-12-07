<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/TBATMPC/core/init.php';
if(!is_logged_in()){
		login_error_redirect();
}

if(isset($_GET['delete'])){
	$delete_id = sanitize($_GET['delete']);
	$db->query("UPDATE products SET deleted = 1, featured = 0 WHERE id = '$delete_id'");
	header("Location: products.php");
}

$dbpath = '';
if (isset($_GET['add']) || isset($_GET['edit'])) {
$brandQuery = $db->query("SELECT * FROM brand ORDER BY brand");
$parentQuery = $db->query("SELECT * FROM categories WHERE parent = 0 ORDER BY category");
$title = ((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']):'');
$brand = ((isset($_POST['brand']) && !empty($_POST['brand']))?sanitize($_POST['brand']):'');
$parent = ((isset($_POST['parent']) && !empty($_POST['parent']))?sanitize($_POST['parent']):'');
$category = ((isset($_POST['child']) && !empty($_POST['child']))?sanitize($_POST['child']):'');
$price = ((isset($_POST['price']) && $_POST['price'] != '')?sanitize($_POST['price']):'');
$list_price = ((isset($_POST['list_price']) && $_POST['list_price'] != '')?sanitize($_POST['list_price']):'');
$description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):'');
$sizes = ((isset($_POST['sizes']) && $_POST['sizes'] != '')?sanitize($_POST['sizes']):'');
$sizes = rtrim($sizes, ",");
$saved_image = '';

	if (isset($_GET['edit'])){
		$edit_id = (int)$_GET['edit'];
		$productResults = $db->query("SELECT * FROM products WHERE id = '$edit_id'");
		$product = mysqli_fetch_assoc($productResults);
		if(isset($_GET['delete_image'])){
			$imgi = (int)$_GET['imgi'] - 1;
			$images = explode(",", $product['image']);
			$image_url = $_SERVER['DOCUMENT_ROOT'].$images[$imgi];
			unlink($image_url);
			unset($images[$imgi]);
			$imageString = implode(",", $images);
			$db->query("UPDATE products SET image = '{$imageString}' WHERE id = '$edit_id'");
			header('Location: products.php?edit='.$edit_id);
		}
		$category = ((isset($_POST['child']) && $_POST['child'] != '')?sanitize($_POST['child']):$product['categories']);
		$title = ((isset($_POST['title']) && !empty($_POST['title']))?sanitize($_POST['title']):$product['title']);
		$brand = ((isset($_POST['brand']) && !empty($_POST['brand']))?sanitize($_POST['brand']):$product['brand']);
		$parentQ = $db->query("SELECT * FROM categories WHERE id = '$category'");
		$parentResult = mysqli_fetch_assoc($parentQ);
		$parent = ((isset($_POST['parent']) && !empty($_POST['parent']))?sanitize($_POST['parent']):$parentResult['parent']);
		$price = ((isset($_POST['price']) && !empty($_POST['price']))?sanitize($_POST['price']):$product['price']);
		$list_price = ((isset($_POST['list_price']))?sanitize($_POST['list_price']):$product['list_price']);
		$description = ((isset($_POST['description']))?sanitize($_POST['description']):$product['description']);
		$sizes = ((isset($_POST['sizes']) && !empty($_POST['sizes']))?sanitize($_POST['sizes']):$product['sizes']);
		$sizes = rtrim($sizes, ",");
		$saved_image = (($product['image'] != '')?$product['image']:'');
		$dbpath = $saved_image;
	}
	if (!empty($sizes)) {
		$sizeString = sanitize($sizes);
		$sizeString = rtrim($sizeString, ',');
		$sizesArray = explode(',', $sizeString);
		$sArray = array();
		$qArray = array();
		$tArray = array();
		foreach ($sizesArray as $ss) {
			$s = explode(':', $ss);
			$sArray[] = $s[0];
			$qArray[] = $s[1];
			$tArray[] = $s[2];
		}
	}else{
		$sizesArray = array();
	}
if($_POST){
	$errors = array();
	$required = array('title', 'brand', 'price', 'parent', 'child', 'sizes');
	$allowed = array('png', 'jpg', 'jpeg', 'gif', 'JPG', 'PNG', 'JPEG', 'GIF');
	$tmpLoc = array();
	$uploadPath = array();
	foreach ($required as $field) {
		if ($_POST[$field] == '') {
			$errors[] = 'All fields With an Asterisk are required';
			break;
		}
	}
	$photoCount = count($_FILES['photo']['name']);
	if ($photoCount > 0) 
	{
		for($i = 0; $i < $photoCount; $i++){
			$name = $_FILES['photo']['name'][$i];
			$nameArray = explode('.', $name);
			$fileName = $nameArray[0];
			$fileExt = $nameArray[1];
			$mime = explode('/', $_FILES['photo']['type'][$i]);
			$mimeType = $mime[0];
			$mimeExt = $mime[1];
			$tmpLoc[] = $_FILES['photo']['tmp_name'][$i];
			$fileSize = $_FILES['photo']['size'][$i];
			$uploadName = md5(microtime().$i).'.'.$fileExt;
			$uploadPath[] = BASEURL.'imgs/Prods/'.$uploadName;
			if ($i != 0){
				$dbpath .= ',';
			}
			$dbpath .= '/TBATMPC/imgs/Prods/'.$uploadName;

			if ($mimeType != 'image') 
			{
				$errors[] = 'The file must be an Image';
			}
			if (!in_array($fileExt, $allowed)) 
			{
				$errors[] = 'The photo extension must be a png, jpg, jpeg or gif.';
			}
			if ($fileSize > 15000000) 
			{
				$errors[] = 'The file size must be under 15MB';
			}
			if($fileExt != $mimeExt && ($mimeType == 'jpeg' && $fileExt != 'jpg'))
	        {
	            $errors[] = 'File extension does not match the file.';
	        }
		}
	}
	if (!empty($errors)) {
		echo display_errors($errors);
	}else{
		# update database
		if($photoCount > 0){
			for($i = 0; $i < $photoCount; $i++){
				move_uploaded_file($tmpLoc[$i], $uploadPath[$i]);
			}
		}
		$sizes = rtrim($sizes, ',');
		$insertSql = "INSERT INTO products (`title`, `price`, `list_price`, `brand`, `categories`, `sizes`, `image`, `description`)
		 VALUES ('$title', '$price', '$list_price', '$brand', '$category', '$sizes', '$dbpath', '$description')";
		
		if (isset($_GET['edit'])) {
		 	$insertSql = "UPDATE products SET title = '$title', price = '$price', list_price = '$list_price', brand = '$brand', categories = '$category', sizes = '$sizes', image = '$dbpath', description = '$description' WHERE id = '$edit_id'";
		 } 

		$db->query($insertSql);
		header('Location: products.php');
	}
}
	include('includes/head_gen.php');
	include ('includes/navigation.php');
?>
	<div class="container-fluid colulu" align="left">
		<h2 class="text-center"><?= ((isset($_GET['edit']))?'Edit ':'Add A New '); ?>Product</h2><hr>
		<form action="products.php?<?= ((isset($_GET['edit']))?'edit='.$edit_id:'add=1'); ?>" method="POST" enctype="multipart/form-data" class="container-fluid">
			<div class="form-group col-md-6 text-left" style="display: inline-block; margin-left: -4px;">
				<label for="title"><b>Title*:</b></label>
				<input class="form-control" type="text" name="title" id="title" value="<?= $title; ?>">
			</div>
			<div class="form-group col-md-6 text-left" style="display: inline-block; margin-left: -4px;">
				<label for="brand"><b>Brand*:</b></label>
				<select class="form-control" id="brand" name="brand">
					<option value=""<?= (($brand == '')?' selected':'') ;?>></option>
					<?php while($b = mysqli_fetch_assoc($brandQuery)): ?>
						<option value="<?= $b['id'] ;?>"<?= (($brand == $b['id'])?' selected':'') ;?>><?= $b['brand'] ;?></option>
					<?php endwhile; ?>
				</select>
			</div>
			<div class="form-group col-md-6 text-left" style="display: inline-block; margin-left: -4px;">
				<label for="parent"><b>Parent Category*:</b></label>
				<select class="form-control" id="parent" name="parent">
					<option value=""<?= (($parent == '')?' selected':''); ?>></option>
					<?php while($p = mysqli_fetch_assoc($parentQuery)): ?>
						<option value="<?= $p['id']; ?>"<?= (($parent == $p['id'])?' selected':''); ?>><?= $p['category']; ?></option>
					<?php endwhile; ?>
				</select>
			</div>
			<div class="form-group col-md-6 text-left" style="display: inline-block; margin-left: -4px;">
				<label for="child"><b>Child Category*:</b></label>
				<select id="child" name="child" class="form-control"></select>
			</div>
			<div class="form-group col-md-6 text-left" style="display: inline-block; margin-left: -4px;">
				<label for="price"><b>Price*:</b></label>
				<input type="text" name="price" id="price" class="form-control" value="<?= $price; ?>">
			</div>
			<div class="form-group col-md-6 text-left" style="display: inline-block; margin-left: -4px;">
				<label for="list_price"><b>List Price:</b></label>
				<input type="text" name="list_price" id="list_price" class="form-control" value="<?= $list_price; ?>">
			</div>
			<div class="form-group col-md-3 pull-left" style="display: inline-block; margin-left: -4px; padding-top: 0%;">
				<label><b>Quantity and Sizes*:</b></label>
				<button class="btn btn-default form-control border" onclick="jQuery('#sizesModal').modal('toggle');return false;">Quantity & Sizes</button>
			</div>
			<div class="form-group col-md-3 pull-left" style="display: inline-block; margin-left: -4px;">
				<label for="sizes"><b>Sizes & Qty Preview:</b></label>
				<input class="form-control" type="text" name="sizes" id="sizes" value="<?= $sizes; ?>" readonly>
			</div>
			<div class="form-group col-md-6 pull-right" style="display: inline-block; margin-left: -4px; margin-right: -4px;">
				<?php if($saved_image ==''):?>
					<label for="photo"><b>Product Photo:</b></label>
					<input type="file" name="photo[]" id="photo" class="form-control" multiple>
				<?php else: ?>
					<?php 
					$imgi = 1;
					$images = explode(",", $saved_image);
				?>
				<?php foreach ($images as $image): ?>
					<div class="saved-image col-sm-4" style="display: inline-block; margin: -3px 0px -3px -18px;">
						<img src="<?= $image; ?>" alt="saved_image"><br>
						<a href="products.php?delete_image=1&edit=<?= $edit_id; ?>&imgi=<?= $imgi; ?>" class="text-danger">Delete Image</a>
					</div>
				<?php $imgi++;
				endforeach; ?>
				<?php endif; ?>
			</div>
			<div class="form-group col-md-6 pull-left" style="display: inline-block; margin-left: -4px;">
				<label for="description"><b>Description:</b></label>
				<textarea class="form-control" id="description" name="description" rows="6"><?= $description; ?></textarea>
			</div>
			<div class="form-group col-md-2 form-group">
				<input type="submit" value="<?= ((isset($_GET['edit']))?'Edit ':'Add '); ?>Product" class="btn btn-success" style="padding: 5px 5px 5px 5px;">
				<a href="products.php" class="btn btn-warning" style="padding: 5px 5px 5px 5px;">Cancel</a>
			</div>
			<div class="clearfix"></div>
		</form>
				<!-- Modal -->
		<div class="modal fade" id="sizesModal" tabindex="-1" role="dialog" aria-labelledby="sizesModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="sizesModalLabel">Sizes & Quantity</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body text-center container-fluid">
		      	<div class="container-fluid" style="padding-right: 0px; padding-left: 0px; display: inline-block;">
		        <?php for($i=1; $i<=12;$i++): ?>
		        	<div class="col-md-2 text-left" style="display: inline-block; margin-right: -10px;">
		        		<label for="size<?=$i;?>">Size:</label>
		        		<input type="text" name="size<?=$i;?>" id="size<?=$i;?>" value="<?= ((!empty($sArray[$i-1]))?$sArray[$i-1]:''); ?>" class="form-control">
		        	</div>
		        	<div class="col-md-2 text-left" style="display: inline-block; margin-right: -10px;">
		        		<label for="qty<?=$i;?>">Quantity:</label>
		        		<input type="number" name="qty<?=$i;?>" id="qty<?=$i;?>" value="<?= ((!empty($qArray[$i-1]))?$qArray[$i-1]:''); ?>" min="0" class="form-control">
		        	</div>
		        	<div class="col-md-2 text-left" style="display: inline-block; margin-right: -10px;">
		        		<label for="threshold<?=$i;?>">Threshold:</label>
		        		<input type="number" name="threshold<?=$i;?>" id="threshold<?=$i;?>" value="<?= ((!empty($tArray[$i-1]))?$tArray[$i-1]:''); ?>" min="0" class="form-control">
		        	</div>
		        <?php endfor; ?>
		        </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" onclick="updateSizes();jQuery('#sizesModal').modal('toggle'); return false;">Save changes</button>
		      </div>
		    </div>
		  </div>
		</div>

	</div>
<?php
}else{

$sql = "SELECT * FROM products WHERE deleted = 0";
$presults = $db->query($sql);
if (isset($_GET['featured'])){
	$id = (int)$_GET['id'];
	$featured = (int)$_GET['featured'];
	$featuredsql = "UPDATE products SET featured = '$featured' WHERE id = '$id'";
	$db->query($featuredsql);
	header('Location: products.php');
}
	include('includes/head_gen.php');
	include ('includes/navigation.php');
?>
<div class="container-fluid colulu">
	<h2 class="text-center">Products</h2>
	<a href="products.php?add=1" class="btn btn-success pull-right" id="add-product-btn">Add Product</a><div class="clearfix"></div>
	<hr>
	<table class="table table-bordered table-condensed table-striped text-left">
		<thead>
			<th></th><th>Product</th><th>Price</th><th>Category</th><th>Featured</th><th>Sold</th>
		</thead>
		<tbody>
			<?php while ($product = mysqli_fetch_assoc($presults)): 
				$childID = $product['categories'];
				$catSql = "SELECT * FROM categories WHERE id = '$childID'";
				$result = $db->query($catSql);
				$child = mysqli_fetch_assoc($result);
				$parentID = $child['parent'];
				$parSql = "SELECT * FROM categories WHERE id = '$parentID'";
				$pres = $db->query($parSql);
				$parent = mysqli_fetch_assoc($pres);
				$category = $parent['category'].' - '.$child['category'];
			?>
				<tr>
					<td width="8%" align="center">
						<a href="products.php?edit=<?= $product['id'];?>" class="btn btn-sm btn-dark"><i class="fas fa-pencil-alt"></i></a>
						<a href="products.php?delete=<?= $product['id'];?>" class="btn btn-sm btn-dark"><i class="fas fa-times-circle"></i></a>
					</td>
					<td> <?=$product['title'];?> </td>
					<td> <?=money($product['price']);?></td>
					<td> <?= $category; ?></td>
					<td width="15%"> <a href="products.php?featured=<?= (($product['featured'] == 0)?'1':'0'); ?>&id=<?=$product['id'];?>" class="btn btn-sm btn-dark"><i class="fas fa-<?= (($product['featured'] == 1)?'minus':'plus') ;?>"></i></a> &nbsp <?=(($product['featured'] == 1)?'Featured Product':'');?> </td>
					<td>0</td>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</div>

<?php
}
include ('includes/footer.php');
?>
<script type="text/javascript">
	jQuery('document').ready(function(){
		get_child_options('<?= $category; ?>');
	});
</script>