<?php
require_once('../private/initialize.php');
$ip_add = getenv("REMOTE_ADDR");
include "db.php";


if(isset($_POST["category"])){
	$category_query = "SELECT * FROM categories";
	$run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
	echo "

			<a href='#'><h1>Categories</h1></a>
	";
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$cid = $row["cat_id"];
			$cat_name = $row["cat_title"];
			echo "
					<a href='#' class='category' cid='$cid'>$cat_name</a>
			";
		}
		echo "</div>";
	}
}
if(isset($_POST["brand"])){
	$brand_query = "SELECT * FROM brands";
	$run_query = mysqli_query($con,$brand_query);
	echo "

			<a href='#'><h1>Marques</h1></a>
	";
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$bid = $row["brand_id"];
			$brand_name = $row["brand_title"];
			echo "
					<a href='#' class='selectBrand' bid='$bid'>$brand_name</a>
			";
		}
		echo "</div>";
	}
}
if(isset($_POST["page"])){
	$sql = "SELECT * FROM products ";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count/9);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<a href='#' page='$i' id='page'>$i</a>
		";
	}
}
if(isset($_POST["getProduct"])){
	$i=0;
	$limit = 9;
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}
	$product_query = "SELECT * FROM products LIMIT $start,$limit";
	$run_query = mysqli_query($con,$product_query);
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){

			$i++;
			$pro_id    = $row['product_id'];
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_image'];
			echo "
       <form method='post'>
				<div class='card'>
				      <img src='product_images/$pro_image'/>
							<div class='card-header'>
								<h4 class='title'>$pro_title</h4>
								<h4 class='price'>".CURRENCY." $pro_price.00</h4>
								</div>
								<div class='card-body'>

									<button pid='$pro_id' style='float:right;margin-left:3px' id='product' class='btn btn-danger btn-xs'>Panier</button>
									<input type='hidden' name='pid' value='<?=$pro_id?>' >
									<a href='information.php?pid=$pro_id' type='submit' <button type='submit' style='float:right;' id='plus' class='btn btn-danger btn-xs'>Plus</button> </a>
								</div>

							</div>
							</form>

			";


		}
	}
}
if(isset($_POST["get_seleted_Category"]) || isset($_POST["selectBrand"]) || isset($_POST["search"])){
	if(isset($_POST["get_seleted_Category"])){
		$id = $_POST["cat_id"];
		$sql = "SELECT * FROM products WHERE product_cat = '$id'";
	}else if(isset($_POST["selectBrand"])){
		$id = $_POST["brand_id"];
		$sql = "SELECT * FROM products WHERE product_brand = '$id'";
	}else {
		$keyword = $_POST["keyword"];
		$sql = "SELECT * FROM products WHERE product_keywords LIKE '%$keyword%'";
	}

	$run_query = mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($run_query)){
			$pro_id    = $row['product_id'];
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_image'];
			echo "
			<form>
			<div class='card'>
						<img src='product_images/$pro_image'/>
						<div class='card-header'>
							<h4 class='title'>$pro_title</h4>
							<h4 class='price'>".CURRENCY." $pro_price.00</h4>
							</div>
							<div class='card-body'>

								<button pid='$pro_id' style='float:right;margin-left:3px' id='product' class='btn btn-danger btn-xs'>Panier</button>
								<a href='information.php?pid=$pro_id' type='submit' <button type='submit' style='float:right;' id='plus' class='btn btn-danger btn-xs'>Plus</button> </a>
							</div>

						</div>
						</form>
			";
		}
	}



	if(isset($_POST["addToCart"])){


		$p_id = $_POST["proId"];


		if(isset($_SESSION["user_id"])){

		$user_id = $_SESSION["user_id"];

		$sql = "SELECT * FROM cart WHERE p_id = '$p_id' AND user_id = '$user_id'";
		$run_query = mysqli_query($con,$sql);
		$count = mysqli_num_rows($run_query);
		if($count > 0){
			echo "
				<div class='alert alert-warning'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is already added into the cart Continue Shopping..!</b>
				</div>
			";//not in video
		} else {
			$sql = "INSERT INTO `cart`
			(`p_id`, `ip_add`, `user_id`, `qty`)
			VALUES ('$p_id','$ip_add','$user_id','1')";
			if(mysqli_query($con,$sql)){
				echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is Added..!</b>
					</div>
				";
			}
		}
		}else{
			$sql = "SELECT id FROM cart WHERE ip_add = '$ip_add' AND p_id = '$p_id' AND user_id = -1";
			$query = mysqli_query($con,$sql);
			if (mysqli_num_rows($query) > 0) {
				echo "
					<div class='alert alert-warning'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<b>Product is already added into the cart Continue Shopping..!</b>
					</div>";
					exit();
			}
			$sql = "INSERT INTO `cart`
			(`p_id`, `ip_add`, `user_id`, `qty`)
			VALUES ('$p_id','$ip_add','-1','1')";
			if (mysqli_query($con,$sql)) {
				echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Your product is Added Successfully..!</b>
					</div>
				";
				exit();
			}

		}




	}

