<?php

class user {

    private $db;

    public function __construct() {
        global $db;
        $this->db = $db;
    }