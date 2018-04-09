<?php

class products {

    private $db;

    public function __construct() {
        global $db;
        $this->db = $db;
    }
    public function getProduct($id) {
        $params = array(
            $id
        );
        $sql = "SELECT * FROM product WHERE id = ?";
        return $this->db->fetch_array($sql, $params);
    }
    public function getProducts() {
        $sql = "SELECT * FROM product";
        return $this->db->fetch_array($sql);
    }
    public function getLatestProducts() {
        $sql = "SELECT * FROM product WHERE deleted = 0 ORDER BY created_at DESC LIMIT 6";
        return $this->db->fetch_array($sql);
    }
    public function getRandomProducts() {
        $sql = "SELECT * FROM product WHERE deleted = 0 ORDER BY RAND() LIMIT 5";
        return $this->db->fetch_array($sql);
    }
    public function getCollectionProducts($collection, $category) {
        $params = array(
            $collection,
            $category
        );
        $sql = "SELECT * FROM product WHERE collection_id = ? AND category_id = ?";
        return $this->db->fetch_array($sql, $params);
    }
}