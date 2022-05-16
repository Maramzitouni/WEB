<?php

include 'menu.php';
require_once('../private/initialize.php');
$sql = "SELECT * FROM categories";
 $cat = mysqli_query($db,$sql);

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="shortcut icon" href="/images/EWU.ico" type="image/x-icon" />
    <!--<link rel="stylesheet" href="css/add.css">-->
    <meta charset="utf-8">
    <title></title>
    <script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
  </head>
  <body>
    <div class="container" style="padding-top : 20px;">


    <div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Catégories
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <?php

                   while ($category = mysqli_fetch_array(
$cat,MYSQLI_ASSOC)):;
               ?>
    <a class="dropdown-item" value="<?php echo $category['cat_id'];?>"><?php echo $category["cat_title"]; ?></a>
    <?php
        endwhile;
        // While loop must be terminated
    ?>
  </div>
</div>
</div>
<div class="container">


  <div class="row">

<canvas id="achat" style="width: 20%;max-width:500px"></canvas>
<canvas id="cat" style="width: 20%;max-width:500px"></canvas>
<div class="col-4">


<script>
var xValues = [<?php
                      dateof_transactions();
                ?>];
var yValues = [<?php
                      nbof_transactions();
                ?>];


new Chart("achat", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "#0C79A1",
      borderColor:" rgba(0, 129, 175,0.6)",
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Achats par jours"
    }
  }
});
</script>
</div>


<div class="col-4">


<script>
var xValues =[<?php

  // echo get_catp();
   get_allcat();
 ?>];
var yValues = [55, 79, 44];
var barColors = [
  "#fc440f",
  "#4ecdc4",
//  "#1f01b9",
  //"#b4e33d",
  "#c04cfd"
];

new Chart("cat", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Achats par catégories"
    }
  }
});
</script>
</div>
</div>
</div>
<div class="container">

  <div class="row">



<canvas id="success" style="width: 20%;max-width:500px"></canvas>
<canvas id="test" style="width: 20%;max-width:500px"></canvas>
<div class="col-4">


  <script>
  var xValues = [<?php
                        dateof_transactions();
                  ?>];
  var yValues = [<?php
                        nbof_transactions();
                  ?>];
  var barColors = "gold";

          new Chart("success", {
            type: "bar",
            data: {
              labels: xValues,
              datasets: [{
                backgroundColor: barColors,
                data: yValues
              }]
            },
            options: {
              legend: {display: false},
              title: {
                display: true,
                text: "Achats par jours"
              }
            }
          });
  </script>
</div>
<div class="col-4">


<script>
var xValues = [<?php
                      all_product();
                ?>];
var yValues = [<?php
                      nbof_product();
                ?>];
var barColors = [
  "#26532b",
  "#399e5a",
  "#5abcb9",
  "#63e2c6",
  "#6ef9f5",
  "#96FBF7"
];

new Chart("test", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Catégories"
    }
  }
});
</script>
</div>
</div>
</div>

<script>
  var ajax = new XMLHttpRequest();
  var method = "GET";
  var url = "../private/query_functions.php";
  var asynchronous = true;
  ajax.open(method, url, asynchronous);
  ajax.send();

  ajax.onreadystatechange = function dateof_test(){
    if (this.readyState == 4 && this.status == 200) {

      var data = JSON.parse(this.responseText);
      console.log(data);
    }
  }
</script>

  </body>
</html>
