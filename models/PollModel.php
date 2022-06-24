<?php

class PollModel extends Model {
    public $poll_id;
    private $poll_title;
    private $poll_desc;
    private $poll_option1;
    private $poll_option2;
    private $poll_author_id;
    private $poll_vote;
    public $poll = [];
    private $polls = [];
    public $errors = [];

    public function fetchPolls() {
        $sql = "SELECT polls.*, username
                FROM polls
                JOIN users ON users.id = polls.author_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows === 0) {
            $this->errors['fetch_err'] = "Couldn't retrieve resource!";
        } else {
            $this->polls = $result->fetch_all(MYSQLI_ASSOC);
        }
        return $this;
    }

    public function fetchPoll($id) {
        $this->poll_id = $id;
        $sql = "SELECT polls.*, username
                FROM polls
                JOIN users ON users.id = polls.author_id
                WHERE polls.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $this->poll_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows !== 1) {
            $this->errors['fetch_err'] = "Couldn't retrieve resource!";
        } else {
            $this->poll = $result->fetch_assoc();
        }
        return $this;
    }

    public function getPoll() {
        return $this->poll;
    }

    public function getPolls() {
        return $this->polls;
    }

    public function createNewPoll() {
        $sql = "INSERT INTO polls (title, description, author_id, option_1,option_2) 
                VALUES (?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssiss", $this->poll_title, $this->poll_desc, $this->poll_author_id, $this->poll_option1, $this->poll_option2);
        $stmt->execute();
        if($stmt->affected_rows !== 1) {
            $this->errors['insert_err'] = "Poll was not created!";
        } else {
            $this->poll_id = $stmt->insert_id;
        }
        return $this;
    }

    public function validatePoll($poll) {
        $this->poll_title = htmlspecialchars($poll['pTitle']);
        $this->poll_desc = htmlspecialchars($poll['pDesc']);
        $this->poll_author_id = $_SESSION['user_id'];
        $this->poll_option1 = htmlspecialchars($poll['pOption1']);
        $this->poll_option2 = htmlspecialchars($poll['pOption2']);
        
        if(empty($this->poll_title) || empty($this->poll_option2) || empty($this->poll_option1)) {
            $this->errors['poll_form_err'] = "New poll fields cannot be empty!";
        }
        return $this;
    }

    public function vote($poll) {
        $this->poll_vote = $poll['option'];
        $this->poll_id = $poll['id'];
        $vote = "vote_" . $this->poll_vote;

        $sql = "UPDATE polls 
                SET {$vote} = {$vote} + 1
                WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $this->poll_id);
        $stmt->execute();
        if($stmt->affected_rows !== 1) {
            $this->errors['vote_err'] = "Vote failed!";
        } else {
            $this->poll_id = $stmt->insert_id;
        }
        return $this;
    }

    public function update($poll) {
        var_dump($poll);
        $this->poll_title = htmlspecialchars($poll['title']);
        $this->poll_desc = htmlspecialchars($poll['desc']);
        $this->poll_option1 = htmlspecialchars($poll['option1']);
        $this->poll_option2 = htmlspecialchars($poll['option2']);
        $this->poll_id = $poll['id'];

        $sql = "UPDATE polls 
                SET title = ?, description = ?, option_1 = ?, option_2 = ?
                WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssi", $this->poll_title, $this->poll_desc, $this->poll_option1, $this->poll_option2, $this->poll_id);
        $stmt->execute();
        if($stmt->affected_rows !== 1) {
            $this->errors['vote_err'] = "Vote failed!";
        } else {
            $this->poll_id = $stmt->insert_id;
        }
        return $this;
    }

    public function delete($id) {
        // echo "deleting post ". $id;
        $sql = "DELETE FROM polls where id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        if($stmt->affected_rows !== 1) {
            $this->errors['delete_err'] = "Poll was not deleted!";
        } 
        return $this;
    }

    public function success() {
        return empty($this->errors);
     }
}