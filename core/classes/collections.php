<?php

class collections {

    private $db;

    public function __construct() {
        global $db;
        $this->db = $db;
    }
    public function getCollection($id) {
        $sql = "SELECT * FROM collection WHERE id = $id";
        $row = $this->db->fetch_array($sql);

	    if (count($row)){
		    $row = call_user_func_array('array_merge', $row);

		    $this->id = $row['id'];
		    $this->name = $row['name'];
		    $this->thumbnail = $row['thumbnail'];
	    }
    }
    public function getCollections() {
        $sql = "SELECT * FROM collection";
        return $this->db->fetch_array($sql);
    }
    public function getLatestCollections() {
        $sql = "SELECT * FROM collection WHERE deleted = 0 ORDER BY created_at DESC LIMIT 6";
        return $this->db->fetch_array($sql);
    }
    public function getRandomCollections() {
        $sql = "SELECT * FROM collection WHERE deleted = 0 ORDER BY RAND() LIMIT 5";
        return $this->db->fetch_array($sql);
    }

	public function sidebarCollection() {
		$sql = "SELECT * FROM collection ORDER BY id DESC LIMIT 3";
		return $this->db->fetch_array($sql);
	}
}