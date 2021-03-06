<?php

class PollController extends Controller {
    // properties
    
    // constructor
    public function __construct()
    {
        CSRF::checkToken($_POST);

       // bring the db conn from parent Controller class
        parent::__construct();
    }

    public function getPolls($vote) {
        $votes = $vote;
        $polls = new PollModel($this->conn);
        if($polls->fetchPolls()->success()) {
            // $votes->fetchVotes()
            $polls = $polls->getPolls();
            $polllimit = 6;
            $numofpages = ceil(count($polls)/$polllimit);
            if(isset($_GET["page"])){
                $page = ($_GET["page"]);
                $startindex =  $page*6;
                $polls_temp = [];
                if($page == $numofpages - 1){
                    for ($i= $startindex; $i < count($polls) ; $i++) { 
                        array_push($polls_temp, $polls[$i]);
                    }
                }
                else{
                    for ($i= $startindex; $i < $startindex + 6 ; $i++) { 
                        array_push($polls_temp, $polls[$i]);
                    }
                }
               
                $polls = $polls_temp;
            }
            
            include "views/poll.php";
        } else {
            $errors = $polls->errors;
            $polls = [];
            include "views/poll.php";
        }
    }

    public function getTrendingPolls() {
        $polls = new PollModel($this->conn);
        if($polls->fetchPolls()->success()) {
            $polls->sortDescByVotes();
            $polls = $polls->getPolls();
            return $polls;
        } else {
            $errors = $polls->errors;
            $polls = [];
        }
    }

    public function searchAndGetPolls($value) {
        $polls = new PollModel($this->conn);
        if($polls->fetchPollWithValue($value)->success()) {
            $voteController = new VoteController;
            $votes = $voteController;
            $polls = $polls->getPolls();
            include "views/poll.php";
        } else {
            $errors = $polls->errors;
            $polls = [];
            include "views/poll.php";
        }
    }

    public function getPoll($id, $isVoted) {
        $poll = new PollModel($this->conn);
        if($poll->fetchPoll($id)->success()) {
            $poll = $poll->getPoll();
            include "views/poll/single_poll.php";
        } else {
            include "views/_404.php";
        }
    }

    public function create($poll, $file) {
        $pollObj = new PollModel($this->conn);
        $file_dest = $this->validateFile($file);
        if(isset($file_dest['error'])){
            $errors = $file_dest['error'];
            include "views/poll/create.php";
        }
        $poll['image'] = $file_dest['image'];
        if($pollObj->validatePoll($poll)->success()) {
            if($pollObj->createNewPoll()->success()) {
               Router::redirect("poll/get/" . $pollObj->poll_id); ## not seem to work
           }
        } else {
            $errors = $pollObj->errors;
            include "views/poll/create.php";
        }
    }

    public function vote($vote) {
        $poll = new PollModel($this->conn);
        if($poll->vote($vote)->success()) {
            $id = $vote['id'];
            include "views/poll/vote_success.php";
            return true;
        } else {
            $errors = $pollObj->errors;
            include "views/poll/single_poll.php";
            return false;
        }
    }

    public function delete($poll) {
        $pollObj = new PollModel($this->conn);
        $pollObj->fetchPoll($poll['id']);
        if($_SESSION['role'] == 1 || $pollObj->poll['author_id'] == $_SESSION['user_id']) {
            if($pollObj->delete($poll['id'])->success()) {
                Router::redirect("poll");
                return true;
            }
        } else {
            include "views/_403.php";
            return false;
        }
    }

    public function update($poll) {
        $pollObj = new PollModel($this->conn);
        $pollObj->fetchPoll($poll['id']);
        if($pollObj->poll['author_id'] == $_SESSION['user_id'] || $_SESSION['role'] == 1) {
            if($pollObj->update($poll)->success()) {
                Router::redirect("poll/get/" . $poll['id']);
            }
        } else {
            include "views/_403.php";
        }
    }

    
    private function validateFile($file) {
        $return = [];
        if($file['size'] === 0) {
            $return['image'] = "public/images/cho-corgi-mong-to.jpg";
            return $return;
         }
        // validate file
        $errors = [];
        if($file['error'] === 0) {
            // check size is less than 5mb
            if($file['size'] > 5000000) {
                $return['error'] = "File is too large!";
            }
            // check file ext is allowed
            $allowed_ext = ["png", "jpg", "jpeg", "gif"];
            $file_ext = explode("/", $file['type']);
            $file_ext = end($file_ext);
            if(!in_array(strtolower($file_ext), $allowed_ext)) {
                $return['error'] = "Only images may be uploaded!";
            }
            // if there are no errors, rename file and move it
            if(empty($errors)) {
                // rename file
                $new_name = uniqid("itec_") . "." . $file_ext;
                $dest = "./public/images/" . $new_name;
                // move to images/
                if(move_uploaded_file($file['tmp_name'], $dest)) {
                    $return['image'] = "public/images/" . $new_name;
                }
            } 
        } 
        return $return;
    }
    
}