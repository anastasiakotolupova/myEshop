<?php
require_once("inc/header.php");
// debug($_POST);
debug($_FILES);

if($_POST){
  foreach ($_POST as $key => $value) {
    $_POST[$key] = addslashes($value);
  }//foreach
  // debug($_POST);
  // debug($_FILES);
  if(!empty($_FILES['picture']['name'])){ //checking if we got the results for the first picture
    $picture_name= $_POST['title'].'_'.$_POST['reference']. '_'.time().'_'.rand(1,999).$_FILES['picture']['name'];//random name for picture
    // $picture_name= str_replace(' ', '-', $_POST['title']).'_'.$_POST['reference']. '_'.time().'_'.rand(1,999).$_FILES['product']['name']; also possible
    $picture_name =str_replace(' ','-',$picture_name);
    //we register the path of my file
    $picture_path = ROOT_TREE.'uploads/img/'.$picture_name;

    if($_FILES['picture']['size']>2000000){
      $msg_error .= " <div class='alert alert-danger'>Please select a 2Mo file maximum!</div>";
    }//if files pic
    $type_picture = ['image/jpeg', 'image/png','image/gif'];
    if(!in_array($_FILES['picture']['type'], $type_picture)){
      $msg_error .= "<div class='alert alert-danger'>Please select a correct file!</div>";
    }
  }elseif (isset($_POST['actual_picture'])) { //if i update a product I target the new input created with my $updateproduct
    $picture_name=$_POST['actual_picture'];
  }else{
    $picture_name= 'default.jpeg';
  }//if empty
  if(empty($msg_error)){

    if (!empty($_POST['id_product'])) { // register the update
      $result= $pdo->prepare("UPDATE product SET reference=:reference, category=:category, title=:title, description=:description, color=:color, size=:size, gender=:gender, picture=:picture, picture2=NULL, price=:price, stock=:stock  WHERE id_product=:id_product");

      $result->bindValue('id_product', $_POST['id_product'], PDO::PARAM_INT);
    }else {
      $result =$pdo->prepare("INSERT INTO product (reference, category, title, description, color, size, gender, picture, picture2, price, stock) VALUES (:reference, :category, :title, :description, :color, :size, :gender, :picture, NULL, :price, :stock)");
      // $result->bindValue('id_product', $_POST['id_product'], PDO::PARAM_INT);
    }

    $result->bindValue(':reference', $_POST['reference'], PDO::PARAM_STR);
    $result->bindValue(':category', $_POST['category'], PDO::PARAM_STR);
    $result->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
    $result->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
    $result->bindValue(':color', $_POST['color'], PDO::PARAM_STR);
    $result->bindValue(':size', $_POST['size'], PDO::PARAM_STR);
    $result->bindValue(':gender', $_POST['gender'], PDO::PARAM_STR);
    $result->bindValue(':picture', $picture_name, PDO::PARAM_STR);
    // $result->bindValues(':picture2', $_POST['picture2'], PDO::PARAM_STR); NULL
    $result->bindValue(':price', $_POST['price'], PDO::PARAM_STR);
    $result->bindValue(':stock', $_POST['stock'], PDO::PARAM_INT);

    if($result->execute()){//if the request was inserted in the DTB
      if(!empty($_FILES['picture']['name'])){
        copy($_FILES['picture']['tmp_name'], $picture_path);
      }
      if(!empty($_POST['id_product'])){
        header('location:product_list.php?m=update');
      }
    } //if result exe
  }
}//if post
// UPDATE
if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){
  $req = "SELECT * FROM product WHERE id_product = :id_product";

  $result = $pdo->prepare($req);
  $result->bindValue(':id_product', $_GET['id'], PDO::PARAM_INT);
  $result->execute();

  if($result->rowCount()== 1){
    $update_product = $result->fetch();
  }//if result

}
$reference = (isset($update_product))?
$update_product['reference'] : '';
$category = (isset($update_product)) ?
$update_product['category'] : "";
$title = (isset($update_product)) ?
$update_product['title'] : "";
$description = (isset($update_product)) ?
$update_product['description'] : "";
$color = (isset($update_product)) ?
$update_product['color'] : "";
$size = (isset($update_product)) ?
$update_product['size'] : "";
$gender = (isset($update_product)) ?
$update_product['gender'] : "";
$picture = (isset($update_product)) ?
$update_product['picture'] : "";
$price = (isset($update_product)) ?
$update_product['price'] : "";
$stock = (isset($update_product)) ?
$update_product['stock'] : "";

