<?php

  // Subjects


  // users

  // Find all users, ordered last_name, first_name
  function find_all_users() {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "ORDER BY last_name ASC, first_name ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_user_by_id($id) {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $user; // returns an assoc. array
  }
  function find_product_by_id($id) {
    global $db;

    $sql = "SELECT * FROM products ";
    $sql .= "WHERE product_id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $product = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $product; // returns an assoc. array
  }


    function find_orders($id) {
      global $db;

      $sql = "SELECT * FROM transactions ";
      $sql .= "WHERE user_id='" . db_escape($db, $id) . "' ";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);

      return $result; // returns an assoc. array
    }


    function find_all_offres() {
      global $db;
      $sql = "SELECT * FROM article ";
      $sql .= "WHERE id_produit='25'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
    }
    function find_promo() {
      global $db;
      $sql = "SELECT * FROM coupon ";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);

      return $result; // returns an assoc. array
    }





  function find_user_by_username($username) {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $user; // returns an assoc. array
  }

  function find_user_by_email($email) {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE email='" . db_escape($db, $email) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $user; // returns an assoc. array
  }

  function validate_user($user) {

    if(is_blank($user['first_name'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($user['first_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }

    if(is_blank($user['last_name'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($user['last_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }

    if(is_blank($user['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_length($user['email'], array('max' => 255))) {
      $errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($user['email'])) {
      $errors[] = "Email must be a valid format.";
    }
    if(is_blank($user['password'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_length($user['email'], array('max' => 255))) {
      $errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($user['email'])) {
      $errors[] = "Email must be a valid format.";
    }

    /*if(is_blank($user['username'])) {
      $errors[] = "Username cannot be blank.";
    } elseif (!has_length($user['username'], array('min' => 8, 'max' => 255))) {
      $errors[] = "Username must be between 8 and 255 characters.";
    } elseif (!has_unique_username($user['username'], $user['id'] ?? 0)) {
      $errors[] = "Username not allowed. Try another.";
    }*/

    if(is_blank($user['entreprise'])) {
      $errors[] = "Entreprise cannot be blank.";
    } elseif (!has_length($user['entreprise'], array('max' => 255))) {
      $errors[] = "entreprise must be less than 255 characters.";
    } elseif (!has_valid_email_format($user['email'])) {
      $errors[] = "Entreprise must be a valid format.";
    }

    /*if(is_blank($user['confirm_password'])) {
      $errors[] = "Confirm password cannot be blank.";
    } elseif ($user['password'] !== $user['confirm_password']) {
      $errors[] = "Password and confirm password must match.";
    }*/

    return $errors;
  }

  function insert_user($user) {
    global $db;

    $errors = validate_user($user);
    if (!empty($errors)) {
      return $errors;
    }

    $hashed_password = password_hash($user['password'], PASSWORD_BCRYPT);


    $sql = "INSERT INTO users ";
    $sql .= "(first_name, last_name, email, username, entreprise ,hashed_password ,id_parrain) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $user['first_name']) . "',";
    $sql .= "'" . db_escape($db, $user['last_name']) . "',";
    $sql .= "'" . db_escape($db, $user['email']) . "',";
    $sql .= "'" . db_escape($db, $user['username']) . "',";
    $sql .= "'" . db_escape($db, $user['entreprise']) . "',";
    $sql .= "'" . db_escape($db, $hashed_password) . "',";
    $sql .= "'" . db_escape($db,$user['id_parrain']) . "'";

    $sql .= ")";
    $result = mysqli_query($db, $sql);

    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_user($user) {
    global $db;

  /*  $errors = validate_user($user);
    if (!empty($errors)) {
      return $errors;
    } */

    $hashed_password = password_hash($user['password'], PASSWORD_BCRYPT);

    $sql = "UPDATE users SET ";
    $sql .= "first_name='" . db_escape($db, $user['first_name']) . "', ";
    $sql .= "last_name='" . db_escape($db, $user['last_name']) . "', ";
    $sql .= "email='" . db_escape($db, $user['email']) . "', ";
    $sql .= "adress='" . db_escape($db, $user['adress']) . "', ";
    $sql .= "number='" . db_escape($db, $user['number']) . "', ";
    $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "',";
    $sql .= "username='" . db_escape($db, $user['username']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $_SESSION['user_id']) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function delete_user($user) {
    global $db;

    $sql = "DELETE FROM users ";
    $sql .= "WHERE id='" . db_escape($db, $user['id']) . "' ";
    $sql .= "LIMIT 1;";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }



  function cancel_orders($id) {
    global $db;

    $sql = "UPDATE transactions SET ";
    $sql .= "status='canceled' ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
  function rem_orders($id) {
    global $db;

    $sql = "UPDATE transactions SET ";
    $sql .= "status='refunded' ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }




  function insert_points($points) {
    global $db;

    $sql = "UPDATE users SET ";
    $sql .= "points='" . db_escape($db, $points) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $_SESSION['user_id']) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
  function insert_article($article) {
      global $db;



      $sql = "INSERT INTO article ";
      $sql .= "(nom, description, image, prix ,id_ent) ";
      $sql .= "VALUES (";
      $sql .= "'" . db_escape($db, $article['nom']) . "',";
      $sql .= "'" . db_escape($db, $article['description']) . "',";
      $sql .= "'" . db_escape($db, $article['image']) . "',";
      $sql .= "'" . db_escape($db, $article['prix']) . "',";
      $sql .= "'" . db_escape($db, $article['id_ent']) . "'";
      $sql .= ")";
      $result = mysqli_query($db, $sql);





      // For INSERT statements, $result is true/false
      if($result) {
        return true;
      } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
      }
    }

    function insert_reduction($reduction) {
      global $db;




      $sql = "INSERT INTO reduction ";
      $sql .= "(promo) ";
      $sql .= "VALUES (";
      $sql .= "'" . db_escape($db, $reduction['promo']) . "'";
      $sql .= ")";
      $result = mysqli_query($db, $sql);

      // For INSERT statements, $result is true/false
      if($result) {
        return true;
      } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
      }
    }

    function show_article(){
      global $db;

      $sql = "SELECT * FROM article ";
      $result = mysqli_query($db, $sql);

      echo "<h1>"."Articles proposés"."</h1>";

      while ($row = mysqli_fetch_array($result)) {

        $image=$row['image'];
        echo "<tr>";
        echo "<td>" . $row['Nom'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['prix'] . "</td>";
        echo "<img src ='../ven/product_images/<?=$image?>'";
        echo "</tr>";
      }

    }

    function get_allcat(){
      global $db;

      $sql = "SELECT * FROM categories";
      $result = mysqli_query($db, $sql);

      $i = NULL;

      while($row = mysqli_fetch_array($result)){


      $name= $row['cat_title'];
      if ($i== NULL) {

        $tab_name = array($name);
      }else{

        array_push($tab_name, $name);
      }
      $i+=1;

    }
    echo "'". implode("','", $tab_name). "'";
  }


function get_catp(){
  global $db;

  $sql = "SELECT * FROM products";
  $result = mysqli_query($db, $sql);
  $con = "SELECT * FROM categories";
  $result_c = mysqli_query($db, $con);
  $i_c = NULL;
  $i_p = NULL;
  $nb = 0;
  while($row_c = mysqli_fetch_array($result_c)){

  $c_id= $row_c['cat_id'];
  $c_name= $row_c['cat_title'];
  if ($i_c == NULL) {
    $tabc_id = array($c_id );
    $tabc_name = array($c_name);
  }else{
    array_push($tabc_id, $c_id);
    array_push($tabc_name, $c_name);
  }
  $i_c+=1;

}
$size_c = count($tabc_id);
  while ($row = mysqli_fetch_array($result)) {
    $p_qty= $row['product_qty'];
    $p_name = $row['product_title'];
    $p_nb = $row['product_cat'];

    if ($i_p == NULL) {
      $tabp_qty = array($p_qty );
      $tabp_name = array($p_name);
      $tabp_nb = array($p_nb);
      while($nb< $size_c ){
          if ($tabp_nb[0]==$tabc_id[$nb]) {
            $cat = array( $tabc_name[$nb] );
            $nb=0;
          }
          $nb+=1;
        }

    }else{
      array_push($tabp_qty, $p_qty);
      array_push($tabp_name, $p_name);
      array_push($tabp_nb, $p_nb);
      while($nb< $size_c){
          if ($tabp_nb[$i_p]==$tabc_id[$nb]) {
            array_push($cat, $tabc_name[$nb]);
            $nb=0;
          }
        $nb+=1;
    }
    $i_p+=1;

  }

  //echo "<br>"."'". implode("','", $tabc_name). "'";
  //echo "<br>"."'". implode("','", $tabp_name). "'";
  echo "<br>"."'". implode("','", $cat). "'";


}
}

function get_allproduct(){
  global $db;

  $sql = "SELECT * FROM products";
  $result = mysqli_query($db, $sql);

  $i = NULL;

  while($row = mysqli_fetch_array($result)){


  $name= $row['product_title'];
  if ($i== NULL) {

    $tab_name = array($name);
  }else{

    array_push($tab_name, $name);
  }
  $i+=1;

}
echo "'". implode("','", $tab_name). "'";
}

function get_qty($id){
  global $db;

  $sql = "SELECT * FROM products ";
  $sql .= "WHERE product_id='" . db_escape($db, $id) . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $qtys = mysqli_fetch_assoc($result); // find first
  mysqli_free_result($result);
  return $qtys; // returns an assoc. array

}






function update_product($qty,$id){
  global $db;


  $sql = "UPDATE products SET ";
  $sql .= "product_qty='" . db_escape($db, $qty) . "' ";
  $sql .= "WHERE product_id='" . db_escape($db, $id) . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);

  // For UPDATE statements, $result is true/false
  if($result) {
    return true;
  } else {
    // UPDATE failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }


}

    function show_offret(){
      global $db;

      $sql = "SELECT * FROM article ";
      $result = mysqli_query($db, $sql);



      while ($row = mysqli_fetch_array($result)) {

        $image=$row['image'];
        $nom=$row['Nom'];
        $desc=$row['description'];
        $prix=$row['prix'] ;

        echo "
          <div class='card'>
            <img src='../ven/product_images/".$image."'class='card-img-top' alt='...'>
            <div class='card-body'>";

            echo "<h5 class='card-title'>" .$row['nom'] ."</h5>";
              echo "<p class='card-text'>". $row['description'] . "</p>";
            echo  "<p class='card-text'><small class='text-muted'>" .$row['prix']." </small></p>
            </div>
          </div>";
          //echo $row['image'];
          //echo $image;



      }

    }





    function find_company_by_email($email) {
      require_once("bdd_connect.php");
      $querry = "SELECT * FROM company WHERE companyemail = :email LIMIT 1";
      $req = $bdd->prepare($querry);
      $req->execute(['email' => $email]);
      $company = $req->fetch();
      return $company; // returns an assoc. array
  }



  function dateof_transactions(){
    global $db;

    $sql = "SELECT * FROM transactions ORDER BY created_at ASC";
    $result = mysqli_query($db, $sql);

    $i=NULL;

    while ($row = mysqli_fetch_array($result)) {

      $date = date('d-m-Y', strtotime($row['created_at']));

      if ($i != NULL) {
        if ($i != $date) {

          array_push($cont, $date);


        }
      }else {
      $cont = array($date );
      }

      $i = $date;
    }
  // $nb= count($cont);
  // echo $nb;
    //print_r($cont);
   for ($j=0; $j < $nb ; $j++) {
      echo $cont[$j];
      if ($j < $nb-1) {
        echo ",";
      }
    }
  echo "'". implode("','", $cont). "'";


  }

  function dateof_test(){
    global $db;

    $sql = "SELECT * FROM transactions ORDER BY created_at ASC";
    $result = mysqli_query($db, $sql);
    $sql_p = "SELECT * FROM products";
    $result_p = mysqli_query($db, $sql_p);

    $i=NULL;
    $nbof=1;
      while ($row = mysqli_fetch_array($result)) {
          $product = $row['product'];
          if ($i== NULL) {
            $tab = array($product);
            $i+=1;
          }else {
            array_push($tab, $product);
          }

    }

  $tab_2=  array_count_values($tab);
    
//  echo "'". implode("','", $cont). "'";
echo json_encode($tab_2);


  }

  function nbof_transactions(){
    global $db;

    $sql = "SELECT * FROM transactions ORDER BY created_at ASC";
    $result = mysqli_query($db, $sql);

    $i=NULL;
    $nbof=1;
    while ($row = mysqli_fetch_array($result)) {

      $date = date('d-m-Y', strtotime($row['created_at']));

      if ($i != NULL) {
        if ($i == $date) {
          $nbof+=1;
        }else {

          array_push($tab, $nbof);
          $nbof = 1;

        }
      }else {
      $tab = array($nbof );
      }

      $i = $date;
    }

  echo "'". implode("','", $tab). "'";


  }



 function nbof_product(){
    global $db;

    $sql = "SELECT * FROM transactions ORDER BY created_at ASC";
    $result = mysqli_query($db, $sql);
    $sql_p = "SELECT * FROM products";
    $result_p = mysqli_query($db, $sql_p);

    $i=NULL;
    $nbof=1;
      while ($row = mysqli_fetch_array($result)) {
          $product = $row['product'];
          if ($i== NULL) {
            $tab = array($product);
            $i+=1;
          }else {
            array_push($tab, $product);
          }

    }

  $tab_2=  array_count_values($tab);
    echo "'". implode("','", $tab_2). "'";
  }

  function all_product(){
     global $db;

     $sql = "SELECT * FROM transactions ORDER BY created_at ASC";
     $result = mysqli_query($db, $sql);
     $sql_p = "SELECT * FROM products";
     $result_p = mysqli_query($db, $sql_p);

     $i=NULL;

       while ($row = mysqli_fetch_array($result)) {
           $product = $row['product'];
           if ($i== NULL) {
             $tab = array($product);
             $i+=1;
           }else {
             array_push($tab, $product);
           }

     }

     $tab_2=  array_count_values($tab);
     $tab_3 = array_keys($tab_2);

     echo "'". implode("','", $tab_3). "'";
   }



   function test(){
     global $db;

     $sql = "SELECT * FROM transactions ORDER BY created_at ASC";
     $result = mysqli_query($db, $sql);
     $sql_p = "SELECT * FROM products";
     $result_p = mysqli_query($db, $sql_p);

     $i=NULL;

       while ($row = mysqli_fetch_array($result)) {
           $product = $row['product'];
           if ($i== NULL) {
             $tab = array($product);
             $i+=1;
           }else {
             array_push($tab, $product);
           }

     }
     $nbof=count($tab);
     for ($i=0; $i < $nbof ; $i++) {
        $test =implode($tab[$i]);
        print_r(explode(',', $test));
     }
   }

   function nbof_qty(){
     global $db;

     $sql = "SELECT * FROM products";
     $result = mysqli_query($db, $sql);
     $i = NULL;
     $ini = 0;
     $ini_2 = 0;
     $nb = 0;
     $tab_count = [];
     $re=0;

     while($row = mysqli_fetch_array($result)){

         $qty= $row['product_qty'];

         if ($i == NULL) {
           $tab = array($qty );

         }else{
           array_push($tab, $qty);

         }
         $i+=1;

       }

       if($ini == 0 ){

        $tab_ini = $tab;
        $ini +=1;

      }

$count = count($tab);
if ($ini_2 == 0) {
  $count_2 = $count;
}
for ($k=0; $k < $count ; $k++) {
  if ($count_2 < $count) {
    $re = 0 ;
    $count_2 = $count;
  }
  if ($re == 0) {
      $tab_count = array($k => 0 );
      $re++;
  }
  $show = count($tab_count);
  if ($show < $count) {
    array_push($tab_count,0);
  }

}

    for ($j=0; $j < $count ; $j++) {

      if ($tab_ini[$j]> $tab[$j]) {

        $tab_count[$j]= $tab_count[$j]+1;
        $tab_ini[$j]= $tab[$j];
      }

    }



     //echo "<br>"."'". implode("','", $tabc_name). "'";
     //echo "<br>"."'". implode("','", $tabp_name). "'";
  //   echo "'". implode("','", $tab_count). "'";
     echo "'". implode("','", $tab_ini). "'";
    // var_dump($tab_count);
   }

?>
