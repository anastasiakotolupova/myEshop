<?php

require_once('inc/init.php');
unset($_SESSION['user']); // we delete only the data linked o the user session_start
header('location:index.php');

 ?>
