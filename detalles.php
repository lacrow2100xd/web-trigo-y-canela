<?php
require 'config/config.php';
require 'config/database.php';

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
            $sql = $con->prepare("SELECT nombre, descripcion, imagen, precio, descuento FROM productos WHERE id=? AND activo=1
            LIMIT 1");
            $sql->execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $nombre = $row['nombre'];
            $descripcion = $row['descripcion'];
            $imagen = $row['imagen'];
            $precio = $row['precio'];
            $descuento = $row['descuento'];
            $precio_desc = $precio - (($precio * $descuento) / 100);
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
    <link rel="stylesheet" href="css/detalles.css">
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
              <a href="#" class="nav-link active btn rounded-pill">Productos</a>
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
        
        <a href="checkout.php" class="btn bg-transparent border border-light position-relative">
          <i class="bi bi-bag "></i><span id="num_cart" class="bagde bg-secundary"><?php echo $num_cart?></span>
        </a>
        
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
                <img src="Img/productos/<?php echo $row['imagen']?>.jpg" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div class="col-md-6 order-md-2 d-flex flex-column">
                <h2><?php echo $nombre ?> </h2>
                <br>

                <?php if($descuento > 0) { ?> 

                    <span><del><?php echo MONEDA . number_format($precio, 3, '.' , ','); ?></del></span>
                    <h2>
                        <?php echo MONEDA . number_format($precio_desc, 3, '.' , ','); ?> 
                        &nbsp;<small class="letraDescuento"><?php echo $descuento; ?>% OFF</small>
                    </h2>
                    <?php } else { ?> 

                <h2><?php echo MONEDA . number_format($precio, 3, '.' , ','); ?> </h2>

                <?php } ?>
                <br>
                <p style="font-size: 19px;">    
                    <?php echo $descripcion ?>
                </p>
                
                <div class="mt-auto d-grid gap-3 col-10 mx-auto">
                    <button class="btn" id="comprarAhora" type="button">Comprar ahora</button>
                    <button class="btn" id="agregarCarrito" type="button" onclick="addProducto(<?php 
                    echo $id; ?>, '<?php echo $token_tmp; ?>')">Agregar al carrito</button>         
                </div>
            </div>
        </div>
      
      
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
            }
        })
    }

</script>

<script src="../Util/js/jquery.min.js"></script>
<script src="../Util/js/jquery.validate.min.js"></script>

</body>

</html>



