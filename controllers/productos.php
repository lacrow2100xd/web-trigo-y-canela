<?php
include_once('../Models/productos.php');

$productos = new Productos();
session_start();

if($_POST['funcion']=='llenar_productos'){
   
    $productos->llenar_productos();
    $json=array();
    foreach($productos->objetos as $objeto){
        $json[]=array(

        'nombre' =>$objeto->nombre,
        'descripcion' =>$objeto->descripcion,
        'imagen' =>$objeto->imagen,
        'precio' =>$objeto->precio,
        'id_categoria' =>$objeto->id_categoria,
    );
    }
    
$jsonstring = json_encode($json);
echo $jsonstring;


}





