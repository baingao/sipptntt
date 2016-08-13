<?php

class DbConnect {

    private $conn;

    function __construct() {
        
    }

    function connect() {
        include_once dirname(__FILE__) . '/config.php';
        $this->conn = new pdo("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USERNAME, DB_PASSWORD);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        return $this->conn;
    }

    function getLastInsertId() {
        return $this->conn->lastInsertId();
    }

    function getTotalRows() {
        $stmt = $this->conn->query("select FOUND_ROWS() as total");
        $stmt->execute();
        $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        return $total;
    }

}
