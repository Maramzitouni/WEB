<?php
 include ('menu.php') ;
 require_once('../private/initialize.php');

?>
<body >
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<br>
<h1> Nos Offres : </h1>
<br>
<div class='card-group'>
  <?php
    echo show_offret();
 ?>

</div>

</table>
</body>
