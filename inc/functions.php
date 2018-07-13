<?php

  function debug($var, $mode = 1){
    echo '<div class="alert alert-warning">';
      $trace = debug_backtrace(); //function debug_back allows us to track the place where the function is called [multiarray]
      $trace = array_shift($trace); // this function allows us to erase the multi results // have acces to the result in a simple array
      echo"The debug was called in the file $trace[file] at the line $trace[line] <hr>";
      echo '<pre>';
      switch ($mode) {  //to have the choice inbetween both, and then add the argument in the function in the doc debug
        case '1':
          echo var_dump($var);
          break;

        default:
          print_r($var);
          break;
      }
      echo'</pre>';
    echo '</div>';
  }// end of function debug

// function to check if the user is connected
  function userConnect(){
    if (isset($_SESSION['user'])) {
      return TRUE;
    }else{
      return FALSE;
    }
    // if(isset($_SESSION['user'])) return TRUE; else return FALSE;
  }// user connect
//function to check if user = admin
  function userAdmin(){
    if(userConnect() && $_SESSION['user']['privilege']==1) return TRUE; else return FALSE;
  }
 ?>
