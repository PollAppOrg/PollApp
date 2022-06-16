<?php

class UserModel extends Model {
   public $user_id;
   public $user_name;
   public $user_role = 2;
   public $user_img = "1.png";
   public $user_email;
   public $user_money;
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
      if($result->num_rows == 1) {
         $this->user = $result->fetch_assoc();
         $this->user_id = $this->user["id"];
         $this->user_name = $this->user["username"];
         $this->user_email = $this->user["email"];
         $this->user_role = $this->user["role"];
         $this->user_money = $this->user["money"];
         $this->user_password_hash = $this->user["password_hash"]; 
         $this->user_img = $this->user["img"];
         return $this;
      } else {
         return false;
      }
   }

   public function validateNewUser($user, $file) {
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

      $this->user_img = $this->validateFile($file);
      if($this->user_img === false) {
         $this->errors['image_err'] = true;
         $this->user_img = "1.png";
      }

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

      if(!password_verify($this->user_password, $this->user_password_hash)) {
         $this->errors['password_err'] = "Password is wrong";
      }    

      return $this;
   }

   public function validateFile($file) {
      // validate file
      $errors = [];
      if($file['error'] === 0) {
         // check size is less than 5mb
         if($file['size'] > 5000000) {
            $errors['size'] = "File is too large!";
         }
         // check file ext is allowed
         $allowed_ext = ["png", "jpg", "jpeg", "gif"];
         $file_ext = explode("/", $file['type']);
         $file_ext = end($file_ext);
         if(!in_array(strtolower($file_ext), $allowed_ext)) {
            $errors['type'] = "Only images may be uploaded!";
         }
         // if there are no errors, rename file and move it
         if(empty($errors)) {
            // rename file
            $new_name = uniqid("wedding_") . "." . $file_ext;
            $dest_1 =  "images/" . $new_name;
            $dest_2 = "./public/" . $dest_1;
            // move to images/
            if(move_uploaded_file($file['tmp_name'], $dest_2)) {
               return $dest_1;
            } else {
               return false;
            }
         } else {
            return false;
         }
      } else {
          return false;
      }
   }

   public function success() {
      return empty($this->errors);
   }
}