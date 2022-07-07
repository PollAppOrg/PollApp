<?php

class VoteController extends Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function isVoted($_username, $_pool_id)  {
        $voteObj = new VoteModel($this->conn);
        return $voteObj->isVoted($_username, $_pool_id);
    } 

    public function createVote($_username, $_pool_id)  {
        $voteObj = new VoteModel($this->conn);
        return $voteObj->createVote($_username, $_pool_id);
    } 

    public function deleteVotes($_pool_id)  {
        $voteObj = new VoteModel($this->conn);
        return $voteObj->deleteVotes($_pool_id);
    } 

}