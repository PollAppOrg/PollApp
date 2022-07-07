<?php

class VoteModel extends Model {
    // public $user_id;
    // public $pool_id;
    public $voteds;

    function fetchVotes($_user_id) {
        $sql = "SELECT * 
                FROM `votes` 
                WHERE user_id = ?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $_user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        // var_dump($_user_id);
        if($result->num_rows === 0) {
            $this->errors['fetch_err'] = "Couldn't retrieve resource!";
        } else {
            $this->voteds = $result->fetch_all(MYSQLI_ASSOC);
        }
        return $this;
    }

    function isVoted($_user_id, $_pool_id) {
        $sql = "SELECT * 
                FROM `votes` 
                WHERE user_id = ? 
                AND pool_id = ?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $_user_id, $_pool_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows === 0) {
            return false;
        } else {
            return true;
        }
    }

    public function createVote($_user_id, $_pool_id) {
        //
        $sql = "INSERT INTO votes(`user_id`, `pool_id`) VALUES (?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $_user_id, $_pool_id);
        $stmt->execute();
        // var_dump($stmt); 
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