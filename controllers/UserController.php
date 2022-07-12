<?php

class UserController extends Controller {
    public function __construct()
    {
        CSRF::checkToken($_POST);

        parent::__construct();
    }

    public function create($user, $file) {
        $userObj = new UserModel($this->conn);
        if($userObj->validateNewUser($user, $file)->success()) {
            if($userObj->createNewUser()->success()) {
                $userObj->setLoginSession();
            } else {
                //output errors
                $errors = $userObj->errors;
                include "views/sign_up.php"; 
            }    
        } else {
            $errors = $userObj->errors;
            include "views/sign_up.php"; 
        }
    } 

    public function login($user) {
        $userObj = new UserModel($this->conn);
        
        if($userObj->validateLoginUser($user)->success()) {
            $userObj->setLoginSession();
        } else {
            $errors = $userObj->errors;
            include "views/login.php"; 
        }
    } 

    public function getUser($username) {
        $userObj = new UserModel($this->conn);
        if($userObj->checkUserExist($username) !== false) {
            return $userObj;
        } else {
            var_dump($userObj->errors);
        }
    }
}