<?php
require_once 'config/config.php';
require_once 'config/database.php';

$db = new DataBase();
$con = $db->conectar();

$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if($id == '' || $token == ''){
    echo 'Error al procesar la petición';
    exit;
}else{
    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

    if($token == $token_tmp){
        $sql = $con->prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1");
        $sql->execute([$id]);
        if($sql->fetchColumn() > 0){
            $sql = $con->prepare("SELECT nombre, descripcion, imagen, precio, descuento, id_categoria FROM productos WHERE id=? AND activo=1
            LIMIT 1");
            $sql->execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $nombre = $row['nombre'];
            $descripcion = $row['descripcion'];
            $imagen = $row['imagen'];
            $precio = $row['precio'];
            $descuento = $row['descuento'];
            $precio_desc = $precio - (($precio * $descuento) / 100);
            $id_categoria = $row['id_categoria'];

            $sqlRelacionados = $con->prepare("SELECT id, nombre, precio, imagen FROM productos WHERE id_categoria = ? AND id != ? AND activo = 1 ORDER BY RAND() LIMIT 12");
            $sqlRelacionados->execute([$id_categoria, $id]);
            $productosRelacionados = $sqlRelacionados->fetchAll(PDO::FETCH_ASSOC);
        }
        
    }else{
        echo 'Error al procesar la petición';
        exit;
    }
}



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
    <link rel="stylesheet" href="css/estilos.footer.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="css/detalles.css">
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
    <nav style="--bs-breadcrumb-divider: '>'; " aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.php"><span>Inicio</span></a></li>
            <li class="breadcrumb-item"><a href="#"><span>Pasteleria de sal</span></a></li>
            <li class="breadcrumb-item active" aria-current="page"><span><?php echo $nombre ?></span></li>
        </ol>
    </nav>

    <div class="container">
    <div class="row">
        <div class="col-md-6 order-md-1">
            <img src="Img/productos/<?php echo $row['imagen'] ?>" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        <div class="col-md-6 order-md-2 d-flex flex-column">
            <h2 class="titulo-de-los-detalles-product"><?php echo $nombre; ?></h2>
            <br>

            <?php if ($descuento > 0) { ?>
                <span class="color-del-descuento"><del><?php echo MONEDA . number_format($precio, 0, '.', ','); ?></del></span>
                <h2>
                    <?php echo MONEDA . number_format($precio_desc, 0, '.', ','); ?>
                    &nbsp;<small class="letraDescuento"><?php echo $descuento; ?>% OFF</small>
                </h2>
            <?php } else { ?>
                <h2 class="precio-product"><?php echo MONEDA . number_format($precio, 0, '.', ','); ?></h2>
            <?php } ?>
            <br>
            <br>
            <!-- Asegúrate de que no haya espacios en blanco antes y después de la etiqueta PHP -->
            <span class="descripcion"><?php echo $descripcion; ?></span>
            
            <div class="mt-auto d-grid gap-3 col-10 mx-auto">
                <button class="btn" id="comprarAhora" type="button">Comprar ahora</button>
                <button class="btn" id="agregarCarrito" type="button" onclick="addProducto(<?php echo $id; ?>, '<?php echo $token_tmp; ?>')">Agregar al carrito</button>
            </div>
        </div>
    </div>
</div>


    <!-- Contenedor del Carrusel -->
    <div id="productosRelacionadosCarousel" class="container carousel slide" data-bs-ride="carousel">
        <h3 class="relacionados">Productos relacionados</h3>
    <div class="carousel-inner">
        <?php
        $chunkedProductos = array_chunk($productosRelacionados, 4); // Agrupa los productos en grupos de 4
        foreach ($chunkedProductos as $index => $grupoProductos) {
            $activeClass = $index === 0 ? 'active' : '';
            echo '<div class="carousel-item ' . $activeClass . '">';
            echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3 mt-1">';

            foreach ($grupoProductos as $producto) {
                ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="Img/productos/<?php echo $producto['imagen']; ?>" class="card-img-top img-fluid" alt="Imagen producto">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $producto['nombre']; ?></h5>
                            <p class="card-text">$<?php echo number_format($producto['precio'], 0, '.', ','); ?></p>
                            <a href="detalles.php?id=<?php echo $producto['id']; ?>&token=<?php echo hash_hmac('sha1', $producto['id'], KEY_TOKEN); ?>" class="btn detalles-relacionados">Ver producto</a>
                        </div>
                    </div>
                </div>
                <?php
            }
            echo '</div></div>';
        }
        ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#productosRelacionadosCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#productosRelacionadosCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>



</main>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>

    function addProducto(id,token){
        let url = 'clases/carrito.php'
        let formData = new FormData()
        formData.append('id',id)
        formData.append('token',token)

        fetch(url, {
            method: 'POST',
            body: formData,
            mode: 'cors'
        }).then(response => response.json())
        .then(data =>{
            if(data.ok){
                let elemento = document.getElementById("num_cart")
                elemento.innerHTML = data.numero
            }else{
                toastr.error('No hay existencias disponibles');
            }
        })
    }

</script>

<?php 
include("footer.php");
?>


<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>



