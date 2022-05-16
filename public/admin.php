<?php include ('menu.php') ;



if(is_post_request()) {

  $user['first_name'] = $_POST['first_name2'] ?? '';
  $user['last_name'] = $_POST['last_name2'] ?? '';
  $user['email'] = $_POST['email2'] ?? '';
  $user['username'] = $_POST['username2'] ?? '';
  $user['password'] = $_POST['password2'] ?? '';
  /*$user['confirm_password'] = $_POST['confirm_password'] ?? '';*/

  $result = update_user($user);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    $_SESSION['message'] = 'user created.';
    $user['id']=$new_id;
    log_in_user($user);
    /*redirect_to(url_for('index.php?id=' . $new_id));*/
    redirect_to(url_for('account.php'));
  } else {
    $errors = $result;
  }

} else {
  // display the blank form
  $user = [];
  $user["first_name"] = '';
  $user["last_name"] = '';
  $user["email"] = '';
  $user["username"] = '';
  $user['password'] = '';
  $user['confirm_password'] = '';

}

?>









?>
<link rel="stylesheet" type="text/css" href="css/sidebar1.css">

<div class="sidebar">
   <h1>Brand</h1>
   <a href="">Home</a>
   <a href="">About</a>
   <a href="">Portfolio</a>
   <a href="">Gallery</a>
   <a href="">Service</a>
   <a href="">Join</a>
   <a href="">Contact</a>
</div>









  </div>

</main>






















      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
  </body>
</html>
