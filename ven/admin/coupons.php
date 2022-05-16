<?php include_once("menu.php"); ?>
<?php include_once("./templates/top.php"); ?>

<div class="container-fluid">
  <div class="row">
    <div class="sidebar">
        <h1>Espace Entreprise</h1>
        <a href="../account-company.php">Home</a>
        <a href="clients.php">Clients</a>
        <a href="offre_.php">Offres</a>
        <a href="coupons.php">coupons</a>
        <a href="add_produits.php">Produits</a>
        <a href="parrinage.php">Parrainage</a>

    </div>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Bonjour  <?php echo $_SESSION["full_name"]; ?></h1>

          </div>

      <div class="row">
      	<div class="col-10">
      		<h2>Manage coupon</h2>
      	</div>
      	<div class="col-2">
      		<a href="#" data-toggle="modal" data-target="#add_coupon_modal" class="btn btn-primary btn-sm">Ajouter coupon</a>
      	</div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Nom</th>
              <th>Code</th>
              <th>Pourcentage</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="coupon_list">
            <!-- <tr>
              <td>1</td>
              <td>ABC</td>
              <td>FDGR.JPG</td>
              <td>122</td>
              <td>eLECTRONCS</td>
              <td>aPPLE</td>
              <td><a class="btn btn-sm btn-info"></a><a class="btn btn-sm btn-danger">Delete</a></td>
            </tr> -->
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="add_coupon_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter l'coupon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add-coupon-form" enctype="multipart/form-data">
        	<div class="row">
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Valeur du code</label>
		        		<input type="text" name="off_title" class="form-control" placeholder="Entez le nom de l'coupon">
                <label>Pourcentage de promotion</label>
                <input type="text" name="off_discount" class="form-control" placeholder="Entez le nom de l'coupon">
		        	</div>
        		</div>
        		<input type="hidden" name="add_coupon" value="1">
        		<div class="col-12">
        			<button type="button" class="btn btn-primary add-coupon">Ajouter l'coupon</button>
        		</div>
        	</div>

        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->

<!--Edit coupon Modal -->
<div class="modal fade" id="edit_coupon_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter l'coupon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-coupon-form" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12">
              <input type="hidden" name="off_id">
              <div class="form-group">
                <label>Nom coupon</label>
                <input type="text" name="e_off_title" class="form-control" placeholder="Entez le nom de l'coupon">
              </div>
            </div>
            <input type="hidden" name="edit_coupon" value="1">
            <div class="col-12">
              <button type="button" class="btn btn-primary edit-coupon-btn">Mise à jour l'coupon</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->

<?php include_once("./templates/footer.php"); ?>



<script type="text/javascript" src="./js/coupons.js"></script>
