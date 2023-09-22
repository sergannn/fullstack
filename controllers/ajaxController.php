<?php 
include_once '../config/DataBase.php';
$method = $_SERVER['REQUEST_METHOD'];
$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
$db = new DataBase('localhost', 'root', 'root', 'test');
function parseInput()
{
  $data = file_get_contents("php://input");

  if($data == false)
    return array();

  parse_str($data, $result);

  return $result;
}
$args= parseInput();
switch ($method) {
  case 'PUT':
    { echo 'p';} 
    break;
  case 'POST':
     //echo 'u';
    break;
  case 'DELETE':
    
    echo $q='delete FROM `Product` WHERE `id` = '.$args['id'];
  $db->query($q);
    break;
  default:
    handle_error($request);  
    break;
}

?>