<?php

    include ('menu.php') ;

    require_once "../../private/bdd_connect.php";

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


                    <div class="row">
                      <div class="col-10">
                        <h2>Gestion Clients</h2>
                      </div>
                      <div class="col-2">

                        <br>
                          <a href="../email.php"  class="btn btn-primary btn-sm">Envoyer un email d'inscription</a>
                      </div>

                    </div>

                      <br>



          <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->


          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th></th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="client_list">

              </tbody>
            </table>
          </div>

        </main>
      </div>
    </div>






    <!-- Modal -->
    <div class="modal fade" id="add_client_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajouter le client</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="add-client-form" enctype="multipart/form-data">
            	<div class="row">
            		<div class="col-12">
            			<div class="form-group">
    		        		<label>Nom du client</label>
    		        		<input type="text" name="cli_title" class="form-control" placeholder="Entez le nom du client">
    		        	</div>
                  <div class="form-group">
    		        		<label>Email du client</label>
    		        		<input type="text" name="cli_email" class="form-control" placeholder="Entez le nom du client">
    		        	</div>
            		</div>
            		<input type="hidden" name="add_client" value="1">
            		<div class="col-12">
            			<button type="button" class="btn btn-primary add-client">Ajouter le client</button>
            		</div>
            	</div>

            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->






    <!-- Modal -->













    <!--Edit client Modal -->
    <div class="modal fade" id="edit_client_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajouter l'client</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="edit-client-form" enctype="multipart/form-data">
              <div class="row">
                <div class="col-12">
                  <input type="hidden" name="cli_id">
                  <div class="form-group">
                    <label>Nom client</label>
                    <input type="text" name="e_cli_title" class="form-control" placeholder="Entez le nom de l'client">
                  </div>
                </div>
                <input type="hidden" name="edit_client" value="1">
                <div class="col-12">
                  <button type="button" class="btn btn-primary edit-client-btn">Mise à jour l'client</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->









    <?php include "templates/footer.php"; ?>

    <script type="text/javascript" src="js/clients.js"></script>
