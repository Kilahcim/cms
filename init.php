<?php
session_start();
require_once('connection.php');
include_once 'user.php';
include_once 'validation.php';


$connection = new Connection;
$connection = $connection-> dbConnect();

$object = new User($connection);
$article = new Article($connection);
$show = new Show($connection);

if(!isset($_SESSION['message'])){
  $_SESSION['message'] = [];
}

if(!isset($_SESSION['is_logged'])){
  $_SESSION['is_logged'] = false;
}

if(!isset($_SESSION['success_registry'] )) {
  $_SESSION['success_registry'] = false;
}
?>


<?php

function debug($var){
  print '<pre style="background-color:#ddd;color:#333;font-family:courier;">';
  var_dump($var);
  print '</pre>';
}
?>
