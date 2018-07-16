<?php

require_once('inc/header.php');

$result = $pdo->query("SELECT * FROM product");
$products = $result->fetchAll();

$content .= "<table class='table table-striped'>";
$content .= "<thead class='thead-dark'><tr>";

for ($i = 0; $i < $result->columnCount(); $i++)
{
  $columns = $result->getColumnMeta($i);
  $content .= "<th scope='col'>" . ucfirst(str_replace('_', ' ', $columns['name'])) . "</th>";
}
$content .= '<th colspan="2">Actions</th>';
$content .= "</tr></thead><tbody>";
foreach ($products as $product)
{
  $content .= "<tr>";
  foreach ($product as $key => $value)
  {
    if ($key == 'picture')
    {
      $content .= '<td><img height="100" src="' . URL . 'uploads/img/' . $product['picture'] . '" alt="' . $product['title'] . '"/></td>';
    }
    else
    {
      $content .= "<td>" . $value . "</td>";
    }
  }
  $content .= "<td><a href='" . URL . "admin/product_form.php?id=" . $product['id_product'] . "'><i class='fas fa-pen'></i></a></td>";
  $content .= "<td><a href='?id=" . $product['id_product'] . "'><i class='fas fa-trash-alt'></i></a></td>";
  $content .= "</tr>";
}
$content .= "</tbody></table>";

//DELETE
if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){
  $req="SELECT * FROM product WHERE id_product = :id_product";
  $result=$pdo->prepare($req);
  $result->bindValue(':id_product', $_GET['id'], PDO::PARAM_INT);

  $result->execute();
  if($result->rowCount() ==1){
    $product = $result->fetch();
    $delete_req = "DELETE FROM product WHERE id_product=$product[id_product]";
    $delete_result = $pdo->exec($delete_req);

    if($delete_result){
      $picture_path = ROOT_TREE. 'uploads/img/'.$product['picture'];
      if(file_exists($picture_path) && $product['picture']!='default.jpg'){ //allows us to be sure that we got this picture registered on the server
        unlink($picture_path); //function unlink allows us to delete a file from server
      }//if file exist
      header('location:product_list.php?m=success');
    }//if delete
    else{
      header('location:product_list.php?m=fail');
    }
  }//if result
  else{
    header('location:product_list.php?m=fail');
  }
}//if isset

if(isset($_GET['m']) && !empty($_GET['m'])){
  switch ($_GET['m']) {
    case 'success':
    $msg_success .="<div class='alert alert-secondary'>The product is deleted.</div>";
    break;
    case 'fail':
    $msg_error .= "<div class='alert alert-danger'>Error during the operation. If you still have this mistake after fex tries, please call the dev.</div>";
    break;
    case 'update':
      $msg_error .="<div class='alert alert-success'>Update succesfully done!</div>";
      break;

    default:
    $msg_success .="<div class='alert alert-secondary'>Please try again!</div>";
    break;
  }
}//if isset

  ?>

  <h1>List of products</h1>

  <?= $content ?>
  <?= $msg_error ?>
  <?= $msg_success ?>


  <?php

  require_once('inc/footer.php');

  ?>
