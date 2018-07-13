<?php

require_once("inc/header.php");
$page ="Login";

if($_POST){
  $req = "SELECT * FROM user WHERE pseudo = :pseudo";
  $result = $pdo -> prepare($req);
  $result-> bindValue(":pseudo", $_POST['pseudo'], PDO::PARAM_STR);
  $result->execute();

  if($result->rowCount() > 0) // if we select a pseudo in the dtb
  {
    $user=$result->fetch();
    if(password_verify($_POST['pwd'], $user ['pwd'])){
      //passverif is linked to password_hash. it allows us to check the correspondance between 2 values : 1rst argument will be the value to chack, 2nd will be the match values
      // $_SESSION['pseudo'] = $user['pseudo']we don't do that
      foreach ($user as $key => $value) {
        if ($key != 'pwd') {
          $_SESSION['user'][$key]=$value;
          header('location:profile.php');
        }
      }
    }//ifpassverif
    else{
      $msg_error .=  " <div class='alert alert-danger'> Identification error, please try again. </div>";
    }//else if passverif
  }//if result
  else{
    $msg_error .=  " <div class='alert alert-danger'> Identification error, please try again. </div>";
  }
}//if post


 ?>

 <h1> <?= $page ?>  </h1>

 <form class="" action="" method="post">
   <?=  $msg_error ?>
   <div class="form-group">
     <input class="form-control" type="text" name="pseudo" placeholder="Put your pseudo" required>
   </div>
   <div class="form-group">
     <input class="form-control" type="password" name="pwd" placeholder="Put your password">
   </div>
   <input class="btn btn-success btn-lg btn-block" type="submit" name="submit" value="Login">

 <?php
require_once("inc/footer.php");
  ?>
