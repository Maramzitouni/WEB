<?php
session_start();
/**
 *
 */
class Compagnie
{
  private $con;

	function __construct()
	{
		include_once("Database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

  public function getCompagnies(){
  $q = $this->con->query("SELECT * FROM company");
  $ar = [];
  if ($q->num_rows > 0) {
    while ($row = $q->fetch_assoc()) {
      $ar[] = $row;
    }
  }
  return ['status'=> 202, 'message'=> $ar];
  }

  public function addCompagnie($name){
    $q = $this->con->query("SELECT * FROM company WHERE name = '$name' LIMIT 1");
    if ($q->num_rows > 0) {
      return ['status'=> 303, 'message'=> 'Category already exists'];
    }else{
      $q = $this->con->query("INSERT INTO company (name) VALUES ('$name')");
      if ($q) {
        return ['status'=> 202, 'message'=> 'New Category added Successfully'];
      }else{
        return ['status'=> 303, 'message'=> 'Failed to run query'];
      }
    }
  }



  public function updateCompagnie($post = null){
    extract($post);
    if (!empty($com_id) && !empty($e_com_title)) {
      $q = $this->con->query("UPDATE company SET name = '$e_com_title' WHERE id = '$com_id'");
      if ($q) {
        return ['status'=> 202, 'message'=> 'Compagnie updated'];
      }else{
        return ['status'=> 202, 'message'=> 'Failed to run query'];
      }

    }else{
      return ['status'=> 303, 'message'=>'Invalid entreprise id'];
    }

  }




  public function deleteCompagnie($oid = null){
    if ($oid != null) {
      $q = $this->con->query("DELETE FROM company WHERE id = '$oid'");
      if ($q) {
        return ['status'=> 202, 'message'=> 'Compagnie removed'];
      }else{
        return ['status'=> 202, 'message'=> 'Failed to run query'];
      }

    }else{
      return ['status'=> 303, 'message'=>'Invalid compagnie id'];
    }

  }





	return ['status'=> 303, 'message'=> 'No compagnie'];

 }











if (isset($_POST['GET_COMPAGNIES'])) {
	$o = new Compagnie();
	echo json_encode($o->getCompagnies());
	exit();

}



if (isset($_POST['add_compagnie'])) {
	if (isset($_SESSION['user_id'])) {
		$com_title = $_POST['com_title'];
		if (!empty($com_title)) {
			$o = new Compagnie();
			echo json_encode($o->addCompagnie($com_title));
		}else{
			echo json_encode(['status'=> 303, 'message'=> 'Empty fields']);
		}
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Session Error']);
	}
}

if (isset($_POST['DELETE_COMPAGNIE'])) {
	if (!empty($_POST['oid'])) {
		$o = new Compagnie();
		echo json_encode($o->deleteCompagnie($_POST['oid']));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Invalid details']);
		exit();
	}
}

if (isset($_POST['edit_compagnie'])) {
	if (!empty($_POST['com_id'])) {
		$o = new Compagnie();
		echo json_encode($o->updateCompagnie($_POST));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Invalid details']);
		exit();
	}
}




?>
