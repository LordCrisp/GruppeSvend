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



/*-----------------------------------------------------------
------------------------ STEFFEN CODE -----------------------
--------------------------- END -----------------------------
-----------------------------------------------------------*/

        public function getUsers() {
        $sql = "SELECT user.id, user.name, user.deleted, role.name AS role, role.id FROM user JOIN role ON user.role_id = role.id";
        return $this->db->fetch_array($sql);
    }
    public function getRoles() {
        $sql = "SELECT * FROM role";
        return $this->db->fetch_array($sql);
    }
    public function saveUser() {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $params = array(
            $_POST['username'],
            $password,
            $_POST['role']
        );
            $sql = "INSERT INTO user (name, password, role_id) VALUES (?, ?, ?)";
            $this->db->query($sql, $params);
    }
}

