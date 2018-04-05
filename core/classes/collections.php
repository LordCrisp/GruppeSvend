<?php

class collections {

    private $db;

    public function __construct() {
        global $db;
        $this->db = $db;
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
}