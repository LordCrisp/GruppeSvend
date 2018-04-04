<?php

class products {

    private $db;

    public function __construct() {
        global $db;
        $this->db = $db;
    }
    public function getLatestProducts() {
        $sql = "SELECT * FROM product WHERE deleted = 0 ORDER BY id DESC LIMIT 6";
        return $this->db->fetch_array($sql);
    }
    public function getRandomProducts() {
        $sql = "SELECT * FROM product WHERE deleted = 0 ORDER BY RAND() LIMIT 5";
        return $this->db->fetch_array($sql);
    }
}