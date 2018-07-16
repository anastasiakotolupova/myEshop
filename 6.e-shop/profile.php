<?php
require_once("inc/header.php");
$page= "My profile";
if(!userConnect()){
  header('location: login.php');
  exit();
}

$result = $pdo->query("SELECT picture FROM user WHERE id_user=".$_SESSION['user']['id_user']);
$users = $result->fetch();


$profile = '<img height="400" src="' . URL . 'users/img/' . $users['picture'] . '" alt=""/>';
 ?>

<h1> <?= $page ?>  </h1>

<p> Please fin the information below: </p>
<ul>
  <ul style="list-style:none;">
    <li> <?= $profile ?></li>
  </ul>
  <li>firstname:  <?= $_SESSION['user']['firstname']?></li>
  <li>lastname:  <?= $_SESSION['user']['lastname'] ?></li>
  <li>email: <?= $_SESSION['user']['firstname'] ?></li>
</ul>

 <?php
 require_once("inc/footer.php");

  ?>
