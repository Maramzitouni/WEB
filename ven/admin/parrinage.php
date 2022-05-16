<?php
    require_once "../../private/bdd_connect.php";
    include ('menu.php') ;



    include "templates/top.php";

?>







    <div class="container-fluid">
      <div class="row">
        <div class="sidebar">
            <h1>Espace Entreprise</h1>
            <a href="../account-company.php">Home</a>
            <a href="clients.php">Clients</a>
            <a href="parrinage.php">Parrainage</a>





        </div>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
              <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Bonjour  <?php echo $_SESSION["full_name"]; ?></h1>

              </div>



              <a href="../email1.php"  class="btn btn-primary btn-sm">Envoyer un email d'inscription</a>
          <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->



          <?php
           $parrainages = $bdd->prepare('SELECT id FROM company WHERE id_parrain = ?');
           $parrainages->execute(array($_SESSION['user_id']));
           $parrainages = $parrainages->rowCount();
        ?>
        Nombre de parrainages = <?php echo $parrainages; ?>


        <br>
        

        </main>
      </div>
    </div>








    <?php include "templates/footer.php"; ?>
