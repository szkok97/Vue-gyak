<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $tasks = file_get_contents('./tasks.json');
    $tasks = json_decode($tasks);

    header('Content-Type: application/json');
    echo json_encode($tasks);
}
?>