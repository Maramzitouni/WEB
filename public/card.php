<?php
require_once('../private/initialize.php');
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
               //$address = $row['address'];
               //$image = $row['image'];
               //$date = date('M d, Y', strtotime($row['date']));


                $html.="
                           <!-- second id card  -->
                           <div class='container' style='text-align:left; border:2px dotted black;'>
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
                                         <p>Address: </p>
                                     </div>
                                     <div class='box-3'>
                                         <img src='../card/assets/images/QRCODE.png' alt=''>
                                     </div>
                                 </div>

                                 <div class='container-3'>
                                     <div class='info-1'>
                                         <div class='id'>
                                             <h4>ID No</h4>
                                             <p>$id_no</p>
                                         </div>

                                         <div class='dob'>
                                             <h4>DOB</h4>
                                             <p></p>
                                         </div>

                                     </div>
                                     <div class='info-2'>
                                         <div class='join-date'>
                                             <h4>Joined Date</h4>
                                             <p></p>
                                         </div>
                                         <div class='expire-date'>
                                             <h4>Expire Date</h4>
                                             <p></p>
                                         </div>
                                     </div>
                                     <div class='info-3'>
                                         <div class='email'>
                                             <h4>Email</h4>
                                             <p>$email</p>
                                         </div>
                                         <div class='phone'>
                                             <h4>Phone</h4>
                                             <p></p>
                                         </div>
                                     </div>
                                     <div class='info-4'>
                                         <div class='sign'>
                                             <br>
                                             <p style='font-size:12px;'>Your Signature</p>
                                         </div>
                                     </div>
                                     <!-- id card end -->
                           ";

                $html.="";


$html.="</div>";




?>
<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="icon" type="image/png" href="../card/images/favicon.png"/>


<link rel="icon" type="image/png" href="../card/images/favicon.png"/>

<title>Card Generation | Coding Cush Technology</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/card.css">

</head>
<body>
  <br>

<div class="row" style="margin: 0px 20px 5px 20px">

  <div class="col-sm-6">
      <div class="card">
          <div class="card-header">
              Votre carte de fidelité :
          </div>
        <div class="card-body">
          <?php echo $html ?>
        </div>

     </div>
  </div>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>


  </body>
</html>
