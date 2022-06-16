<?php

class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function createUser($user, $file) {
        $userObj = new UserModel($this->conn);
        
        if($userObj->validateNewUser($user, $file)->success()) {
            if($userObj->createNewUser()->success()) {
                $this->loginUser($userObj);
            } else {
                //output errors
                // header("location:" . ROOT . "/login");
                var_dump($userObj->errors);
            }    
        } else {
            //output errors
            // header("location:" . ROOT . "/login");
            var_dump($userObj->errors);
        }
    } 

    public function verifyLoginUser($user) {
        $userObj = new UserModel($this->conn);
        
        if($userObj->validateLoginUser($user)->success()) {
            $this->loginUser($userObj);
        } else {
            //output errors
            //header("location:" . ROOT . "/login");
            var_dump($userObj->errors);
        }
    } 

    
    public function loginUser($user) {
        $_SESSION['username'] = $user->user_name;
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['role'] = $user->user_role;
        $_SESSION['logged_in'] = true;
        // send user back to homepage 
        header("location: " . ROOT);
    }

    public function getUser($username) {
        $userObj = new UserModel($this->conn);
        if($userObj->getUser($username) !== false) {
            return $userObj;
        } else {
            //output errors
            //header("location:" . ROOT . "/login");
            var_dump($userObj->errors);
        }
    }
}