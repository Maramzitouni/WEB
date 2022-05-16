<?php

require_once "bdd_connect.php";

if(isset($_POST['p']) AND !empty($_POST['p'])){
 $parrain_uniqid = htmlspecialchars($_POST['p']);
 $req_parrain = $bdd->prepare('SELECT id FROM company WHERE uniqid = ?');
 $req_parrain->execute(array($parrain_uniqid));
 $parrain_exist = $req_parrain->rowCount();
 if($parrain_exist == 1) {
    $id_parrain = $req_parrain->fetch();
    $id_parrain = $id_parrain['id'];
 }
}



$q = "SELECT * FROM company WHERE companyemail = ?";
$req = $bdd->prepare($q);
$req->execute([$_POST["companyemail"]]);
if($exist = $req->fetch()) {
    header("Location: ../ven/company-inscription.php?error=Compte déja existant !");
}

$q = "INSERT INTO company(name, address, companyemail, password, status,uniqid,id_parrain) VALUES (:name, :address, :companyemail, :password, :status, :uniqid, :id_parrain)";
$req = $bdd->prepare($q);
if(isset($id_parrain) AND !empty($id_parrain)) {
$req->execute([
"name" => $_POST["name"],
"address" => $_POST["address"],
"companyemail" => $_POST["companyemail"],
"password" => $_POST["password"],
"status" => 1,
"uniqid"=>uniqid(),
"id_parrain"=>$id_parrain,
]);
}else{
  $req->execute([
  "name" => $_POST["name"],
  "address" => $_POST["address"],
  "companyemail" => $_POST["companyemail"],
  "password" => $_POST["password"],
  "status" => 1,
  "uniqid"=>uniqid(),
  "id_parrain"=>0,
  ]);
}
$_SESSION['company'] = 1;


header("location: ../ven/index.php");
?>
