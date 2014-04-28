<?php


class Vote
  {
    private $mysqli;
    public $user;
    public $feature;
    public $vote_score;

    function __construct($params  = array())
    {
      $this->mysqli = $GLOBALS["mysqli"];
      foreach ($params as $key => $value) {
        $this->$key = $value;
      }

    }

    function has_vote($user , $feature_id){
      $sql = "SELECT * FROM `user_votes` WHERE `feature_id` = ".$feature_id."  AND `user_email` = '".$user."' LIMIT 1";
      $result=$this->mysqli->query($sql);
      var_dump($result);
      return ($result->num_rows != 0);
    }

    function save(){
      if ($this->has_vote($this->user,$this->feature)) {
        $sql = "UPDATE `user_votes`
                SET `vote` = '". $this->vote_score ."'
                WHERE `feature_id` =". $this->feature ." AND
                      `user_email` = '". $this->user ."'
                LIMIT 1";
      }
      else {
         $sql = "INSERT INTO `user_votes`
                (`vote` , `feature_id` , `user_email`)
                VALUES ('". $this->vote_score ."','". $this->feature ."' , '". $this->user ."')";
      }
      $result=$this->mysqli->query($sql);
      return $this->mysqli->error;
    }
  }
