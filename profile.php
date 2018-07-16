<?php

require_once('inc/header.php');

if(!userConnect()){
  header('location: login.php');
  exit();
}

$result = $pdo->query("SELECT picture FROM user WHERE id_user=".$_SESSION['user']['id_user']);
$users = $result->fetch();


if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']))
{
    $req = "SELECT * FROM user WHERE id_user = :id_user";

    $result = $pdo->prepare($req);

    $result->bindValue(':id_user', $_GET['id'], PDO::PARAM_INT);

    $result->execute();

    if($result->rowCount() == 1)
    {
        $user = $result->fetch();

        $delete_req = "DELETE FROM user WHERE id_user = $user[id_user]";

        $delete = $pdo->exec($delete_req);

        if ($delete) {
           header("location:".URL.'logout.php');
        }
    } 

}


$page="Profile";
 ?>

 <h1> <?= $page ?></h1>
 <p> Please fin the information below: </p>

<ul>
  <li><img src="users/img/<?= $_SESSION['user']['picture'] ?>" alt=""></li>
  <li>firstname:  <?= $_SESSION['user']['firstname']?></li>
  <li>lastname:  <?= $_SESSION['user']['lastname'] ?></li>
  <li>email: <?= $_SESSION['user']['email'] ?></li>

</ul>

  <a href="update.php?id=<?=$_SESSION['user']['id_user']?>" class='btn btn-success'>Update your account</a>
  <a href="?id=<?=$_SESSION['user']['id_user']?>" class="btn btn-danger">Delete Your Account</a>


 <?php

require_once('inc/footer.php');
  ?>

  


