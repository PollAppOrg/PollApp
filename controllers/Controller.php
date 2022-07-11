<?php 

class Controller {
    //properties
    public $conn;
    public $req;

    // constructor
    public function __construct()
    {
        CSRF::checkToken($_POST);
    
        // bring db conn into the controller class
        $this->conn = DB::getConn();
    }
}