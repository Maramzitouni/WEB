<?php
require_once('../private/initialize.php');
  if(!empty($_GET['tid'] && !empty($_GET['product']))) {
    $GET = filter_var_array($_GET, FILTER_SANITIZE_STRING);
    $points=$GET['price'];
    $total_points=0;
    $tid = $GET['tid'];
    $product = $GET['product'];
    $id=$GET['id'];
    $qty=$GET['qty'];

    $userID=find_user_by_id($_SESSION['user_id']);
    $userID['points'];
    //var_dump($userID['points']);
    $total_points=$points+$userID['points'];
    //var_dump($total_points);
    //var_dump($id);
    insert_points($total_points);
    $qtys=get_qty($id);
    $qty1=$qtys['product_qty']-$qty;
    update_product($qty1,$id);


  } else {
    header('Location: index.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Merci</title>
</head>
<body>
  <div class="container mt-4">
    <h2>Merci pour votre achat : <?php echo $product; ?></h2>
    <hr>
    <p>Votre transaction ID est <?php echo $tid; ?></p>
    <p>Regardez votre email pour confirmation et facture/p>
    <p><a href="../ven/index.php" class="btn btn-light mt-2">Retourner</a></p>
    <form method='get' action='../fpdf/invoice-db.php'>
		  <input type="hidden" name='product' value='<?=$product?>'>
      <input type="hidden" name='price' value='<?=$points?>'>
			<input type='submit' class="btn btn-light mt-2" value='Generer une facture'>
    </form>
  </div>
</body>
</html>
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


function sendMessage($app_id,$total_points) {
    $content      = array(
        "en" => 'Merci pour votre achat ! vous avez : '.$total_points.' points.'
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
