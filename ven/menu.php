<?php

require_once('../private/initialize.php');

if(is_post_request()) {

  $email = $_POST['email1'] ?? '';
  $password = $_POST['password1'] ?? '';

  // Validations
  if(is_blank($email)) {
    $errors[] = "Username cannot be blank.";
  }
  if(is_blank($password)) {
    $errors[] = "Password cannot be blank.";
  }

  // if there were no errors, try to login
  if(empty($errors)) {
    // Using one variable ensures that msg is the same
    $login_failure_msg = "Log in was unsuccessful.";

    $user = find_user_by_email($email);
    $company = find_company_by_email($email);
    if($user) {


    


      if(password_verify($password, $user['hashed_password'])) {
        // password matches
        log_in_user($user);
        redirect_to('index.php');
      } else {
        // username found, but password does not match
        $errors[] = $login_failure_msg;
      }

    } else if($company) {
      if ($company['status']!=1){
        $_SESSION['status']=0;
      }

      if(!strcmp($password, $company['password'])) {
        // password matches
        log_in_company($company);
        redirect_to(url_for('index.php'));

    } else {
      // no username found
      $errors[] = $login_failure_msg;
    }
  } else {
    // no username found
    $errors[] = $login_failure_msg;
  }
  }

}

//  <button class="button-create" style="margin-top: 9px;" onclick="document.location.href='../public/company-inscription.php'" >CRÉER UN COMPTE D'ENTREPRISE</button>

if(is_post_request()) {

  $user['first_name'] = $_POST['first_name'] ?? '';
  $user['last_name'] = $_POST['last_name'] ?? '';
  $user['email'] = $_POST['email'] ?? '';
  $user['username'] = $_POST['username'] ?? '';
  $user['password'] = $_POST['password'] ?? '';
  $user['entreprise'] = $_POST['entreprise'] ?? '';

  /*$user['confirm_password'] = $_POST['confirm_password'] ?? '';*/

  $result = insert_user($user);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    $_SESSION['message'] = 'user created.';
    $user['id']=$new_id;
    log_in_user($user);
    /*redirect_to(url_for('index.php?id=' . $new_id));*/
    redirect_to('index.php');
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

}





?>


<!DOCTYPE html>
<html id="html-id"  dir="ltr" lang="fr-FR">
    <head>
        <meta charset="utf-8" />
        <title>LoyaltyCard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/menu.css">
        <link rel="stylesheet" type="text/css" href="css/company-bo.css">
        <link rel="shortcut icon" href="images/EWU.ico" type="image/x-icon" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<link rel="stylesheet" type="text/css" href="style.css">

