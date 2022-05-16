<?php

require_once "bdd_connect.php";

$q = "UPDATE company SET CA = ? WHERE id = ?";
$req = $bdd->prepare($q);
$req->execute([floatval($_POST["CA"]), intval($_POST["com_id"])]);

header("location:../ven/account-company.php");
?>
