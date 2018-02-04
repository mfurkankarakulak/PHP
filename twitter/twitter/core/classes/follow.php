<?php
  class Follow extends User{
    protected $pdo;
    function __consruct($pdo){
      $this->pdo = $pdo ;
    }
  }
?>