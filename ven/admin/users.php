<?php
session_start();


include "./templates/top.php";
 include_once("menu.php"); ?>
?>



<div class="container-fluid">
  <div class="row">

    <?php include "./templates/sidebar3.php"; ?>

      <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->

      <h2>Utilisateurs</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Entreprise</th>
              <th>Status</th>
              <th>Supprimer</th>
              <th>Valider</th>
            </tr>
          </thead>
          <tbody id="user_list">

          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<?php include "./templates/footer.php"; ?>

<script type="text/javascript" src="./js/users.js"></script>
