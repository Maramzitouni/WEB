<?php
include ('menu.php') ;

$order= find_orders($_SESSION['user_id']);

if (isset($_POST['submit'])){

cancel_orders($_POST['cancel']);
header('Location:achat.php');

}
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
      <input type="hidden" name="cancel" value="<?php echo $orders["id"] ;?>">
      <h2 class="card__title">
        <a href="#"style="font-size:14px">Commande Web N°:  <?=$orders["id"]?>  </a></h2>
      <div class="card__subtitle">effectuée le :  <?=$orders["created_at"];?> </div>
      <h2 class="card__title" style="font-size:14px">  Détail de la commande : </h2>
        <div class="card__subtitle"style="font-size:14px">  <?= $_SESSION["full_name"]; ?></div>
        <h2 class="card__title"style="font-size:14px">  Produits : </h2>
        <div class="card__subtitle">  <?= $orders["product"]; ?></div>
        <div class="card__subtitle"style="font-size:14px">  <?= $orders["status"]; ?></div>
        <?php  if ($orders["status"]!="canceled" && $orders["status"]!="refunded") {?>  <button name ="submit"> Annuler la commande </button> <?php }?>
      </form>
    </div>

</article>
 <?php endforeach ?>
