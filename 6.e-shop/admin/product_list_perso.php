<?php
require_once('inc/header.php');

$dsn = "mysql:host=localhost; dbname=eshop";
$login = 'root';
$pwd = '';
$attribute = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];
$pdo = new PDO($dsn, $login, $pwd, $attribute);

$table=$pdo->query("SELECT * FROM product");
$pdostatement = $pdo->query("SELECT * FROM product");
// var_dump($pdostatement);
$table_product=$pdostatement->fetchAll();

echo '<br>';
echo '<table class="table">';
echo '<thead class="thead-dark">';
echo '<tr>';
// echo '<pre>';
// print_r($table_product);
// echo '</pre>';
for ($i = 0; $i < $table->columnCount(); $i++) {
        // the METHOD columncount return the numb of columns in the table
    $column = $table->getColumnMeta($i);
        // the Method getcolmeta returns names of table columns
        // echo '<pre>';
        // print_r($column);
        // echo '</pre>';
    echo '<th  scope="col">' . ucfirst(str_replace('_', ' ', $column['name'])) . '</th>';
}
echo '</tr>';
//While
while ($infos = $table->fetch()) {
        // echo '<pre>';
        // print_r($infos);
        // echo '</pre>';
    echo '<tr>';
    foreach ($infos as $key => $value) {
        echo '<td>' . $value . '</td>';
    if($key=='picture'){
      echo '<td>'. '<img src='.URL.'></td>';
    }
  }
    echo '</tr>';
}

echo '</table>';

require_once('inc/footer.php');
 ?>
<td></td>
