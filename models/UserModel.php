<?php

class UserModel extends Model {
   public $user_id;
   public $user_name;
   public $user_role = 2;
   private $user_img = "1.png";
   private $user_email;
   private $user_password_hash;
   private $user_password;
   private $user_password_confirm;
   private $user = [];
   private $users = [];
   public $errors = [];

   public function createNewUser() {
      $this->user_password_hash = password_hash($this->user_password, PASSWORD_DEFAULT);
      $sql = "INSERT INTO users (username, email, password_hash, img) VALUES (?, ?, ?, ?)";
      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param("ssss", $this->user_name, $this->user_email, $this->user_password_hash, $this->user_img);
      $stmt->execute();
      if($stmt->affected_rows == 1) {
         $this->user_id = $stmt->insert_id;
      } else {
         $this->errors['insert_user_err'] = true;
      }

      return $this;
   }

   public function getUser($username) {
      $sql = "SELECT * 
            FROM users
            WHERE username = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $result = $stmt->get_result();
      var_dump($result);
      if($result->num_rows == 1) {
         $this->user = $result->fetch_assoc();
         $this->user_id = $this->user["id"];
         $this->user_name = $this->user["username"];
         $this->user_role = $this->user["role"];
         $this->user_password_hash = $this->user["password_hash"]; 
         return $this;
      } else {
         return false;
      }
   }

   public function validateNewUser($user) {
      $this->user_name = htmlspecialchars($user['username']);
      $this->user_email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
      $this->user_password = htmlspecialchars($user['password']);
      $this->user_password_confirm = htmlspecialchars($user['password_confirm']);
   
      // check username > 5 chars
      if(strlen($this->user_name) <  2 || empty($this->user_name)) {
         $this->errors['username_err'] = true;
      }
      // check email is valid
      if(!filter_var($this->user_email, FILTER_VALIDATE_EMAIL)) {
         $this->errors['email_err'] = true;
      }
      // check password > 5 chars
      if(strlen($this->user_password) < 5) {
         $this->errors['password_err'] = true;
      }
      // check password a = password b
      if($this->user_password != $this->user_password_confirm) {
         $this->errors['password_confirm_err'] = true;
      }

      //validate file

      return $this;
   }

   public function validateLoginUser($user) {
      $this->user_name = htmlspecialchars($user['username']);
      $this->user_password = htmlspecialchars($user['password']);

      if(strlen($this->user_name) <  2 || empty($this->user_name)) {
         $this->errors['username_err'] = true;
      }
      // check password > 5 chars
      if(strlen($this->user_password) < 5) {
         $this->errors['password_err'] = true;
      }

      if($this->getUser($user['username']) === false) {
         $this->errors['user_err'] = "User not found";
      }

      var_dump($this->user_password, $this->user_password_hash, password_verify($this->user_password, $this->user_password_hash));
      if(!password_verify($this->user_password, $this->user_password_hash)) {
         $this->errors['password_err'] = "Password is wrong";
      }    

      return $this;
   }

   public function success() {
      return empty($this->errors);
   }
}