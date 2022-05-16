
<?php
require_login();

  $uri = $_SERVER['REQUEST_URI'];
  $uriAr = explode("/", $uri);
  $page = end($uriAr);

?>


<div class="sidebar">
   <h1>Administration</h1>
   <a href="index.php">Admins</a>
   <a href="compagnie.php">Entreprises</a>
   <a href="offres.php">Offres</a>
   <a href="users.php">Users</a>
   <a href="customer_orders.php">Achats</a>
   <a href="products.php">Produits</a>
   <a href="brands.php">Marques</a>
   <a href="categories.php">Categories</a>
   <a href="customers.php">Commandes</a>
   <a href="">Contact</a>
</div>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Bonjour  <?php echo $_SESSION["admin_name"]; ?></h1>

      </div>
