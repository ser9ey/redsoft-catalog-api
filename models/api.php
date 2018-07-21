<?php
function utf8_ucwords($str) {
  $expr = '!(^|\pM|\pP|\pZ)(\pL)!mue';
  return preg_replace($expr, '"$1" . mb_strtoupper("$2", "UTF-8")', $str);
}

class Application_Models_API extends Lib_DataBase
{	  

  /*~ Выдача товара по ID
    ~*/
  function getProductById($id)
  { 		
    $sql = 'SELECT * FROM `product` WHERE `id=`' . $id;
    $res = parent::$pdo->prepare($sql);
    $res->execute();
    $product = $res->fetch(PDO::FETCH_ASSOC);
    return $product; 
  }

  /*~ Выдача товаров по вхождению подстроки в названии
    ~*/
  function getProductByTitle( $value )
  {
    $ucfirst = utf8_ucwords($value);
    $sql = 'SELECT * FROM `product` WHERE `name` LIKE ' . '"%' . $value . '%" OR `name` LIKE ' . '"%' . $ucfirst . '%"';
    $res = parent::$pdo->prepare($sql);
    $res->execute();
    $products = $res->fetchAll();
    return $products; 
  }

  /*~ Выдача товаров по производителю/производителям
    ~*/
  function getProductByManufacturers( $value )
  {
    $values = explode('|', $value);
    $products = array();
    foreach ( $values as $val ) {
      $ucfirst = utf8_ucwords($val);
      $sql = 'SELECT * FROM `product` WHERE `manufacturer`="' . $val . '" OR `manufacturer`="' . $ucfirst . '"';
      $res = parent::$pdo->prepare($sql);
      $res->execute();
      $products = array_merge($products, $res->fetchAll());
    }
    return $products; 
  }

  /*~ Выдача товаров по разделу (только раздел)
    ~*/
  function getProductByCategory( $value )
  {
    $cat_id = (int) $value;
    if ( $cat_id == 0 && $value !== '0' ) $cat_id = self::getCategoryByTitle($value);

    $sql = 'SELECT * FROM `product` WHERE `cat_id`="' . $cat_id . '"';
    $res = parent::$pdo->prepare($sql);
    $res->execute();
    $products = $res->fetchAll();

    if ( count($products) ) {
      $category = Lib_Category::getCategoryByID($cat_id);
      foreach ( $products as $index => $product ) $products[$index]['cat_title'] = $category['title'];
    }
    return $products; 
  }

  /*~ Выдача товаров по разделу и вложенным разделам
    ~*/
  function getProductByCategoryAll( $value )
  {
    $cat_id = (int) $value;
    if ( $cat_id == 0 && $value !== '0' ) $cat_id = self::getCategoryByTitle($value);

    $categories_id = array_merge( array($cat_id), Lib_Category::getInstance()->getCategoryList($cat_id) );
    $list = implode(',', $categories_id);
    $sql = 'SELECT * FROM `product` WHERE `cat_id` IN (' . $list . ')';
    $res = parent::$pdo->prepare($sql);
    $res->execute();
    $products = $res->fetchAll();

    if ( count($products) ) {
      foreach ( $products as $index => $product ) {
        $category = Lib_Category::getCategoryByID($product['cat_id']);
        $products[$index]['cat_title'] = $category['title'];
      }
    }
    return $products; 

  }

  /*~ ID категории по названию
    ~*/
  public static function getCategoryByTitle($value)
  { 		
    $sql = 'SELECT `id` FROM `category` WHERE `title`="' . $value . '"';
    $res = parent::$pdo->prepare($sql);
    $res->execute();
    $id = $res->fetch();
    return $id['id']; 
  }
	  
} 