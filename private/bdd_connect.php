<?php

require_once "db_credentials.php";

try
{
    $bdd = new PDO('mysql:host=' . DB_SERVER . '; dbname=' . DB_NAME . '; charset=utf8', DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
