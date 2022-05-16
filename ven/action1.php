<?php include "db.php";
if(isset($_POST["getOffre"])){
	$i=0;
	$limit = 9;

		$start = 0;
	}
	$product_query = "SELECT * FROM article LIMIT $start,$limit";
	$run_query = mysqli_query($con,$product_query);
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){

			$i++;
			$pro_name = $row['nom'];
      $pro_id= $row['id_produit'];
			$pro_cat   = $row['description'];
			$pro_brand = $row['image'];

			echo "

				<div class='card'>
				      <img src='product_images/$pro_brand'/>
							<div class='card-header'>
								<h4 class='title'>$pro_name</h4>
								<h4 class='price'>".CURRENCY." .00</h4>
								</div>
								<div class='card-body'>

									<button pid='$pro_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>Panier</button>
								</div>

							</div>

			";


		}
	}
} ?>
