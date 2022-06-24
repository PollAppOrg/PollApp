<?php

class PollController extends Controller {
    // properties
    
    // constructor
    public function __construct()
    {
       // bring the db conn from parent Controller class
        parent::__construct();
    }

    public function getPolls() {
        $polls = new PollModel($this->conn);
        if($polls->fetchPolls()->success()) {
            $polls = $polls->getPolls();
            include "views/poll.php";
        } else {
            $errors = $polls->errors;
            $polls = [];
            include "views/poll.php";
        }
    }

    public function getPoll($id) {
        $poll = new PollModel($this->conn);
        if($poll->fetchPoll($id)->success()) {
            $poll = $poll->getPoll();
            include "views/poll/single_poll.php";
        } else {
            include "views/_404.php";
        }
    }

    public function create($poll) {
        $pollObj = new PollModel($this->conn);
        if($pollObj->validatePoll($poll)->success()) {
           if($pollObj->createNewPoll()->success()) {
               Router::redirect("poll/get/" . $pollObj->poll_id);
           }
        } else {
            $errors = $pollObj->errors;
            include "views/poll/create.php";
        }
    }

    public function vote($vote) {
        $poll = new PollModel($this->conn);
        if($poll->vote($vote)->success()) {
            include "views/poll/vote_success.php";
        } else {
            $errors = $pollObj->errors;
            include "views/poll/single_poll.php";
        }
    }

    public function delete($poll) {
        $pollObj = new PollModel($this->conn);
        $pollObj->fetchPoll($poll['id']);
        if($pollObj->poll['author_id'] == $_SESSION['user_id'] || $_SESSION['user_role'] == 1) {
            if($pollObj->delete($poll['id'])->success()) {
                Router::redirect("poll");
            }
        } else {
            include "views/_403.php";
        }
    }

    public function update($poll) {
        $pollObj = new PollModel($this->conn);
        $pollObj->fetchPoll($poll['id']);
        if($pollObj->poll['author_id'] == $_SESSION['user_id'] || $_SESSION['user_role'] == 1) {
            if($pollObj->update($poll)->success()) {
                Router::redirect("poll/get/" . $poll['id']);
            }
        } else {
            include "views/_403.php";
        }
    }
}