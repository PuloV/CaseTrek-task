<?php


class Feature
  {
    private $mysqli;
    public $id;
    public $order_id;
    public $name;

    function __construct($params  = array())
    {
      $this->mysqli = $GLOBALS["mysqli"];
      foreach ($params as $key => $value) {
        $this->$key = $value;
      }
    }

    function all()
    {
      $sql = "SELECT *
              FROM features";
      $result=$this->mysqli->query($sql);
      $all_features  = array();
      /* Prefered array than object for the result because of the column names */
      foreach ($result as $key => $value) {
        array_push($all_features, new Feature(array("id" => $value['feature.id'] ,
                                                    "name" => $value['feature.name'],
                                                    "order_id" => $value['feature.order_id'])));
      }
      return $all_features;
    }

    function fix_ids(){
      $sql = "UPDATE features SET `feature.id` =`feature.order_id` WHERE `feature.id` <= 0 ";
      $this->mysqli->query($sql);
    }

    function save(){
    //  if ($this->id <= 0) {
        $sql ="INSERT INTO `features` (`feature.name` , `feature.id`) VALUES ('".trim($this->name)."','".$this->id."')";
     // }
     // else {
     //   $sql ="UPDATE features SET `feature.name` = '". trim($this->name) ."' , `feature.id` = '". $this->id ."' WHERE `feature.order_id` =". $this->order_id ." LIMIT 1";
     // }
      $result=$this->mysqli->query($sql);
      return $this->mysqli->error;
    }

    function delete(){
      if ($this->order_id) {
        $sql ="DELETE FROM `features` WHERE `feature.order_id` = ".$this->order_id." LIMIT 1";
      }
      $result=$this->mysqli->query($sql);
      return $this->mysqli->error;
    }

     function delete_all(){
      $sql ="DELETE FROM `features` WHERE `feature.order_id`";
      $result=$this->mysqli->query($sql);
      return $this->mysqli->error;
    }
  }
