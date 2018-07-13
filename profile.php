<?php

require_once('inc/header.php');

if(!userConnect()){
  header('location: login.php');
  exit();
}

$page="Profile";
 ?>

 <h1> <?= $page ?></h1>
 <p> Please fin the information below: </p>

<ul>
  <li><img src="uploads/img/<?= $_SESSION['user']['picture'] ?>" alt=""></li>
  <li>firstname:  <?= $_SESSION['user']['firstname']?></li>
  <li>lastname:  <?= $_SESSION['user']['lastname'] ?></li>
  <li>email: <?= $_SESSION['user']['email'] ?></li>

</ul>


 <?php

require_once('inc/footer.php');
  ?>
