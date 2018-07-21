<?php
class Application_Controllers_API extends Lib_BaseController
{
  private $model;

  function __construct()
  {
if (  false && class_exists('jbdump') ) jbdump($_REQUEST,0,'$_REQUEST');
if (  false && class_exists('jbdump') ) jbdump($_REQUEST["task"],0,'$_REQUEST["task"]');
if (  false && class_exists('jbdump') ) jbdump($_REQUEST[$_REQUEST["task"]],0,'$_REQUEST[$_REQUEST["task"]]');

    $task = @$_REQUEST['task'];
    $value = @$_REQUEST[$_REQUEST["task"]];
    if ( empty($task) || empty($value) ) return;

    $this->model = new Application_Models_API;

    /* task */
    $this->$task( $value );
    /* json */
    $json = json_encode($this->data, JSON_UNESCAPED_UNICODE);
    $this->json = $json;
    /* test */
    if ( array_key_exists('test', $_REQUEST) ) return;
    /* echo */
    echo $this->json['json'];
    exit();
	 }

  /*~ Выдача товара по ID
    ~*/
  function id( $value = null )
  {
    $product = $this->model->getProductById($value);
    $this->data = $product;
  }

  /*~ Выдача товаров по вхождению подстроки в названии
    ~*/
  function title( $value = null )
  {
    $products = $this->model->getProductByTitle($value);
    $this->data = $products;
  }

  /*~ Выдача товаров по производителю/производителям
    ~*/
  function manufacturers( $value = null )
  {
    $products = $this->model->getProductByManufacturers($value);
    $this->data = $products;
  }

  /*~ Выдача товаров по разделу (только раздел)
    ~*/
  function category( $value = null )
  {
    $products = $this->model->getProductByCategory($value);
    $this->data = $products;
  }

  /*~ Выдача товаров по разделу и вложенным разделам
    ~*/
  function categories( $value = null )
  {
    $products = $this->model->getProductByCategoryAll($value);
    $this->data = $products;
  }

}
