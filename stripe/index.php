<?php    $prices = $_POST['price'] ;
         $products = $_POST['products'];
         $id=$_POST['id'];
         $qty=$_POST['qty'];

      $price=round($prices);


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Pay Page</title>
</head>
<body>
  <div class="container">
    <h2 class="my-4 text-center">Paiement</h2>
    <form action="charge.php" method="post" id="payment-form">
      <div class="form-row">
        <input type="hidden" name="qty" value="<?=$qty?>'">
        <input type="hidden" name="id" value="<?=$id?>">
        <input type="hidden"  value="<?php echo $price ;?>">
        <input type="hidden" name="products" value="<?php echo $products ;?>">
       <input type="text" name="first_name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Prénom">
       <input type="text" name="last_name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Nom">
       <input type="email" name="email" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Addresse Email">
        <div id="card-element" class="form-control">
          <!-- a Stripe Element will be inserted here. -->
        </div>
        <br>

      <br>

        <div id="card-errors" role="alert"></div>
      </div>

      <button class="btn btn-primary" style="padding-right:490px;padding-left:490px" >Valider le Paiement</button>

      <div class="form-group">
        <br>
      <label>Code Promo :</label>
      <br>
      <input type="text" id="coupon"/>
      <br>

      <br>

      <input type="hidden" value="<?php echo $price?>" id="price"/>
      <div id="result"></div>
      <button class="btn btn-primary" id="activate">Activer le Code</button>
      <br>
      <?php echo "                                           ";?>
      <br>
      <label >Prix Total:</label>
      <br>
      <input  name="price" type="number" value="<?php echo $price?>" id="total" readonly="readonly" lang="en-150"/>
    </div>

    </form>

  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script src="./js/charge.js"></script>
<script>
	$(document).ready(function(){
		$('#activate').on('click', function(){
			var coupon = $('#coupon').val();
			var price = $('#price').val();
			if(coupon == ""){
				alert("Please enter a coupon code!");
			}else{
				$.post('get_discount.php', {coupon: coupon, price: price}, function(data){
					if(data == "error"){
						alert("Code pas valide!");
						$('#total').val(price);
						$('#result').html('');
					}else{
						var json = JSON.parse(data);
						$('#result').html("<br> <h5 class='pull-right text-danger'>"+json.discount+"% Off</h5>");
						$('#total').val(json.price);
					}
				});
			}
		});
	});
</script>
</body>
</html>
