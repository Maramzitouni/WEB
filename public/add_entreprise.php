<?php
 include ('menu.php') ;
 require_once('../private/initialize.php');


if (isset($_POST['submit2'])){
if(is_post_request()) {


  $target_dir = "../ven/product_images";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }

  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["image"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }




   $article['nom'] = $_POST['nom'] ?? '';
   $article['description'] = $_POST['description'] ?? '';
   $article['image'] = $_POST['image'] ?? '';
   $article['prix'] = $_POST['prix'] ?? '';
   $article['id_ent']=$_SESSION['com_id'];
if (!empty($article['nom'])&& !empty($article['description']) && !empty($article['image']) && !empty($article['prix'])) {
   insert_article($article);
}

}
}

if (isset($_POST['submit1'])){
if(is_post_request()) {


  $reduction['promo'] = $_POST['promo'];

  insert_reduction($reduction);

}
}
?>







<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="/css/add.css">
  <body style="background-color: black; overflow-x: hidden;">

    <div class="col-1" style="padding-top:30px; margin-left:10px;">
          <a href="index.php">
            <button type="button" class="btn btn-outline-light btn-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
            </button>
          </a>
    </div>

    <div class="container" id="pres" style="padding-top:10px; padding-bottom:30px;">
        <div class="row justify-content-center">




                        <h1 style="color: white;"> Présentation de l'offre </h1>
                        <br>


          </div>
    </div>


    <div class="container">
        <div class="row justify-content-center">
          <div class="col-6">


                  <form class="ent_form" action="index.html" method="post">

                          <input type="checkbox" id="type1" name="" value="" class="article" onclick="article()">
                          <label for="type1" style="color: white;">Un article</label>

                  </form>
          </div>
          <div class="col-6">
                  <form class="ent_form" action="" method="post">

                          <input type="checkbox" id="type2" name="" value="" class="promo" onclick="promo()">
                          <label for="type2" style="color: white;">Une promotion</label><br>

                  </form>
            </div>
          </div>
      </div>

  <div class="row justify-content-center">




    <div id="article" class="col-4" style="display: none;">

                  <form class=""  method="post" action="">

                    <label for="nom_art" style="color: white;">Nom de votre article : </label>
                    <input type="text" id="nom_art" name="nom" value="<?php echo h($article['nom']); ?>">
                    <br>

                    <label for="description" style="color: white;">Decrivez votre article : </label>
                    <input type="text" id="description" name="description" value="<?php echo h($article['description']); ?>">
                    <br>

                    <label for="prix" style="color: white;">Prix de l'article:</label>
                    <input type="number" id="prix" name="prix"  step="0.01" ><br>

                    <input type="file" class="input-file" id="img"  name="image" style="color: white;">
                    <br>
                    <input type="submit"  name="submit2" value="Valider." class="btn btn-success" onclick="" style="margin-bottom:80px;">

                    </form>

    </div>
    <div class="col-4" id="reduction" style="display: none;">

                <form class="" action="" method="post">

                  <label for="promo" style="color: white;">Réduction en pourcentage:</label>
                  <input type="number" id="promo" name="promo" min="10" max="90"  ><br>

                  <input type="submit" name="submit1" value="Valider." class="btn btn-success" onclick="">

                </form>

    </div>
    </div>

    <script type="text/javascript">

                  var art = document.getElementById('article');

                      function article() {
                        if(art.style.display == 'none')
                          art.style.display = 'block';
                       else
                          art.style.display = 'none';
                      }

                  var prom = document.getElementById('reduction');

                      function promo() {
                        if(prom.style.display == 'none')
                          prom.style.display = 'block';
                       else
                          prom.style.display = 'none';
                      }
    </script>
  </body>

</main>






















      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>
