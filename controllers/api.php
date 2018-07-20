<?php
class Application_Controllers_API extends Lib_BaseController
{

  function __construct()
  {
    $task = @$_REQUEST['task'];
    $value = @$_REQUEST[$_REQUEST["task"]];
    if ( empty($task) ) return;
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

  /*~ 
    ~
    ~*/
  function id( $value = null )
  {
    if ( empty($value) ) return;
    $model = new Application_Models_API;
    $product = $model->getProductById($value);
    $this->data = $product;
  }

  /*~ 
    ~
    ~*/
  function title( $value = null )
  {
  }

  /*~ 
    ~
    ~*/
  function manufacturers( $value = null )
  {
  }

  /*~ 
    ~
    ~*/
  function category( $value = null )
  {
  }

  /*~ 
    ~
    ~*/
  function categories( $value = null )
  {
  }

}
?>