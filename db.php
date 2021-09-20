<?php 
  try
  {
    $db = new PDO("mysql:host=localhost; dbname=addidagli_Test; charset=utf8", 'addidagli_basicPanelUser', 'vYQlK}A1S(Ql');
  }
  catch(Exception $e)
  {
    echo $e->getMessage();
  }
?>