<?php
/*
 * DB Configuration with credentials
 * Should be ignored from any Git services
 */
class db_conf extends db {
    function __construct() {
        $this->dbhost = "localhost";
        $this->dbuser = "admin";
        $this->dbpassword = "admin";
        $this->dbname = "_template";
        $db = parent::connect();
    }
}