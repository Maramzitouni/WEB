<?php
    require_once("../private/bdd_connect.php");
    include ('navbar.php') ;

    if (isset($_POST['ok'])){
    $q = "UPDATE company SET CA = ? WHERE id = ?";
    $req = $bdd->prepare($q);
    $req->execute([floatval($_POST["CA"]), intval($_SESSION["com_id"])]);

    header("location:account-company.php");
}
?>

<section id="mainCompany">
    <div class="sidebar">
        <h1>Espace Entreprise</h1>
        <a href="account-company.php">Home</a>
        <a href="admin/clients.php">Clients</a>
        <a href="admin/parrinage.php">Parrainage</a>

    </div>

    <section>
        <section id="card">
            <div id="modif-account">
                <h3>Modifier votre compte :</h3>
                <form action="#" method="post">

                    <label for="name">Nom de l'entreprise<sup>*</sup></label>
                    <input type="text" placeholder="" value="<?php echo $_SESSION['name'] ; ?>" name="name" id="name" required>

                    <label for="email">E-mail<sup>*</sup></label>
                    <input type="email" value="<?php echo $_SESSION['email'] ; ?>" name="email" id="email" required placeholder="me@LoyaltyCard.fr" value="<?php echo h($user['email']); ?>">

                    <label for="password" >Mot de passe<sup>*</sup></label>
                    <input type="password" id="password" name="password" minlength="8" required value="">

                    <button type="submit" >CONFIRMER</button>

                </form>
            </div>

            <div id="companyPay">
                <?php
                    $req = $bdd->prepare("SELECT * FROM company WHERE id = ?");
                    $req->execute([$_SESSION['com_id']]);
                    $company = $req->fetch();
                    $req1 = $bdd->prepare("SELECT * FROM transactions WHERE user_id = ? AND product='cotisations' ");
                    $req1->execute([$_SESSION['com_id']]);
                    $company1 = $req1->fetch();

                    $date = date('Y-m-d');


                    if ($company1["nonvalide"]<= $date || !isset($company1["nonvalide"])){
                ?>
                <H2>Chiffre d'affaire actuel : <span style="font-size: 1.3em;"><?= $company["CA"] ?></span></H2>
                <form  method="POST" id="companyForm">
                    <input type="number" min="0" step="0.01" id="CA" name="CA" placeholder="Nouveau chiffre d'affaire" required>
                    <button name="ok" type="submit"> Valider </button>
                </form>
                <div>
                  <br>
                  <br>
                    <?php
                  }else{ }
                        $coef = 0;
                        $value = intval($company["CA"]);
                        if($value < 200000) $value*=0;
                        elseif($value < 800000) $value*=0.008;
                        elseif($value < 1500000) $value*=0.006;
                        elseif($value < 3000000) $value*=0.004;
                        elseif($value >= 3000000) $value*=0.003;
                        $product="cotisations";


                        if ($company1['status']=='succeeded'&& $company1["nonvalide"]>$date ) {
                            echo " Cotisation payé! valide jusqu'à ";
                            echo $company1['nonvalide'];

                        }else{




                    ?>
                    <form method="post" action="../stripe/index.php">

                      <input type="hidden" name="price" value="<?=$value?>">
        							<input type="hidden" name="products" value="<?=$product?>">
                    <p>Vous devez payer <span style="font-size: 1.3em;"><?= $value?> €</span> </p>
                    <button> payer</button>
                  </form> <?php


                }?>

                </div>


            </div>
        </section>
    </section>
</section>
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "cf719161-1c43-4981-9810-59f56b29465c",
    });
  });
</script>

<script>
OneSignal.push(function() {
  /* These examples are all valid */
  var isPushSupported = OneSignal.isPushNotificationsSupported();
  if (isPushSupported) {
    // Push notifications are supported
    console.log('supported');
    OneSignal.isPushNotificationsEnabled(function(isEnabled) {
          if (isEnabled){
              console.log("Push notifications are enabled!");
              OneSignal.getUserId(function(userId) {
              console.log("OneSignal User ID:", userId);
             // (Output) OneSignal User ID: 270a35cd-4dda-4b3f-b04e-41d7463a2316
             });
          }else{
               console.log("Push notifications are not enabled yet.");
               OneSignal.push(function() {
               OneSignal.showNativePrompt();
                });
              }
       });
  } else {
    // Push notifications are not supported
    console.log('Not supported');
  }
});
</script>
<?PHP


if ($company1["nonvalide"]<= $date ){

  $app_id="cf719161-1c43-4981-9810-59f56b29465c";
  $response = sendMessage($app_id,$total_points);
  $return["allresponses"] = $response;
  $return = json_encode($return);

  $data = json_decode($response, true);
  //print_r($data);
  $id = $data['id'];
  //print_r($id);

  //print("\n\nJSON received:\n");
  //print($return);
  //print("\n");
}

function sendMessage($app_id) {
    $content      = array(
        "en" => 'Votre abonnement LoyaltyCard vient de finir , Veuillez le renouvler '
    );

    $fields = array(
        'app_id' => $app_id,
        'included_segments' => array(
            'Subscribed Users'
        ),
        'data' => array(
            "foo" => "bar"
        ),
        'contents' => $content,

    );

    $fields = json_encode($fields);
  //  print("\nJSON sent:\n");
  //  print($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic ODBkMGM1MGMtNzAyZC00ZWJmLWE4MDQtMzkxMDhiYzk1NTky'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}
?>

</html>
