<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

$tasks = file_get_contents('./tasks.json');
$tasks = json_decode($tasks);
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    echo json_encode($tasks);
}
if($_SERVER['REQUEST_METHOD'] == 'PUT'){
    $item = file_get_contents('php://input');
    $item = json_decode($item);
    $key = array_search($item, $tasks);
    foreach($tasks as $i =>$t){
        if($t->id == $item->id){
            $tasks[$key] =$item;
            break;
        }
    }
        //mentsük el
    file_put_contents('./tasks.json', json_encode($tasks));
    echo json_encode($item);

}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $item = file_get_contents('php://input');
    if(!empty($item)){
    $item = json_decode($item); 
    $item->id = uniqid();
    $item->created = date('Y-m-d');
    array_push($tasks,$item);
    file_put_contents('./tasks.json', json_encode($tasks));
    echo json_encode($item);
}
}
if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $item = file_get_contents('php://input');
    $item = json_decode($item);
    $key = array_search($item, $tasks);
    foreach($tasks as $i =>$t){
        if($t->id == $item->id){
            unset($tasks[$key]);
            break;
        }
    }
        //mentsük el
    file_put_contents('./tasks.json', json_encode($tasks));
    echo json_encode($item);
}
?>