$id_product= (isset($update_product)) ? $update_product['id_product'] : "";
$action = (isset($update_product))? "Update" : "Add";



?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2"> <?= $action ?> a product</h1>
</div>
<form action="#" method="post" enctype="multipart/form-data">
  <?=  $msg_error ?>
  <input type="hidden" name="id_product" value="<?= $id_product ?>">
  <?php $picture_name ?>
  <div class="form-group">
    <input class="form-control" type="text" name="reference" placeholder="Reference of the product" value="<?= $reference ?>">
  </div>
  <div class="form-group">
    <input class="form-control" type="text" name="category" placeholder="Category of the product" value="<?= $category ?>">
  </div>
  <div class="form-group">
    <input class="form-control" type="text" name="title" placeholder="Title of the product" value="<?= $title ?>">
  </div>
  <div class="form-group">
    <textarea class="form-control" rows="8" cols="80"name="description" placeholder="Description of the product" ><?= $description ?></textarea>
  </div>
  <div class="form-group">
    <select class="form-control" name="color">
      <option disabled <?php if(!isset($update_product)){echo "selected";} ?>>Color of the product..</option>
      <option <?php if($color =='Black'){echo 'selected';} ?>>Black</option>
      <option <?php if($color =='White'){echo 'selected';} ?>>White</option>
      <option<?php if($color =='Blue'){echo 'selected';} ?>>Blue</option>
      <option<?php if($color =='Pink'){echo 'selected';} ?>>Pink</option>
      <option<?php if($color =='Red'){echo 'selected';} ?>>Red</option>
      <option<?php if($color =='Orange'){echo 'selected';} ?>>Orange</option>
      <option<?php if($color =='Green'){echo 'selected';} ?>>Green</option>
      <option<?php if($color =='Grey'){echo 'selected';} ?>>Grey</option>
      <option<?php if($color =='Purple'){echo 'selected';} ?>>Purple</option>
      <option<?php if($color =='Brown'){echo 'selected';} ?>>Brown</option>
      <option<?php if($color =='Yellow'){echo 'selected';} ?>>Yellow</option>
      <option<?php if($color =='Indigo'){echo 'selected';} ?>>Indigo</option>
      <option<?php if($color =='Turquoise'){echo 'selected';} ?>>Turquoise</option>
    </select>
  </div>
  <div class="form-group">
    <select class="form-control" name="size">
      <option disabled <?php if(!isset($update_product)){echo "selected";} ?>>Size of the product..</option>
      <option<?php if($size =='XS'){echo 'selected';} ?>>XS</option>
      <option<?php if($size =='S'){echo 'selected';} ?>>S</option>
      <option<?php if($size =='M'){echo 'selected';} ?>>M</option>
      <option<?php if($size =='L'){echo 'selected';} ?>>L</option>
      <option<?php if($size =='XL'){echo 'selected';} ?>>XL</option>
      <option<?php if($size =='XXL'){echo 'selected';} ?>>XXL</option>
    </select>
  </div>
  <div class="form-group">
    <select class="form-control" name="gender">
      <option disabled <?php if(!isset($update_product)){echo "selected";} ?>>Gender of the product..</option>
      <option value="m" <?php if($gender =='m'){echo 'selected';} ?>>Man</option>
      <option value="f" <?php if($gender =='f'){echo 'selected';} ?>>Woman</option>
      <option value="u" <?php if($gender =='u'){echo 'selected';} ?>>Undefined</option>
    </select>
  </div>
  <div class="form-group">
    <label for="product_picture">Product picture</label>
    <input class="form-control-file" type="file" id="picture" name="picture" >
    <?php
    if(isset($update_product)){
      echo " <input name='actual_picture' value='$picture' type='hidden' >";
      echo "<img style='width:25%' src='".URL."uploads/img/$picture'>";
    }
    ?>
  </div>
  <div class="form-group">
    <label for="product_picture2">Product picture (optionnal)</label>
    <input class="form-control-file" type="file" id="picture2" name="picture2" >
  </div>
  <div class="form-group">
    <input class="form-control" type="text" name="price" placeholder="Price of the product" value=" <?= $price ?>">
  </div>
  <div class="form-group">
    <input class="form-control" type="text" name="stock" placeholder="Stock of the product" value=" <?= $stock ?>">
  </div>
  <input class="btn btn-info btn-lg btn-block" type="submit" name="submit" value="submit"  <?= $action ?>>
</form>
<br><br><br>


<?php

require_once("inc/footer.php");
?>
