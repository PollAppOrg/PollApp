<?php 

class Model {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
}