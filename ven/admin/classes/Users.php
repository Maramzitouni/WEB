<?php

/**
 *
 */
class User
{

	private $con;

	function __construct()
	{
		include_once("Database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function getUserList(){
		$query = $this->con->query("SELECT id, first_name, email, status, entreprise  FROM `users` WHERE status='2' OR status='0' ");
		$ar = [];
		if ($query->num_rows > 0) {
			while ($row = $query->fetch_assoc()) {
				$ar[] = $row;
			}
			return ['status'=> 202, 'message'=> $ar];
		}
		return ['status'=> 303, 'message'=> 'No User'];
	}
  public function deleteUser($aid = null){
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

	public function valideUser($vid = null){

    if ($vid != null) {
      $q = $this->con->query("UPDATE users SET status = 2 WHERE id = '$vid'");
      if ($q) {
        return ['status'=> 202, 'message'=> 'Compagnie updated'];
      }else{
        return ['status'=> 202, 'message'=> 'Failed to run query'];
      }

    }else{
      return ['status'=> 303, 'message'=>'Invalid entreprise id'];
    }

  }

}


if (isset($_POST['GET_USER'])) {
	$a = new User();
	echo json_encode($a->getUserList());
	exit();

}

if (isset($_POST['DELETE_USER'])) {
	if (!empty($_POST['aid'])) {
		$p = new User();
		echo json_encode($p->deleteUser($_POST['aid']));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Invalid details']);
		exit();
	}
}


if (isset($_POST['VALIDE_USER'])) {
	if (!empty($_POST['vid'])) {
		$p = new User();
		echo json_encode($p->valideUser($_POST['vid']));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Invalid details']);
		exit();
	}
}


?>
