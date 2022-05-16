<?php
session_start();
include ('menu.php') ;




if(is_post_request()) {

  $user['first_name'] = $_POST['first_name2'] ?? '';
  $user['last_name'] = $_POST['last_name2'] ?? '';
  $user['email'] = $_POST['email2'] ?? '';
  $user['username'] = $_POST['username2'] ?? '';
  $user['password'] = $_POST['password2'] ?? '';
  $user['number'] = $_POST['number'] ?? '';
  $user['adress'] = $_POST['adress'] ?? '';
  /*$user['confirm_password'] = $_POST['confirm_password'] ?? '';*/

  $result = update_user($user);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    $_SESSION['message'] = 'user created.';
    $user['id']=$new_id;
    log_in_user($user);
    /*redirect_to(url_for('index.php?id=' . $new_id));*/
    redirect_to('account.php');
  } else {
    $errors = $result;
  }

} else {
  // display the blank form
  $user = [];
  $user["first_name"] = '';
  $user["last_name"] = '';
  $user["email"] = '';
  $user["username"] = '';
  $user['password'] = '';
  $user['confirm_password'] = '';
  $user['adress'] = '';
  $user['number']='';

}

$notfound = false;
$html="<div class='card' style='width:350px; padding:0;' >";
$html.="";


       $name = $_SESSION['full_name'];
       $id_no = $_SESSION['user_id'];
       //$dob = $row['dob'];
       //$address = $row['address'];
       $email = $_SESSION['email'];
       //$exp_date = $row['exp_date'];
       //$phone = $row['phone'];
       $adress = $_SESSION['adress'];
       $number = $_SESSION['number'];
       //$image = $row['image'];
       //$date = date('M d, Y', strtotime($row['date']));
       $userID=find_user_by_id($id_no);
       $points=$userID['points'];
    $html.="
                   <!-- second id card  -->
                   <div id='whatToPrint' class='container' style='text-align:left; border:2px dotted black;'>
                         <div class='header'>
                             <h1 style='text-transform: uppercase'>LoyaltyCard</h1>
                             <p>www.LoyaltyCard.com</p>
                         </div>

                         <div class='container-2'>
                             <div class='box-1'>
                             <img src=''/>
                             </div>
                             <div class='box-2'>
                                 <h2>$name</h2>
                                 <p>adresse: </p>
                                 <p>$adress</p>

                             </div>
                             <div class=''>
                                 <div id='output'></div>
                             </div>
                         </div>

                         <div class='container-3'>
                             <div class='info-1'>
                                 <div class=''>
                                     <h4>ID</h4>
                                     <p>$id_no</p>
                                 </div>

                                 <div class=''>
                                     <h6>points de fidélité:</h6>
                                     <p>$points</p>
                                 </div>

                             </div>
                             <div class='info-2'>
                                 <div class=''>
                                     <h4>Joined Date</h4>
                                     <p>12_05_2022</p>
                                 </div>
                                 <div class=''>
                                     <h4>Expire Date</h4>
                                     <p>12_05_2024</p>
                                 </div>
                             </div>
                             <div class='info-3'>
                                 <div class=''>
                                     <h4>Email</h4>
                                     <p>$email</p>
                                 </div>
                                 <div class=''>
                                     <h4>Numéro</h4>
                                     <p>$number</p>
                                 </div>
                             </div>
                             <div class='info-4'>
                                 <div class='sign'>
                                     <br>
                                     <p style='font-size:12px;'>Votre Signature</p>
                                 </div>
                             </div>
                             <!-- id card end -->
                   ";
        $html.="";
$html.="</div>";


//barcode



?>


<link rel="stylesheet" type="text/css" href="css/sidebar1.css">
<link rel="stylesheet" type="text/css" href="css/card.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js" ></script>
<div class="sidebar">
   <h1>Bonjour <?= $_SESSION["first_name"]; ?></h1>
   <a href="account.php">Mon Compte</a>
   <a href="achat.php">Mes Achats</a>
   <a href="offres.php">Mes Offres</a>
   <a href="">Contact</a>
