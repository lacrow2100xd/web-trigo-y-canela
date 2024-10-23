<?php
require_once 'config/config.php';
require_once 'config/database.php';
require_once 'clases/clienteFunciones.php';


$token_session = $_SESSION['token'];
$orden = $_GET['orden'] ?? null;
$token = $_GET['token'] ?? null;

if($orden == null || $token == null || $token != $token_session){
    header("Location: compras.php");
    exit;
}


$db = new Database();
$con = $db->conectar();


$sqlCompra = $con->prepare("SELECT id, id_transaccion, fecha, total FROM compra WHERE id_transaccion = ? LIMIT 1");
$sqlCompra->execute([$orden]);
$rowCompra = $sqlCompra->fetch(PDO::FETCH_ASSOC);
$idCompra = $rowCompra['id'];

$fecha = new DateTime($rowCompra['fecha']);
$fecha = $fecha->format('d/m/Y  H:i');

$sqlDetalle = $con->prepare("SELECT id, nombre, precio, cantidad FROM detalle_compra WHERE id_compra = ?");
$sqlDetalle->execute([$idCompra]);






?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trigo y canela</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/compras.css">
    
</head>
<body>
    
<header data-bs-theme="white">
  
  <div class="navbar navbar-expand-lg navbar-white bg-white ">
    <div class="container">
      <a href="index.php" class="navbar-brand">
        <div class="logo-name">
            <img src="Img/Diseño_sin_título__1_-removebg-preview.png" alt="Logo Panadería">
            <strong>Trigo y canela</strong>
        </div>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarHeader">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
              <a href="index.php" class="nav-link  btn rounded-pill">Inicio</a>
          </li>
          <li class="nav-item">
              <a href="productos.php" class="nav-link active btn rounded-pill">Productos</a>
          </li>
          <li class="nav-item">
              <a href="#" class="nav-link btn rounded-pill">Nosotros</a>
          </li>
          <li class="nav-item">
              <a href="#" class="nav-link btn rounded-pill ">Servicios</a>
          </li>
          <li class="nav-item">
              <a href="#" class="nav-link btn rounded-pill">Tiendas</a>
          </li>
        </ul>
        
        <a href="checkout.php" class="btn bg-transparent border border-light position-relative me-2">
          <i class="bi bi-bag "></i><span id="num_cart" class="bagde bg-secundary"><?php echo $num_cart?></span>
        </a>

        <?php if(isset($_SESSION['user_id'])){ ?> 
          <div class="dropdown">
            <button class="btn rounded-pill inicioSesion dropdown-toggle" type="button" id="btn_session" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa-solid fa-user"></i> 
              <?php echo $_SESSION['user_name']; ?></a>
            </button>
            <div class="dropdown-menu" aria-labelledby="btn_session">
              <a class="dropdown-item" href="logout.php">Cerrar sesión</a>
              <a class="dropdown-item" href="compras.php">Mis compras</a>
            </div>
          </div>
         
        <?php } else { ?>
          <a href="login.php" class="btn rounded-pill inicioSesion"> Iniciar sesión</a>
        <?php } ?>
        
      </div>



    </div>
  </div>
</header>

<main>
    <div class="container">

    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card mb-3 shadow-sm     ">
                <div class="card-header">
                    <b>Detalle de la compra </b>
                </div>
                <div class="card-body">
                    <p><b>Fecha: </b> <?php echo $fecha; ?></p>
                    <p><b>Orden: </b> <?php echo $rowCompra['id_transaccion']; ?></p>
                    <p><b>Total: </b> 
                    <?php echo MONEDA . number_format($rowCompra['total'], 0, '.', ','); ?>
                    </p>
                 
                </div>

            </div>

        </div>
        <div class="col-12 col-md-8">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $sqlDetalle->fetch(PDO::FETCH_ASSOC)){
                            $precio = $row['precio'];
                            $cantidad = $row['cantidad'];
                            $subtotal = $precio * $cantidad;
                            ?>
                            <tr>
                                <td><?php echo $row['nombre']; ?></td>
                                <td>
                                    <?php echo MONEDA . number_format($precio, 0, '.', ','); ?>
                                </td>
                                <td><?php echo $cantidad ?></td>
                                <td>
                                    <?php echo MONEDA . number_format($subtotal, 0, '.', ','); ?>
                                </td>
                            </tr>
                            <?php } ?>
                          
                    </tbody>
                </table>
            </div>
        </div>
    </div>

      
    </div>

</main>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="Util/js/jquery.min.js"></script>
<script src="Util/js/jquery.validate.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
