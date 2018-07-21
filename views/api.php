<?php
/*~ переменные из контроллера $this->
  ~ $product
  ~*/
if (  false && class_exists('jbdump') ) jbdump($_REQUEST,0,'$_REQUEST');

$self_url = parse_url($_SERVER['REQUEST_URI']);
$self_url = $self_url['path'];

if ( ! isset($data) ) $data = array();
if ( ! isset($json) ) $json = '';

if (  false && class_exists('jbdump') ) jbdump($data,0,'$data');
if (  false && class_exists('jbdump') ) jbdump($json,0,'$json');

if (  false && class_exists('jbdump') ) jbdump(PATH_ROOT,0,'PATH_ROOT');

?>
<h2>Примеры запросов API (разработке)</h2>

<style>
#api_request { text-align: left; text-indent: 0; padding: 0; margin: 0; }
#api_request table { border-color: #4f7ab0; border-style: solid; border-collapse: collapse; }
#api_request th, #api_request td { border-color: #4f7ab0; border-style: solid; padding: 3px; font-size: .7rem; }
#api_request input[type=text] { width: 280px; }
</style>

<div id="api_request">
  <table width="100%" border=1>
    <tr valign=top>
      <th>Задача</th>
      <th>Проверка</th>
      <th>Пример запроса</th>
    </tr>
    <tr valign=top>
      <td>Выдача товара по ID</td>
      <td>
        <form action="<?=$self_url?>" method="get">
          <input type="hidden" name="task" value="id"/>
          <input type="text" name="id" value="<?=@$_REQUEST['id']?>"/>
          <input type="hidden" name="test" />
          <input type="submit" value="искать" />
        </form>
      </td>
      <td>
        <a target="_blank" title="JSON в новой вкладке" href="<?=PATH_ROOT?>/api?task=id&id=59">
          <?php echo $_SERVER['HTTP_HOST'].PATH_ROOT.'/';?>api?task=id&id=59
        </a>
      </td>
    </tr>
    <tr valign=top>
      <td>Выдача товаров по вхождению подстроки в названии</td>
      <td>
        <form action="<?=$self_url?>" method="get">
          <input type="hidden" name="task" value="title"/>
          <input type="text" name="title" value="<?=@$_REQUEST['title']?>"/>
          <input type="hidden" name="test" />
          <input type="submit" value="искать" />
        </form>
      </td>
      <td>
        <a target="_blank" title="JSON в новой вкладке" href="<?=PATH_ROOT?>/api?task=title&title=мы">
          <?php echo $_SERVER['HTTP_HOST'].PATH_ROOT.'/';?>api?task=title&title=мы
        </a>
      </td>
    </tr>
    <tr valign=top>
      <td>Выдача товаров по производителю/производителям</td>
      <td>
        <form action="<?=$self_url?>" method="get">
          <input type="hidden" name="task" value="manufacturers"/>
          <input type="text" name="manufacturers" value="<?=@$_REQUEST['manufacturers']?>"/>
          <input type="hidden" name="test" />
          <input type="submit" value="искать" />
        </form>
      </td>
      <td>
        <a target="_blank" title="JSON в новой вкладке" href="<?=PATH_ROOT?>/api?task=manufacturers&manufacturers=Пр_2">
          <?php echo $_SERVER['HTTP_HOST'].PATH_ROOT.'/';?>api?task=manufacturers&manufacturers=Пр_2
        </a>
        <hr>
        <a target="_blank" title="JSON в новой вкладке" href="<?=PATH_ROOT?>/api?task=manufacturers&manufacturers=Пр_1|Пр_3">
          <?php echo $_SERVER['HTTP_HOST'].PATH_ROOT.'/';?>api?task=manufacturers&manufacturers=Пр_1|Пр_3
        </a>
      </td>
    </tr>
    <tr valign=top>
      <td>Выдача товаров по разделу (только раздел)</td>
      <td>
        <form action="<?=$self_url?>" method="get">
          <input type="hidden" name="task" value="category"/>
          <input type="text" name="category" value="<?=@$_REQUEST['category']?>"/>
          <input type="hidden" name="test" />
          <input type="submit" value="искать" />
        </form>
      </td>
      <td>
        <a target="_blank" title="JSON в новой вкладке" href="<?=PATH_ROOT?>/api?task=category&category=5">
          <?php echo $_SERVER['HTTP_HOST'].PATH_ROOT.'/';?>api?task=category&category=5
        </a>
        <hr>
        <a target="_blank" title="JSON в новой вкладке" href="<?=PATH_ROOT?>/api?task=category&category=5">
          <?php echo $_SERVER['HTTP_HOST'].PATH_ROOT.'/';?>api?task=category&category=Компьютеры
        </a>
      </td>
    </tr>
    <tr valign=top>
      <td>Выдача товаров по разделу и вложенным разделам</td>
      <td>
        <form action="<?=$self_url?>" method="get">
          <input type="hidden" name="task" value="categories"/>
          <input type="text" name="categories" value="<?=@$_REQUEST['categories']?>"/>
          <input type="hidden" name="test" />
          <input type="submit" value="искать" />
        </form>
      </td>
      <td>
        <a target="_blank" title="JSON в новой вкладке" href="<?=PATH_ROOT?>/api?task=categories&categories=5">
          <?php echo $_SERVER['HTTP_HOST'].PATH_ROOT.'/';?>api?task=categories&categories=5
        </a>
        <hr>
        <a target="_blank" title="JSON в новой вкладке" href="<?=PATH_ROOT?>/api?task=categories&categories=5">
          <?php echo $_SERVER['HTTP_HOST'].PATH_ROOT.'/';?>api?task=categories&categories=Компьютеры
        </a>
      </td>
    </tr>
  </table>
</div>

<div id="api_result">
  <h3>Результат</h3>
  <h4>Массив</h4>
  <? if ( count($data) ) {?>
    <pre><?php print_r($data);?></pre>
  <? }?>
  <h4>JSON</h4>
  <? if ( $json != '' ) {?>
    <pre><?php echo $json;?></pre>
  <? }?>
</div>
