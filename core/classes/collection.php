<?php
class collection {
	private $db;

	public function __construct() {
		global $db;
		$this->db = $db;
	}
	public function sidebarCollection() {
		$sql = "SELECT * FROM collection ORDER BY id DESC LIMIT 3";
		return $this->db->fetch_array($sql);
	}
}