<?php


class Feature
  {
    private $mysqli;
    public $id;
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
                                                    "name" => $value['feature.name'])));
      }
      return $all_features;
    }

    function update(){
      $sql ="UPDATE features SET `feature.name` = '". $this->name ."' WHERE `feature.id` =". $this->id ." LIMIT 1";
      $result=$this->mysqli->query($sql);
      print($sql."<br />");
      return $this->mysqli->error;
    }
  }
