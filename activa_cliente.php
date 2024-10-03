<?php

require 'clases/clienteFunciones.php';
require 'config/config.php';
require 'config/database.php';

$db = new Database();
$con = $db->conectar();


$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';


echo validaToken($id, $token,$con);

if($id != '' && $token != ''){
    header("location: index.php");
    exit;
}


?>