<?php
	try
    {
        $bdd = new PDO('mysql:host=loyaltimaram.mysql.db; dbname=loyaltimaram; charset=utf8', 'loyaltimaram', '52499801mZ', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }


	$sql =  'SELECT * FROM users';
	foreach  ($bdd->query($sql) as $row) {
    var_dump($row);
}
	var_dump($_POST['pass']);
	print_r($_POST);

	$q = "INSERT INTO company(name, address, companyemail, pass) VALUES (:name, :address, :companyemail, :pass)";

$req = $bdd->prepare($q);
$req->execute([
"name" => $_POST["name"],
"address" => $_POST["address"],
"companyemail" => $_POST["companyemail"],
"pass" => $_POST["pass"]
]);

header("location:index.php");
?>
