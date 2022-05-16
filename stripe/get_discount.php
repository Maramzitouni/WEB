<?php
  include_once("../ven/db.php");
	$coupon_code = $_POST['coupon'];
	$price = $_POST['price'];

	$query = mysqli_query($con, "SELECT * FROM `coupon` WHERE `coupon_code` = '$coupon_code' && `status` = 'Valid'") or die(mysqli_error());
	$count = mysqli_num_rows($query);
	$fetch = mysqli_fetch_array($query);
	$array = array();
	if($count > 0){
		$discount = $fetch['discount'] / 100;
		$total = $discount * $price;
		$array['discount'] = $fetch['discount'];
		$array['price'] = $price - $total;

		echo json_encode($array);

	}else{
		echo "error";
	}
?>
