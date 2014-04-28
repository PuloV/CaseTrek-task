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

    function save(){
      printf("user : %s , feature_id : %s , vote : %s <br />" ,$this->user ,$this->feature ,$this->vote_score);
      return ;
      if ($this->order_id <= 0) {
        $sql ="INSERT INTO `features` (`feature.name` , `feature.id`) VALUES ('".$this->name."','".time()."')";

      }
      else {
        $sql ="UPDATE features SET `feature.name` = '". $this->name ."' , `feature.id` = '". $this->id ."' WHERE `feature.order_id` =". $this->order_id ." LIMIT 1";
      }
      $result=$this->mysqli->query($sql);
      return $this->mysqli->error;
    }
  }
