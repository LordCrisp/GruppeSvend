<?php

class user {

    private $db;

    public function __construct() {
	    global $db;
	    $this->db = $db;
    }


/*-----------------------------------------------------------
------------------------ STEFFEN CODE -----------------------
-------------------------- START ----------------------------
-----------------------------------------------------------*/

	public function fetch_retailer($id) {

		$params = [$id];
		$sql = "SELECT * FROM user WHERE id = ?";
		$row = $this->db->fetch_array($sql, $params);
		$row = call_user_func_array('array_merge', $row);

		$this->name = $row['name'];
		$this->address = $row['address'];
	}

	public function retail_address($address, $id) {
		$params = [$address, $id];
		$sql = "UPDATE user
				SET address = ? 
				WHERE id = ?";
		$this->db->query($sql, $params);
	}

}

/*-----------------------------------------------------------
------------------------ STEFFEN CODE -----------------------
--------------------------- END -----------------------------
-----------------------------------------------------------*/