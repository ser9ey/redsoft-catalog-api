<?php
class Application_Models_API extends Lib_DataBase
{

  function getProductById($id)
  {
    $sql = 'SELECT * FROM product WHERE id=' . $id;
    $res = parent::$pdo->prepare($sql);
    $res->execute();
    $product = $res->fetch(PDO::FETCH_ASSOC);
    return $product; 
  }

} 