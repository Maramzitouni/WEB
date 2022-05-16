<?php

include ('navbar.php');


      ?>





      <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                <div class="row">
            Demande d'achat envoyée :
                  <?php

                      $req = $bdd->query('SELECT * FROM article');
                      $demande =$req->fetchALL();
                      foreach ($demande as $demandes): ?>

                      <div class ="col-md-4 col-xs-12">
                          <div class="event shadow">
                            <img src="product_images/<?=$demandes['image']?>" alt="image" width="100" height="100" class="card-img-top eventImages">
                            <h3 class="event-title"> <?=$demandes['nom'] ?>  </h3>
                            <p class="event-desc"> <?=$demandes['description'] ?> <br> prix:  <?= $demandes['prix'] ?> </p>

                          </div>
                       <br>
                      </div>
                  <?php endforeach ?>
              </div>
            </div>
