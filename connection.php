<?php

class Connection {

  public function dbConnect() {
    return new PDO("mysql:host=localhost; dbname=uzytkownicy; charset=utf8", "root", "", [
      PDO::ATTR_EMULATE_PREPARES => false,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      ]
    );
  }
}

?>
