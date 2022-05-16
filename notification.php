<?PHP

if (isset ($_POST["send_all"])){
if (isset ($_SESSION['company']))
  $points=$_POST['points'];
  $app_id=$_POST['app_id'];
  $response = sendMessage($app_id,$points);
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
if (isset($_POST['send_by_id'])){
  $app_id=$_POST['app_id'];
  $user_id=$_POST['user_id'];
  $heading=$_POST['heading'];
  $message=$_POST['message'];
  $response = sendByPlayerId($app_id,$user_id);
  $return["allresponses"] = $response;
  $return = json_encode($return);

}

function sendMessage($app_id,$points) {
    $content      = array(
        "en" => 'Ne Oubliez pas de bien payer votre cotisation ! vous avez : '.$points.' points.'
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





    function sendByPlayerId($app_id,$user_id){
        $content = array(
            "en" => 'English Message'
            );

        $fields = array(
            'app_id' => $app_id,
            'include_player_ids' => array($user_id),
            'data' => array("foo" => "bar"),
            'contents' => $content
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    $response = sendMessage();
    $return["allresponses"] = $response;
    $return = json_encode( $return);

    print("\n\nJSON received:\n");
    print($return);
    print("\n");
?>


?>
