<?php
require_once('../../vendor/autoload.php');
 $stripe= new \Stripe\StripeClient('sk_test_51Ii0CfEDG4YchhiElIYodaBJ4UirEpXTlJR9qxwEfI17u4oRFo39EymQwJ57P0jT8TO66SaMRzK2whYEkAOsm2Kv00Y2yAf1BV');

$price=$_POST['price'];
$ch=$_POST['ch'];

 $refunded = $stripe->refunds->create([
    'charge' => $ch,
    'amount' => $price;
  ]);

echo '<pre>';
  print_r($refunded);
echo '</pre>';
?>
