<?php
 // open the session
 session_start();

 $dsn = 'mysql:host=localhost; dbname=eshop'; // connect with dtb
 $login = 'root';
 $pwd = '';
 $attributes= [
   PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
   PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
 ];

 $pdo = new PDO($dsn, $login, $pwd, $attributes);

 //define some constant to have a unique past for links in order to be more effectiv when change data
 //CONSTANT
 define('URL', 'http://localhost/PHP/myeshop/');
 define("ROOT_TREE", $_SERVER['DOCUMENT_ROOT'] . '/PHP/myeshop/');
// We just declare the way to access our files + URL

// declare VARIABLES
$msg_error ="";
$msg_success = "";
$page =" Welcome on my Eshop!";
$content= "";

require_once("functions.php");

 ?>
