<?php

    require_once('inc/header.php');
   if($_POST){
        //debug($_POST);
       
        if(!empty($_GET['id'])){
            $result = $pdo->prepare("UPDATE user SET pseudo=:pseudo, firstname=:firstname, lastname=:lastname, email=:email, gender=:gender, city=:city, zip_code=:zc, address=:address, privilege=:privilege WHERE id_user=:id_user");
            $result->bindValue(':id_user', $_GET['id'], PDO::PARAM_INT);
            //debug($_GET);
            //debug($_POST);
        } else {
            header('location:' . URL . 'index.php');
        }


            $result->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
            $result->bindValue(':firstname', $_POST['firstname'], PDO::PARAM_STR);
            $result->bindValue(':lastname', $_POST['lastname'], PDO::PARAM_STR);
            $result->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
            $result->bindValue(':gender', $_POST['gender'], PDO::PARAM_STR);
            $result->bindValue(':city', $_POST['city'], PDO::PARAM_STR);
            $result->bindValue(':zc', $_POST['zc'], PDO::PARAM_STR);
            $result->bindValue(':address', $_POST['address'], PDO::PARAM_STR);
            $result->bindValue(':privilege', $_POST['privilege'], PDO::PARAM_INT);

            if($result->execute()){ // if the request was inserted ine the DTB
                if(!empty($_FILES['user_picture']['name'])){
                    copy($_FILES['user_picture']['tmp_name'], $picture_path); 
                }

                if(!empty($_POST['id'])){
                    header('location:users_list.php?m=update');
                }
            }

        }


    if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){
        $req = "SELECT pseudo, firstname, lastname, email, gender, address, zip_code, city, privilege FROM user WHERE id_user = :id_user";

        $result = $pdo->prepare($req);
        $result->bindValue(':id_user', $_GET['id'], PDO::PARAM_INT);
        $result->execute();

        if($result->rowCount() == 1){
            $update_user = $result->fetch();
        }
    }

    $pseudo = (isset($update_user)) ? $update_user['pseudo'] : '';
    $firstname = (isset($update_user)) ? $update_user['firstname'] : '';
    $lastname = (isset($update_user)) ? $update_user['lastname'] : '';
    $email = (isset($update_user)) ? $update_user['email'] : '';
    $gender = (isset($update_user)) ? $update_user['gender'] : '';
    $city = (isset($update_user)) ? $update_user['city'] : '';
    $zip_code = (isset($update_user)) ? $update_user['zip_code'] : '';
    $address = (isset($update_user)) ? $update_user['address'] : '';
    $privilege = (isset($update_user)) ? $update_user['privilege'] : '';


    $action = (isset($update_user)) ? "Update" : 'Add';

?>

    <h1 class="h2"><?= $action ?> a user</h1>

    <form action="" method="post">
            <small class="form-text text-muted">Here you can update users information</small>
            <?= $msg_error ?>
            <div class="form-group">
                <input type="text" class="form-control" name="pseudo" placeholder="Choose a pseudo..." value="<?= $pseudo ?>" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="firstname" placeholder="Your firstname..." value="<?= $firstname ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="lastname" placeholder="Your lastname..." value="<?= $lastname ?>">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Your email..." value="<?= $email ?>">
            </div>
            <div class="form-group">
                <select name="gender" class="form-control">
                    <option value="m" <?php if($gender == 'm'){echo 'selected';} ?>>Men</option>
                    <option value="f" <?php if($gender == 'f'){echo 'selected';} ?>>Women</option>
                    <option value="o" <?php if($gender == 'o'){echo 'selected';} ?>>Other</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="address" placeholder="Address..." value="<?= $address ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="zc" placeholder="Zip code..." value="<?= $zip_code ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="city" placeholder="City..." value="<?= $city ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="privilege" placeholder="Privilege..." value="<?= $privilege ?>">
            </div>
            <input type="submit" value="Send" class="btn btn-success btn-lg btn-block">
        </form>


<?php
    require_once('inc/footer.php');
?>