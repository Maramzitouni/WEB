<?php
include ('menu.php') ;

$order= find_promo();

?>

<link rel="stylesheet" type="text/css" href="css/sidebar1.css">
<link rel="stylesheet" type="text/css" href="css/card.css">
<link rel="stylesheet" type="text/css" href="css/card1.css">
<div class="sidebar">
   <h1>Bonjour <?= $_SESSION["first_name"]; ?></h1>
   <a href="account.php">Mon Compte</a>
   <a href="achat.php">Mes Achats</a>
   <a href="offres.php">Mes Offres</a>
   <a href="">Contact</a>
</div>


<?php
foreach($order as $orders):
?>
  <article class="card" >


    <div class="card__body">
      <form method="post" >
      <h2 class="card__title">
        <a href="#"style="font-size:14px">Code N°:  <?=$orders["coupon_id"]?>  </a></h2>
      <div class="card__subtitle">validité :  <?=$orders["status"];?> </div>
      <h2 class="card__title" style="font-size:14px">  Pour : </h2>
        <div class="card__subtitle"style="font-size:14px">  <?= $_SESSION["full_name"]; ?></div>
        <h2 class="card__title"style="font-size:14px">  Code : </h2>
        <div class="card__subtitle">  <?= $orders["coupon_code"]; ?></div>
        <div class="card__subtitle"style="font-size:14px">  -<?= $orders["discount"]; ?>%</div>
      </form>
    </div>

</article>
 <?php endforeach ?>
