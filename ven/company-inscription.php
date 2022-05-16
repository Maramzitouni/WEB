<?php

include ('navbar.php') ;


require_once('../private/initialize.php');


?>





<!DOCTYPE html>
<html id="html-id"  dir="ltr" lang="fr-FR">
    <head>
        <meta charset="utf-8" />
        <title>LoyaltyCard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../public/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>

    </head>

    <body>




    <main>
            <section>

           <div id="signup-container">
            <?php if(isset($_GET["error"]) && !empty($_GET["error"])) {?>
              <div>
                ERROR : <?= $_GET["error"] ?>
              </div>
            <?php } ?>
            <div class="container">
            <div class="row justify-content-center form-company-inscri">

            <div class="form-title-h4">
            <h4 class="cre-compte"><strong>CRÉER UN COMPTE ENTREPRISE</strong></h4>
            </div>
            <form action="../private/company-inscription-verif.php" method="post">






            <h5>Nom de l'entreprise</h5>
              <label for="name" class="name_input_"><sup></sup></label>
              <input class="input-design-inscri" type="text" placeholder="" name="name" id="name" required>

            <h5>Adresse de l'entreprise</h5>
              <label for="address" class="address_input_"></label>
              <input class="input-design-inscri" type="text" placeholder="" name="address" id="address" required>
            <h5>Email de l'entreprise</h5>
              <label class="email-inscri" for="companyemail"></label>
              <input class="input-design-inscri show-on-focus" type="email" name="companyemail" id="companyemail" required="" placeholder="me@LoyaltyCard.fr">

            <h5>Mot de passe</h5>
              <label for="pass" class="password-inscri"></label>
              <input class="input-design-inscri" type="password" id="pass" name="password" minlength="8" required value="">

            <?php  if(isset($_GET['p']) AND !empty($_GET['p'])){
                $p=$_GET['p']; ?>


              <input type="hidden" value="<?=$p?>" name="p">

            <?php }?>


              <button class="button-submit-cree" type="submit" >
                CRÉER UN COMPTE
              </button>
              <h6 class="rejoignez">Rejoignez-nous sur <a href="https://loyaltycard.ovh/">LoyaltyCard.ovh</a></h6>


            </form>

          </div>
          </div>
           </div>

         </section>










     </main>

     <footer>
         <div class="footer-title">
           <h1 class="Marybe-blanc">LoyaltyCard</h1>
         </div>

         <div class="nav-container-footer">
             <section class="heading-titles">
                 <p>SERVICES EN LIGNE</p>
                 <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Livraison</a></li>
                    <li><a href="#">Paiements</a></li>
                    <li><a href="#">Contact</a></li>
                 </ul>
             </section>



             <section class="heading-titles">
                  <p>À PROPOS</p>
                  <ul>
                    <li><a href="#">Qui-Sommes-Nous?</a></li>
                  </ul>
             </section>



             <section class="heading-titles">
                  <p>MENTIONS LÉGALES</p>
                  <ul>
                      <li><a href="#">Politique de confidentialité</a></li>
                      <li><a href="#">Politique relative aux cookies</a></li>
                      <li><a href="#">Conditions générales de vente</a></li>
                      <li><a href="#">Conditions générales d'utilisation</a></li>
                  </ul>
             </section>


         </div>

         <div class="contact-us">
             <ul>
                 <li>

                </li>
             </ul>
         </div>


     </footer>

    </body>
</html>
