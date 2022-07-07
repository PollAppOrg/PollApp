<?php

class VoteController extends Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function fetchVotes($_user_id)  {
        $voteObj = new VoteModel($this->conn);
        $voteObj->fetchVotes($_user_id);
        return $voteObj->voteds;
    } 

    public function isVoted($_user_id, $_pool_id)  {
        $voteObj = new VoteModel($this->conn);
        return $voteObj->isVoted($_user_id, $_pool_id);
    } 

    public function createVote($_user_id, $_pool_id)  {
        $voteObj = new VoteModel($this->conn);
        return $voteObj->createVote($_user_id, $_pool_id);
    } 

    public function deleteVotes($_pool_id)  {
        $voteObj = new VoteModel($this->conn);
        return $voteObj->deleteVotes($_pool_id);
    } 

}