<link rel="stylesheet" href="css/bootstrap.min.css"/>
        <script src="js/jquery2.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="main.js"></script>



    </head>

    <body>



      <header id="header-bar">

         <div class="title-bar">
           <h4 class="livraison">LIEU DE LIVRAISON: <strong>EUR</strong></h4>
           <h1 class="Marybe">LoyaltyCard </h1>
           <div class="icons">
             <a href="javascript:void(0)" onclick="openNav(); on();"><i style="font-size:20px" class="fa">&#xf2c0;</i></a>
             <a href=""><i style="font-size:20px" class="fa"> &#xf006;</i></a>
             <?php if ($_SESSION['status'] != 1 ){  ?>  <a href="../public/account.php"><i style="font-size:20px"class="fa">&#xf013;</i></a> <?php } else {?>

               <a href="./admin/index.php"><i style="font-size:20px"class="fa">&#xf013;</i></a> <?php }?>




               <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span>Cart<span class="badge">0</span></a>
                 <div class="dropdown-menu" style="width:400px; left: -200px; margin: 2px -37px 0px;">
                   <div class="panel panel-success" >
                     <div class="panel-heading"style="background-color:black;">
                       <div class="row">
                         <div class="col-md-3">N°</div>
                         <div class="col-md-3">Image</div>
                         <div class="col-md-3">Nom</div>
                         <div class="col-md-3">Prix en <?php //echo CURRENCY; ?></div>
                       </div>
                     </div>
                     <div class="panel-body">
                       <div id="cart_product">
                       <!--<div class="row">
                         <div class="col-md-3">Sl.No</div>
                         <div class="col-md-3">Product Image</div>
                         <div class="col-md-3">Product Name</div>
                         <div class="col-md-3">Price in $.</div>
                       </div>-->
                 </div>
                     </div>
                     <div class="panel-footer"></div>
                   </div>
                 </div>





           </div>

        </div>
         <div>
             <ul class="nav-bar" id="nav-bar-hide">
                 <li><a href='index.php'>NOS PORDUITS</a></li>
                 <li><a href='#'>TENDANCES</a></li>
                 <li><a href='#'>MESSAGES</a></li>
             </ul>
         </div>

      </header>

      <nav>
         <div id="mySidepanel" class="sidepanel">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav(); off();">×</a>
            <ul class="account-bar">
              <li><a href="javascript:void(0)" id='inscription-button' onclick="inscri()">INSCRIPTION</a></li>
              <li><a href="javascript:void(0)" id='compte-button' onclick="sign_in()">COMPTE</a></li>
              <li><a href="javascript:void(0)" id='cart-button' onclick="cart()">PANIER</a></li>
            </ul>

            <div style="position:absolute; left: 0;">
              <?php echo display_errors($errors); ?>
           </div>

            <section>

             <div class="login" id="login-container">
                 <?php if (!is_logged_in()) : ?>
             <p class="se-con">SE CONNECTER</p>
             <p class="acced">Pour accéder à votre compte</p>

             <form method="post" action="<?php echo url_for('index.php'); ?>">
               <label class="email-" for="email"><sup>*</sup>E-mail</label>
               <input class="input-design show-on-focus" type="email" name="email1" id="email" required="" placeholder="me@LoyaltyCard.fr">
               <label for="pass" class="password-"><sup>*</sup>Mot de passe</label>
               <input class="input-design" type="password" id="pass" name="password1"minlength="8" required>
               <a href="#" class="reset-pass">Mot de passe oublié ?</a>
               <button class="button-submit" type="submit" name="submit1">
                 ME CONNECTER
               </button>
             </form>
             <div class="sign-nav">
                 <p class="vous-nav">VOUS N'AVEZ PAS DE COMPTE ?</p>
                 <button class="button-create" onclick="inscri()" >CRÉER UN COMPTE</button>
             </div>
             <?php endif; ?>
             <?php if (is_logged_in()) : ?>

               <p class="welcome"> Bienvenue <?php echo $_SESSION['full_name'] ; ?>
               <a class="log_out" href="<?php echo url_for('../public/staff/logout.php'); ?>">SE DECONNECTER</a>

             <?php endif; ?>
            </div>




          </section>






          <section>

            <div class="sign-up" id="signup-container">
             <p class="cre-compte">CRÉER UN COMPTE</p>
             <p class="rejoignez">Rejoignez-nous sur LoyaltyCard.fr</p>
             <form action="<?php echo url_for('index.php'); ?>" method="post">


               <label for="civilite_input"></label>
               <select name="civilite" id="civilite_input" class="input-select-design-inscri" type="select" required>
                 <option disabled selected>Civilité</option>
                 <option>M.</option>
                 <option>Mme</option>
               </select>




               <label for="name_input" class="name_input_">Prénom<sup>*</sup></label>
               <input class="input-design-inscri" type="text" placeholder="" name="first_name" id="name_input" required value="<?php echo h($user['first_name']); ?>">


               <label for="lastname_input" class="lastname_input_">Nom<sup>*</sup></label>
               <input class="input-design-inscri" type="text" placeholder="" name="last_name" id="lastname_input" required value="<?php echo h($user['last_name']); ?>">


               <label for="pays_input" class="pays_input_">France</label>
               <input class="input-design-inscri" type="text" placeholder="" name="country" id="pays_input" disabled>




               <label class="email-inscri" for="email_ins">E-mail<sup>*</sup></label>
               <input class="input-design-inscri show-on-focus" type="email" name="email" id="email_ins" required="" placeholder="me@LoyaltyCard.fr" value="<?php echo h($user['email']); ?>">


               <label for="pass_ins" class="password-inscri">Mot de passe<sup>*</sup></label>
               <input class="input-design-inscri" type="password" id="pass_ins" name="password" minlength="8" required value="">





               <button class="button-submit-cree" type="submit" >
                 CRÉER UN COMPTE
               </button>
             </form>
            </div>

          </section>


          <section>

           <div class="cart" id="cart-container">

             <div class="container-fluid">
               <div class="row">
                 <div class="col-md-2"></div>
                 <div class="col-md-8" id="cart_msg">
                   <!--Cart Message-->
                 </div>
                 <div class="col-md-2"></div>
               </div>
               <div class="row">
                 <div class="col-md-2"></div>
                 <div class="col-md-12">
                   <div class="panel panel-primary"style="border-color: black;">
                     <div class="panel-heading" style="background-color: black; border-color: black;">Panier Checkout</div>
                     <div class="panel-body">
                       <div class="row">
                         <div class="col-md-2 col-xs-2"><b>Action</b></div>
                         <div class="col-md-2 col-xs-2"><b>Image</b></div>
                         <div class="col-md-2 col-xs-2"><b>Nom</b></div>
                         <div class="col-md-2 col-xs-2"><b>Quantité</b></div>
                         <div class="col-lg-2 "><b>Prix</b></div>
                         <div class="col-md-2 col-xs-2"><b>Prix en <?php echo CURRENCY; ?></b></div>
                       </div>
                       <div id="cart_checkout"></div>

                       </div>
                     </div>
                     <div class="panel-footer"></div>
                   </div>
                 </div>
                 <div class="col-md-2"></div>

               </div>

          </div>

          </section>




        </div>
        <div id="overlay" onclick="off(); closeNav(); "></div>



      <script>
         function openNav() {
           document.getElementById("mySidepanel").style.width = "550px";
          }

          function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
           }
           function on() {
            document.getElementById("overlay").style.display = "block";
           }

           function off() {
            document.getElementById("overlay").style.display = "none";
           }

           function inscri() {

            var x = document.getElementById("login-container");
            x.style.display = "none";
            document.getElementById("signup-container").style.display = "flex";
            document.getElementById("cart-container").style.display = "none";
            document.getElementById("inscription-button").style.borderBottom =  ".125rem solid black";
            document.getElementById("compte-button").style.borderBottom =  "none";
            document.getElementById("cart-button").style.borderBottom =  "none";
            }

            function sign_in () {
             document.getElementById("login-container").style.display = "flex";
             document.getElementById("signup-container").style.display = "none";
             document.getElementById("cart-container").style.display = "none";
             document.getElementById("inscription-button").style.borderBottom =  "none";
             document.getElementById("compte-button").style.borderBottom =  ".125rem solid black";
             document.getElementById("cart-button").style.borderBottom =  "none";

            }

            function cart() {
              document.getElementById("login-container").style.display = "none";
              document.getElementById("signup-container").style.display = "none";
              document.getElementById("cart-container").style.display = "flex";
              document.getElementById("inscription-button").style.borderBottom =  "none";
              document.getElementById("compte-button").style.borderBottom ="none";
              document.getElementById("cart-button").style.borderBottom = ".125rem solid black";


            }



            var prevScrollpos = window.pageYOffset;
            var height = document.body.offsetHeight;
            window.onscroll = function() {
             var currentScrollPos = window.pageYOffset;
             if (currentScrollPos > 1000) {

               document.getElementById("header-bar").style.zIndex = "0";
               /*document.getElementById("header-bar").style.animation = " fadein 2s ease-in  ";*/
                }

             else {
              document.getElementById("header-bar").style.zIndex = "2";

              }

              prevScrollpos = currentScrollPos;
             }
             var CURRENCY = '<?php echo CURRENCY; ?>';



       </script>

     </nav>
