<?php include_once("menu.php"); ?>
<?php include_once("./templates/top.php"); ?>

<div class="container-fluid">
  <div class="row">

    <?php include "./templates/sidebar3.php"; ?>

      <div class="row">
      	<div class="col-10">
      		<h2>Manage Entreprise</h2>
      	</div>
      	<div class="col-2">
      		<a href="#" data-toggle="modal" data-target="#add_compagnie_modal" class="btn btn-primary btn-sm">Ajouter entreprise</a>
      	</div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Nom</th>
              <th>Email</th>
              <th>Chiffre affaire</th>
              <th>Adresse</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="compagnie_list">
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
<div class="modal fade" id="add_compagnie_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter l'entreprise</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add-compagnie-form" enctype="multipart/form-data">
        	<div class="row">
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Nom de l'entreprise</label>
		        		<input type="text" name="com_title" class="form-control" placeholder="Entez le nom de l'entreprise">
		        	</div>
        		</div>
        		<input type="hidden" name="add_compagnie" value="1">
        		<div class="col-12">
        			<button type="button" class="btn btn-primary add-compagnie">Ajouter l'entreprise</button>
        		</div>
        	</div>

        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->

<!--Edit compagnie Modal -->
<div class="modal fade" id="edit_compagnie_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter l'entreprise</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-compagnie-form" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12">
              <input type="hidden" name="com_id">
              <div class="form-group">
                <label>Nom compagnie</label>
                <input type="text" name="e_com_title" class="form-control" placeholder="Entez le nom de l'entreprise">
              </div>
            </div>
            <input type="hidden" name="edit_compagnie" value="1">
            <div class="col-12">
              <button type="button" class="btn btn-primary edit-compagnie-btn">Mise à jour l'entreprise</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->

<?php include_once("./templates/footer.php"); ?>



<script type="text/javascript" src="./js/compagnie.js"></script>
