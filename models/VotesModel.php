<?php

class VoteModel extends Model {
    // public $username;
    // public $pool_id;

    function isVoted($_username, $_pool_id) {
        $sql = "SELECT * 
                FROM `votes` 
                WHERE username = ? 
                AND pool_id = ?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $_username, $_pool_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows === 0) {
            return false;
        } else {
            return true;
        }
    }

    public function createVote($_username, $_pool_id) {
        //
        $sql = "INSERT INTO votes(`username`, `pool_id`) VALUES (?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $_username, $_pool_id);
        $stmt->execute();
        var_dump($stmt); 
        if($stmt->affected_rows !== 1) {
            $this->errors['delete_err'] = "Poll was not deleted!";
            return false;
        } else {
            return true;
        }
    }

    public function deleteVotes($pool_id) {
        // echo "deleting post ". $id;
        $sql = "DELETE FROM votes WHERE pool_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $pool_id);
        $stmt->execute();
        if($stmt->affected_rows !== 1) {
            $this->errors['delete_err'] = "Poll was not deleted!";
            return false;
        } 
        return true;
        return $this;
    }

    public function success() {
        return empty($this->errors);
    }
}