<?php
require_once("inc/header.php");

$page= "Signin";

// debug($_POST);
// debug($_POST, 1);
if ($_POST) {
  // check pseudo
  if (!empty($_POST['pseudo'])) {
    $pseudo_verif=preg_match('#^[a-zA-Z0-9-._]{3,20}$#', $_POST['pseudo']); //pregmatch is a function allow me to check what info will be allowed in a result. it takes 2 arg ( REGEX + RESULT). At the end, I will have a true or false condition
    if(!$pseudo_verif){
      $msg_error .= " <div class='alert alert-danger'> Your pseudo must be 3-20 caracters, upper and lower case, number. Please try again.</div>";
    }
    }else{
      $msg_error .=  " <div class='alert alert-danger'> Please enter a valid pseudo </div>";
    }

  if (!empty($_POST['pwd'])){
    $pwd_verif = preg_match('#^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*\'\?$@%_])([-+!*\?$\'@%_\w]{6,15})$#', $_POST['pwd']); // we ask between 6 to 15 caracters + 1uppercase, 1lower + 1nb + 1symbol
    if(!$pwd_verif){
      $msg_error .= " <div class='alert alert-danger'> Your password must be inbetween 6 and 15 caracters whit at least 1 uppercase and 1 lowercase, 1number and 1 symbol. Please try again. </div>";
    }
    }else{
      $msg_error .=  " <div class='alert alert-danger'> Please enter a valid password </div>";

    }
  //check email
  if(!empty($_POST['email'])){
    $email_verif = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL); // filter_var allows us to check a result (STR-> email, URL, .. RTFM). It takes 2 arg : the result to check + the method. It returns a boolean
    $forbidden_mails = [
      'mailinator.com',
      'yopmail.com',
      'mail.com'
    ];
    $email_domain = explode('@', $_POST['email']); // function explode allows me to explode a result into 2 parts regarding the elements I've chosen
    if(!$email_verif || in_array($email_domain[1], $forbidden_mails)){
      $msg_error .=  " <div class='alert alert-danger'> Please enter a valid email. </div>";
    }
    if(!$email_verif){
      $msg_error ="<div class='alert alert-danger'> Your email is invalid</div>";
    }
    }else{
      $msg_error .=  " <div class='alert alert-danger'> Please enter a valid email. </div>";
    }

    if(!isset($_POST['gender']) || ($_POST['gender'] !="m" && $_POST['gender'] !="f" && $_POST['gender'] !="o")){
      $msg_error .=  " <div class='alert alert-danger'> Choose a valid gender. </div>";

    }

  //OTHER CHECKS POSSIBLE HERE
  if(empty($msg_error)){
    //check if pseudo is free
    $result = $pdo->prepare("SELECT pseudo FROM user WHERE pseudo= :pseudo");
    $result->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
    $result->execute();
    if($result->rowCount() ==1){
      $msg_error .= "<div class='alert alert-secondary'> The pseudo $_POST[pseudo] is already taken, please choose another one.</div>";
    }else{
      $result = $pdo->prepare("INSERT INTO user (pseudo, pwd, email, firstname, lastname, gender, city, address, privilege) VALUES (:pseudo, :pwd, :email, :firstname, :lastname, :gender, :city, :address,0)");
      $hashed_pwd = password_hash($_POST["pwd"], PASSWORD_BCRYPT); // function allows us to encrypt the password in a much secure way than md5. It takes 2 arg : the ruslt to hash + the method
      $result -> bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
      $result -> bindValue(':pwd', $hashed_pwd, PDO::PARAM_STR);
      $result -> bindValue(':address', $_POST['address'], PDO::PARAM_STR);
      $result -> bindValue(':email', $_POST['email'], PDO::PARAM_STR);
      $result -> bindValue(':gender', $_POST['gender'], PDO::PARAM_STR);
      $result -> bindValue(':firstname', $_POST['firstname'], PDO::PARAM_STR);
      $result -> bindValue(':lastname', $_POST['lastname'], PDO::PARAM_STR);
      $result -> bindValue(':city', $_POST['city'], PDO::PARAM_STR);

      if ($result->execute()) {
        header('location:login.php');
      }
    }
  }
}
//keep the values entered by the user if there is a problem when the page has to reload
$pseudo=(isset($_POST['pseudo'])) ? $_POST['pseudo'] : '';
$firstname=(isset($_POST['firstname'])) ? $_POST['firstname'] : '';
$lastname=(isset($_POST['lastname'])) ? $_POST['lastname'] : '';
$email=(isset($_POST['email'])) ? $_POST['email'] : '';
$address=(isset($_POST['address'])) ? $_POST['address'] : '';
$city=(isset($_POST['city'])) ? $_POST['city'] : '';
$gender=(isset($_POST['gender'])) ? $_POST['gender'] : '';





 ?>
  <h1>SIGNUP</h1>
  <form class="" action="" method="post">
    <small id="emailHelp" class="form-text text-muted">We'll never use your data for commercial use.</small>
    <?=  $msg_error ?>
    <div class="form-group">
      <input class="form-control" type="text" name="pseudo" placeholder="Choose a pseudo" required value="<?= $pseudo?>">
    </div>
    <div class="form-group">
      <input class="form-control" type="password" name="pwd" placeholder="Choose a password">
    </div>
    <div class="form-group">
      <input class="form-control" type="text" name="firstname" placeholder="Your firstname" value="<?= $firstname?>" >
    </div>
    <div class="form-group">
      <input class="form-control" type="text" name="lastname" placeholder="Your lastname" value="<?= $lastname ?>">
    </div>
    <div class="form-group">
      <input class="form-control" type="email" name="email" placeholder="Your email" value="<?= $email ?>">
    </div>
    <div class="form-group">
      <select class="form-control" name="gender">
        <option value="m" <?php if($gender == "m"){echo "selected";} ?> >Man</option>
        <option value="f" <?php if($gender == "f"){echo "selected";} ?> >Woman</option>
        <option value="o" <?php if($gender == "o"){echo "selected";} ?> >Other</option>
      </select>
    </div>
    <div class="form-group">
      <input class="form-control" type="text" name="address" placeholder="Your address" value="<?= $address?>">
    </div>
    <div class="form-group">
      <input class="form-control" type="text" name="city" placeholder="Your city" value="<?= $city ?>">
    </div>
    <input class="btn btn-success btn-lg btn-block" type="submit" name="submit" value="submit">


  </form>



<?php
require_once("inc/footer.php");
 ?>
