<?php

require_once '../config/database.php';
require_once '../config/config.php';

if (!isset($_SESSION['user_type'])) {
    header('Location: ../index.php');
    exit;
}

if ($_SESSION['user_type'] != 'admin') {
    header('Location: ../../index.php');
    exit;
}

$db = new DataBase();
$con = $db->conectar();

$id = $_POST['id'];


$sqlSelect = $con->prepare("SELECT imagen FROM productos WHERE id = ?");
$sqlSelect->execute([$id]);
$producto = $sqlSelect->fetch(PDO::FETCH_ASSOC);


if ($producto) {
    $imagenActual = $producto['imagen'];
    $rutaImagenActual = '../../Img/productos/' . $imagenActual;

    if (file_exists($rutaImagenActual)) {
        unlink($rutaImagenActual); 
    }
}


$sqlUpdate = $con->prepare("UPDATE productos SET imagen = 'vector-icono-imagen-predeterminado-pagina-imagen-faltante-diseno-sitio-web-o-aplicacion-movil-no-hay-foto-disponible_87543-11093.avif' WHERE id = ?");
$sqlUpdate->execute([$id]);

header('Location: edita.php?id=' . $id); 
exit;

?>
