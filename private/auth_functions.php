<?php

  // Performs all actions necessary to log in an user
  function log_in_user($user) {
  // Renerating the ID protects the user from session fixation.
    session_regenerate_id();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['last_login'] = time();
    $_SESSION['full_name'] = $user['first_name'] . " " . $user['last_name'] ;
    $_SESSION['first_name'] = $user['first_name'];
    $_SESSION['last_name'] = $user['last_name'];
    $_SESSION['status'] = $user['status'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['number'] = $user['number'];
    $_SESSION['adress'] = $user['adress'];
    return true;
  }
  function log_in_company($company) {
    // Renerating the ID protects the user from session fixation.
      session_regenerate_id();
      $_SESSION['com_id'] = $company['id'];
      $_SESSION['user_id'] = $company['id'];
      $_SESSION['last_login'] = time();
      $_SESSION['email'] = $company['email'];
      $_SESSION['full_name'] = $company['name'];
      $_SESSION['name'] = $company['name'];
      $_SESSION['status'] = $company['status'];
      $_SESSION['uniqid'] = $company['uniqid'];
      $_SESSION['company'] = 1;

      return true;
    }

  // Performs all actions necessary to log out an admin
  function log_out_user() {
    unset($_SESSION['user_id']);
    unset($_SESSION['last_login']);
    unset($_SESSION['full_name']);
    session_destroy(); // optional: destroys the whole session
    return true;
  }


  // is_logged_in() contains all the logic for determining if a
  // request should be considered a "logged in" request or not.
  // It is the core of require_login() but it can also be called
  // on its own in other contexts (e.g. display one link if an admin
  // is logged in and display another link if they are not)
  function is_logged_in() {
    // Having a admin_id in the session serves a dual-purpose:
    // - Its presence indicates the admin is logged in.
    // - Its value tells which admin for looking up their record.
    return isset($_SESSION['user_id']);
  }

  // Call require_login() at the top of any page which needs to
  // require a valid login before granting acccess to the page.
  function require_login() {
    if(!is_logged_in()) {
      redirect_to('../ven/index.php');
    } else {
      // Do nothing, let the rest of the page proceed
    }
  }

?>
