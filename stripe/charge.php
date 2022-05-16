<?php

  require_once('../private/initialize.php');
  require_once('../../vendor/autoload.php');
  require_once('config/db.php');
  require_once('lib/pdo_db.php');
  require_once('models/Customer.php');
  require_once('models/Transaction.php');

  \Stripe\Stripe::setApiKey('sk_test_51Ii0CfEDG4YchhiElIYodaBJ4UirEpXTlJR9qxwEfI17u4oRFo39EymQwJ57P0jT8TO66SaMRzK2whYEkAOsm2Kv00Y2yAf1BV');

 // Sanitize POST Array
 $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

 $first_name = $POST['first_name'];
 $last_name = $POST['last_name'];
 $email = $POST['email'];
 $token = $POST['stripeToken'];

// Create Customer In Stripe
$customer = \Stripe\Customer::create(array(
  "email" => $email,
  "source" => $token
));
$prices= $_POST['price'];
$price=round($prices);
$products= $_POST['products'];
$id= $_POST['id'];
$qty= $_POST['qty'];
// Charge Customer
$charge = \Stripe\Charge::create(array(
  "amount" => $price,
  "currency" => "eur",
  "description" => $products,
  "customer" => $customer->id
));

// Customer Data
$customerData = [
  'id' => $charge->customer,
  'first_name' => $first_name,
  'last_name' => $last_name,
  'email' => $email
];

// Instantiate Customer
$customer = new Customer();

// Add Customer To DB
$customer->addCustomer($customerData);


// Transaction Data
$transactionData = [
  'id' => $charge->id,
  'customer_id' => $charge->customer,
  'product' => $charge->description,
  'amount' => $charge->amount,
  'currency' => $charge->currency,
  'status' => $charge->status,
  'user_id'=>$_SESSION['user_id']
];

// Instantiate Transaction
$transaction = new Transaction();

// Add Transaction To DB
$transaction->addTransaction($transactionData);


// Redirect to success
header('Location: success.php?tid='.$charge->id.'&product='.$charge->description.'&price='.$charge->amount.'&id='.$id.'&qty='.$qty);
