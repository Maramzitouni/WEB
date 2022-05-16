<?php

/**
 *
 */
class Database
{

	private $con;
	public function connect(){
		$this->con = new Mysqli("loyaltimaram.mysql.db", "loyaltimaram", "52499801mZ", "loyaltimaram");
		return $this->con;
	}
}

?>