//Count User cart item
if (isset($_POST["count_item"])) {
	//When user is logged in then we will count number of item in cart by using user session id
	if (isset($_SESSION["user_id"])) {
		$sql = "SELECT COUNT(*) AS count_item FROM cart WHERE user_id = $_SESSION[user_id]";
	}else{
		//When user is not logged in then we will count number of item in cart by using users unique ip address
		$sql = "SELECT COUNT(*) AS count_item FROM cart WHERE ip_add = '$ip_add' AND user_id < 0";
	}

	$query = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($query);
	echo $row["count_item"];
	exit();
}
//Count User cart item

//Get Cart Item From Database to Dropdown menu
if (isset($_POST["Common"])) {

	if (isset($_SESSION["user_id"])) {
		//When user is logged in this query will execute
		$sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.user_id='$_SESSION[user_id]'";
	}else{
		//When user is not logged in this query will execute
		$sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.ip_add='$ip_add' AND b.user_id < 0";
	}
	$query = mysqli_query($con,$sql);
	if (isset($_POST["getCartItem"])) {
		//display cart item in dropdown menu
		if (mysqli_num_rows($query) > 0) {
			$n=0;
			while ($row=mysqli_fetch_array($query)) {
				$n++;
				$product_id = $row["product_id"];
				$product_title = $row["product_title"];
				$product_price = $row["product_price"];
				$product_image = $row["product_image"];
				$cart_item_id = $row["id"];
				$qty = $row["qty"];
				echo '
					<div class="row">
						<div class="col-md-3">'.$n.'</div>
						<div class="col-md-3"><img class="img-responsive" src="product_images/'.$product_image.'" /></div>
						<div class="col-md-3">'.$product_title.'</div>
						<div class="col-md-3">'.CURRENCY.''.$product_price.'</div>
					</div>';

			}
			?>
				<a style="float:right;" href="cart.php" class="btn btn-warning">Modifier&nbsp;&nbsp;<span class="glyphicon glyphicon-edit"></span></a>
			<?php
			exit();
		}
	}


			if (isset($_POST["checkOutDetails"])) {
		if (mysqli_num_rows($query) > 0) {
			//display user cart item with "Ready to checkout" button if user is not login
			echo "<form method='post' action='index.php'>";
				$n=0;
				while ($row=mysqli_fetch_array($query)) {
					$n++;
					$product_id = $row["product_id"];
					$product_title = $row["product_title"];
					$product_price = $row["product_price"];
					$product_image = $row["product_image"];
					$cart_item_id = $row["id"];
					$qty = $row["qty"];



					echo
						'<div class="row">
								<div class="col-md-2">
									<div class="btn-group">
										<a href="#" remove_id="'.$product_id.'" class="btn btn-danger remove"><span class="glyphicon glyphicon-trash"></span></a>
										<a href="#" update_id="'.$product_id.'" class="btn btn-primary update"><span class="glyphicon glyphicon-ok-sign"></span></a>
									</div>
								</div>
								<input type="hidden" name="product_id[]" value="'.$product_id.'"/>
								<input type="hidden" name="" value="'.$cart_item_id.'"/>
								<div class="col-md-2"><img class="img-responsive" src="product_images/'.$product_image.'"></div>
								<div class="col-md-2">'.$product_title.'</div>
								<div class="col-md-2"><input type="text" class="form-control qty" value="'.$qty.'" ></div>
								<div class="col-md-2"><input type="text" class="form-control price" value="'.$product_price.'" readonly="readonly"></div>
								<div class="col-md-2"><input type="text" class="form-control total" value="'.$product_price.'" readonly="readonly"></div>
							</div>';
							$total= ($product_price*$qty)+$total;
							$product= $product_title .' x '.$qty. ', ' . $product;
				}$price= $total;
				$products=$product;
				$qty1=$qty;
				$pro_id=$product_id;

				echo '<div class="row">
							<div class="col-md-8"></div>
							<div class="col-md-4">


					</div>';
				if (!isset($_SESSION["user_id"])) {
					echo '<input type="submit" style="float:right;" name="login_user_with_product" class="btn btn-info btn-lg" value="Payer" >
							</form>';

				}else if(isset($_SESSION["user_id"])){





		 echo '
						</form>
						<form action="../stripe/index.php" method="post">
						  <input type="hidden" name="qty" value="'.$qty1.'">
							<input type="hidden" name="id" value="'.$pro_id.'">
						  <input type="hidden" name="price" value="'.$price.'">
							<input type="hidden" name="products" value="'.$products.'">
							<input type="hidden" name="cmd" value="_cart">
							<input type="hidden" name="business" value="shoppingcart@LoyaltyCard.com">
							<input type="hidden" name="upload" value="1">';

							$x=0;
							$sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.user_id='$_SESSION[user_id]'";
							$query = mysqli_query($con,$sql);
							while($row=mysqli_fetch_array($query)){
								$x++;
								echo
									'<input type="hidden" name="item_name_'.$x.'" value="'.$row["product_title"].'">
								  	 <input type="hidden" name="item_number_'.$x.'" value="'.$x.'">
								     <input type="hidden" name="amount_'.$x.'" value="'.$row["product_price"].'">
								     <input type="hidden" name="quantity_'.$x.'" value="'.$row["qty"].'">';
								}


							echo
								'<input type="hidden" name="return" value="http://localhost/project1/payment_success.php"/>
					                <input type="hidden" name="notify_url" value="http://localhost/KhanStore/payment_success.php">
									<input type="hidden" name="cancel_return" value="http://localhost/KhanStore/cancel.php"/>
									<input type="hidden" name="currency_code" value="EUR"/>
									<input type="hidden" name="custom" value="'.$_SESSION["user_id"].'"/>
									<button  style="float:right;margin-right:80px;" class="btn btn-info btn-lg" name="submit"> Payer </button>

								</form>';
				}
			}
	}


}

//Remove Item From cart
if (isset($_POST["removeItemFromCart"])) {
	$remove_id = $_POST["rid"];
	if (isset($_SESSION["user_id"])) {
		$sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND user_id = '$_SESSION[user_id]'";
	}else{
		$sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND ip_add = '$ip_add'";
	}
	if(mysqli_query($con,$sql)){
		echo "<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Produit supprimé</b>
				</div>";
		exit();
	}
}


//Update Item From cart
if (isset($_POST["updateCartItem"])) {
	$update_id = $_POST["update_id"];
	$qty = $_POST["qty"];

	if (isset($_SESSION["user_id"])) {
		$sql = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND user_id = '$_SESSION[user_id]'";
	}else{
		$sql = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND ip_add = '$ip_add'";
	}
	if(mysqli_query($con,$sql)){
		echo "<div class='alert alert-info'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Produit mis à jour</b>
				</div>";
		exit();
	}



}




?>
