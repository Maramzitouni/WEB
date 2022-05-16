<?php
session_start();
/**
 *
 */
class Client
{

	private $con;

	function __construct()
	{
		include_once("Database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function getClientList(){
    $id=$_SESSION['com_id'];
		$query = $this->con->query("SELECT * FROM users WHERE id_parrain = '$id'");
		$ar = [];
		if ($query->num_rows > 0) {
			while ($row = $query->fetch_assoc()) {
				$ar[] = $row;
			}
    }
			return ['status'=> 202, 'message'=> $ar];
		}





  public function deleteClient($aid = null){
		if ($aid != null) {
			$q = $this->con->query("DELETE FROM users WHERE id = '$aid'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Admin removed'];
			}else{
				return ['status'=> 202, 'message'=> 'Failed to run query'];
			}

		}else{
			return ['status'=> 303, 'message'=>'Invalid admin id'];
		}

	}


  public function addClient($name,$email){
    $id=$_SESSION['com_id'];
    $q = $this->con->query("SELECT * FROM users WHERE email = '$name' LIMIT 1");
    if ($q->num_rows > 0) {
      return ['status'=> 303, 'message'=> 'Category already exists'];
    }else{
      $q = $this->con->query("INSERT INTO users (first_name,email,id_ent,status) VALUES ('$name','$email','$id',2)");
      if ($q) {
        return ['status'=> 202, 'message'=> 'New Category added Successfully'];
      }else{
        return ['status'=> 303, 'message'=> 'Failed to run query'];
      }
    }
  }








    public function updateClient($post = null){
      extract($post);
      if (!empty($cli_id) && !empty($e_cli_title)) {
        $q = $this->con->query("UPDATE users SET first_name = '$e_cli_title' WHERE id = '$cli_id'");
        if ($q) {
          return ['status'=> 202, 'message'=> 'client updated'];
        }else{
          return ['status'=> 202, 'message'=> 'Failed to run query'];
        }

      }else{
        return ['status'=> 303, 'message'=>'Invalid entreprise id'];
      }

    }










}


if (isset($_POST['GET_CLIENTS'])) {

	$a = new Client();
	echo json_encode($a->getClientList());


  exit();
}



if (isset($_POST['DELETE_CLIENT'])) {
	if (!empty($_POST['aid'])) {
		$p = new Client();
		echo json_encode($p->deleteClient($_POST['aid']));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Invalid details']);
		exit();
	}
}


if (isset($_POST['add_client'])) {

		$cli_title = $_POST['cli_title'];
		$cli_email = $_POST['cli_email'];
		if (!empty($cli_title) && !empty($cli_email)  ) {
			$o = new Client();
			echo json_encode($o->addClient($cli_title,$cli_email));
		}else{
			echo json_encode(['status'=> 303, 'message'=> 'Empty fields']);
		}

}
if (isset($_POST['add_email'])) {

	$fromEmail = "loyaltycard@inscription.fr";
	$toEmail = $_POST['email'];
	$subjectName = "Inscription à loyaltycard";
	$message = $_POST['lien'];
	if (!empty($toEmail) && !empty($message)  ) {
		$o = new Client();
	$to = $toEmail;
	$subject = $subjectName;
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: '.$fromEmail.'<'.$fromEmail.'>' . "\r\n".'Reply-To: '.$fromEmail."\r\n" . 'X-Mailer: PHP/' . phpversion();
	$message = '<!doctype html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport"
					content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
			<meta http-equiv="X-UA-Compatible" content="ie=edge">
			<title>Document</title>
		</head>
		<body>
		<span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">'.$message.'</span>
			<div class="container">
							 '.$message.'<br/>
									Regards<br/>
								'.$fromEmail.'
			</div>
		</body>
		</html>';
	$result = @mail($to, $subject, $message, $headers);

	echo json_encode(['status'=> 202, 'message'=> 'ok']);
}else{
	echo json_encode(['status'=> 303, 'message'=> 'Empty fields']);
}

}



if (isset($_POST['edit_client'])) {
	if (!empty($_POST['cli_id'])) {
		$o = new Client();
		echo json_encode($o->updateClient($_POST));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Invalid details']);
		exit();
	}
}




?>