</div>


  <section>

    <div class="sign-up1" id="sign-container2" style="margin-left:300px;">
     <p class="cre-compte1" style="padding-left: 25px; margin-top:50px; font-family: "Rubik";">Modifier votre compte :</p>
     <form action="<?php echo ('account.php'); ?>" method="post">

       <label for="civilite_input"></label>
       <select name="civilite" id="civilite_input1" class="input-select-design-inscri" type="select" required>
         <option disabled selected>Civilité</option>
         <option>M.</option>
         <option>Mme</option>
       </select>
       <label for="name_input" class="name_input_1">Prénom<sup>*</sup></label>
       <input class="input-design-inscri" type="text" placeholder="" value="<?php echo $_SESSION['first_name'] ; ?>" name="first_name2" id="name_input1" required value="<?php echo h($user['first_name']); ?>">


       <label for="lastname_input" class="lastname_input_1">Nom<sup>*</sup></label>
       <input class="input-design-inscri" type="text" placeholder="" value="<?php echo $_SESSION['last_name'] ; ?>" name="last_name2" id="lastname_input1" required value="<?php echo h($user['last_name']); ?>">


       <label for="pays_input" class="pays_input_1">France</label>
       <input class="input-design-inscri" type="text" placeholder="" name="country" id="pays_input1" disabled>
     <label class="email-inscri1" for="email_ins">E-mail<sup>*</sup></label>
       <input class="input-design-inscri show-on-focus" type="email" value="<?php echo $_SESSION['email'] ; ?>" name="email2" id="email_ins1" required="" placeholder="me@LoyaltyCard.fr" value="<?php echo h($user['email']); ?>">

       <label for="pass_ins" class="number-inscri1">Numéro de téléphone<sup>*</sup></label>
       <input class="input-design-inscri" type="text" id="number" name="number" minlength="10" value="<?php echo $_SESSION['number'] ; ?>">

       <label for="pass_ins" class="adress-inscri1">Adresse<sup>*</sup></label>
       <input class="input-design-inscri" type="text" id="adress" name="adress"  value="<?php echo $_SESSION['adress'] ; ?>"  >

       <label for="pass_ins" class="password-inscri1">Mot de passe<sup>*</sup></label>
       <input class="input-design-inscri" type="password" id="pass_ins1" name="password2" minlength="8" required value="">

       <button class="button-submit-cree" type="submit" >
         CONFIRMER
       </button>
     <a href="javascript:generatePDF()" id="downloadButton">Votre Carte en PDF</a>
     </form>
    </div>
    <br>

<br>
    <div  class="row" style="margin: -768px -20px 300px 770px;"><!-- haut | droit | bas | gauche */-->


          <div  class="card">
              <div class="card-header" style="margin-bottom:70px;font-size: 25px;">
                  Votre carte de fidelité :
              </div>
            <div  class="card-body">
              <?php echo $html ?>
            </div>

         </div>



</div>

</section>
</main>

<script src="qrcode.js"></script>

<script>
    let qrcode = new QRCode("output", {
        text: "<?=$points?>",
        width: 77,
        height: 77,
        colorDark : "#990000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });

    document.body.addEventListener('click', ()=>{
        qrcode.clear();
        qrcode.makeCode("https://loyaltycard.ovh/public/done.php/<?=$points?>");
    })

</script>


<script>
        async function generatePDF() {
            document.getElementById("downloadButton").innerHTML = "en cours de téléchargement";

            //Downloading
            var downloading = document.getElementById("whatToPrint");
            var doc = new jsPDF('l', 'pt');

            await html2canvas(downloading, {
                allowTaint: true,
                useCORS: true,



            }).then((canvas) => {
                //Canvas (convert to PNG)
                doc.addImage(canvas.toDataURL("image/jpeg"), 'jpeg',5,5,500,300);
            })

            doc.save("Carte.pdf");

            //End of downloading

            document.getElementById("downloadButton").innerHTML = "Votre Carte en PDF";
        }
    </script>






      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>
