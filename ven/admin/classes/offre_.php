<?php
session_start();

class Offres
{

	private $con;

	function __construct()
	{
		include_once("Database.php");
		$db = new Database();
		$this->con = $db->connect();
	}




  	public function getOffres(){
      $id=$_SESSION['com_id'];
  	$q = $this->con->query("SELECT * FROM article WHERE id_ent = '$id' ");
  	$ar = [];
  	if ($q->num_rows > 0) {
  		while ($row = $q->fetch_assoc()) {
  			$ar[] = $row;
  		}
  	}
  	return ['status'=> 202, 'message'=> $ar];
  	}



		public function getCoupons(){
			$id=$_SESSION['com_id'];

		$q = $this->con->query("SELECT * FROM coupon p JOIN products c ON c.product_id = p.id_produit WHERE id_ent = '$id' ");
		$ar = [];
		if ($q->num_rows > 0) {
			while ($row = $q->fetch_assoc()) {
				$ar[] = $row;
			}
			$_DATA['coupons'] = $coupons;
		}

		$products = [];
		$q = $this->con->query("SELECT * FROM products");
		if ($q->num_rows > 0) {
			while($row = $q->fetch_assoc()){
				$products[] = $row;
			}
			//return ['status'=> 202, 'message'=> $ar];
			$_DATA['products'] = $products;
		}


		return ['status'=> 202, 'message'=> $_DATA];
		}

		public function addCoupon($name,$discount,$product_id){
			$id=$_SESSION['com_id'];

			$q = $this->con->query("SELECT * FROM coupon WHERE coupon_code = '$name' LIMIT 1");
			if ($q->num_rows > 0) {
				return ['status'=> 303, 'message'=> 'Category already exists'];
			}else{
				$q = $this->con->query("INSERT INTO coupon (coupon_code,discount,id_ent,status,id_produit) VALUES ('$name','$discount','$id','Valid','$product_id')");
				if ($q) {
					return ['status'=> 202, 'message'=> 'New Category added Successfully'];
				}else{
					return ['status'=> 303, 'message'=> 'Failed to run query'];
				}
			}
		}


  	public function addOffre($name){
      $id=$_SESSION['com_id'];

  		$q = $this->con->query("SELECT * FROM article WHERE nom = '$name' LIMIT 1");
  		if ($q->num_rows > 0) {
  			return ['status'=> 303, 'message'=> 'Category already exists'];
  		}else{
  			$q = $this->con->query("INSERT INTO article (nom,id_ent) VALUES ('$name','$id')");
  			if ($q) {
  				return ['status'=> 202, 'message'=> 'New Category added Successfully'];
  			}else{
  				return ['status'=> 303, 'message'=> 'Failed to run query'];
  			}
  		}
  	}



  	public function updateOffre($post = null){
  		extract($post);
  		if (!empty($off_id) && !empty($e_off_title)) {
  			$q = $this->con->query("UPDATE article SET nom = '$e_off_title' WHERE id_produit = '$off_id'");
  			if ($q) {
  				return ['status'=> 202, 'message'=> 'Compagnie updated'];
  			}else{
  				return ['status'=> 202, 'message'=> 'Failed to run query'];
  			}

  		}else{
  			return ['status'=> 303, 'message'=>'Invalid entreprise id'];
  		}

  	}




  	public function deleteOffre($fid = null){
  		if ($fid != null) {
  			$q = $this->con->query("DELETE FROM article WHERE id_produit = '$fid'");
  			if ($q) {
  				return ['status'=> 202, 'message'=> 'Compagnie removed'];
  			}else{
  				return ['status'=> 202, 'message'=> 'Failed to run query'];
  			}

  		}else{
  			return ['status'=> 303, 'message'=>'Invalid compagnie id'];
  		}

  	}






  }
if (isset($_POST['GET_OFFRES'])) {
$p = new Offres();
echo json_encode($p->getOffres());
exit();

}
if (isset($_POST['GET_COUPONS'])) {
$p = new Offres();
echo json_encode($p->getCoupons());
exit();

}



if (isset($_POST['add_offre'])) {
if (isset($_SESSION['com_id'])) {
	$off_title = $_POST['off_title'];
	if (!empty($off_title)) {
		$p = new Offres();
		echo json_encode($p->addOffre($off_title));
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Empty fields']);
	}
}else{
	echo json_encode(['status'=> 303, 'message'=> 'Session Error']);
}
}

if (isset($_POST['add_coupon'])) {
if (isset($_SESSION['com_id'])) {
	extract($_POST);
	$off_title = $_POST['off_title'];
	$off_discount = $_POST['off_discount'];

	if (!empty($off_title)) {
		$p = new Offres();
		echo json_encode($p->addCoupon($off_title,$off_discount,$product_id));
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Empty fields']);
	}
}else{
	echo json_encode(['status'=> 303, 'message'=> 'Session Error']);
}
}








if (isset($_POST['DELETE_OFFRE'])) {
if (!empty($_POST['fid'])) {
$p = new Offres();
	echo json_encode($p->deleteOffre($_POST['fid']));
	exit();
}else{
	echo json_encode(['status'=> 303, 'message'=> 'Invalid details']);
	exit();
}
}

if (isset($_POST['edit_offre'])) {
if (!empty($_POST['off_id'])) {
	$p = new Offres();
	echo json_encode($p->updateOffre($_POST));
	exit();
}else{
	echo json_encode(['status'=> 303, 'message'=> 'Invalid details']);
	exit();
}
}
