    <?php

    require_once '../config/database.php';
    require_once '../config/config.php';

    if(!isset($_SESSION['user_type'])){
        header('Location: ../index.php');
        exit;
    }

    if($_SESSION['user_type'] != 'admin'){
        header('Location: ../../index.php');
        exit;
    }

    $db = new DataBase();
    $con = $db->conectar();

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $descuento = $_POST['descuento'];
    $stock = $_POST['stock'];
    $categoria = $_POST['categoria'];

    $imagenNombre = '';

if (isset($_FILES['imagen_principal']) && $_FILES['imagen_principal']['error'] == 0) {
    
    $directorioDestino = '../../Img/productos/';
    $imagenNombre = uniqid() . '_' . basename($_FILES['imagen_principal']['name']);
    $rutaImagen = $directorioDestino . $imagenNombre;

    if (move_uploaded_file($_FILES['imagen_principal']['tmp_name'], $rutaImagen)) {
        
        
    } else {
        
       
    }
}


$sql = "INSERT INTO productos (nombre, descripcion, imagen, precio, descuento, stock, id_categoria, activo)
        VALUES (?, ?, ?, ?, ?, ?, ?, 1)";
$stm = $con->prepare($sql);
if ($stm->execute([$nombre, $descripcion,$imagenNombre, $precio, $descuento, $stock, $categoria])) {
    $id = $con->lastInsertId();
    
} else {
    
}

 header('Location: index.php');

