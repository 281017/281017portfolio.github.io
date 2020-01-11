<?php
class Template extends DB {

  private $db;

  public function __construct() {
    $this->openDB();
  }
}
