<?php
include ('navbar.php');


$query = "SELECT * FROM article";

if ($result = $bdd->query($query)) {

    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["image"];
        $field2name = $row["nom"];
        $field3name = $row["id_produit"];
        //$field4name = $row["col4"];
        //$field5name = $row["col5"];

echo $filed1name;



    }

    /* free result set */
    $result->free();
}







      ?>
