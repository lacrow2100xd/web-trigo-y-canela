<?php
require_once 'config/config.php';
require_once 'config/database.php';
require_once 'vendor/autoload.php';

MercadoPago\SDK::setAccessToken(TOKEN_MP);

$preference = new MercadoPago\Preference();
$productos_mp = array();

$db = new Database();
$con = $db->conectar();


$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$lista_carrito = array();

if($productos != null){
    foreach($productos as $clave => $cantidad){

        $sql = $con->prepare("SELECT id, nombre, imagen, precio, descuento, $cantidad AS cantidad FROM productos WHERE 
        id=? AND activo=1");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);

    }
}else{
    header("location: index.php");
    exit;
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
    <link rel="stylesheet" href="css/checkout.css">
    <link rel="stylesheet" href="css/pago.css">

    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID; ?>&currency=<?php echo CURRENCY; ?>"></script>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
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
            <div class="col-6">
                <h4>Detalles de pago</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>Producto</th>  
                            <th>Subtotal</th> 
                        </tr>
                    
                    <tbody>
                        <?php if($lista_carrito == null){
                            echo '<tr><td class="colspan="5" class="text-center"> <b> Lista vacia</b></td></tr>';
                        }else{
                            $total = 0;
                            foreach($lista_carrito as $producto){
                                $_id = $producto['id'];
                                $nombre = $producto['nombre'];
                                $precio = $producto['precio'];
                                $descuento = $producto['descuento'];
                                $cantidad = $producto['cantidad'];
                                $precio_desc = $precio - (($precio * $descuento)/100);
                                $subtotal = $cantidad * $precio_desc;
                                $total += $subtotal;

                                $item = new MercadoPago\Item();
                                $item->id = $_id;
                                $item->title =  $nombre;
                                $item->quantity = $cantidad;
                                $item->unit_price = $precio_desc;
                                $item->currency_id = 'USD';

                                array_push($productos_mp,$item);
                                unset($item);
                                ?>
                    
                            <tr>
                            <td><?php echo $nombre; ?></td>                    
                            <td>
                                <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA . 
                                number_format($subtotal, 0, '.', ','); ?> </div>
                            </td>
                            </tr>
                            <?php } ?>

                            <tr>
                                <td></td>
                                <td colspan="5">
                                    <p class="h4" id="total">
                                        <?php echo MONEDA . number_format($total, 0, '.', ','); ?>
                                    </p>
                                </td>
                            </tr>

                        </tbody>

                    <?php } ?>
                    </table> 
                </div>
            </div>
            <div class="col-6">
            
            </div>  
            <div class="col-6">
                <h4>Metodos de pago</h4>
                
                <div id="paypal-button-container"></div>
            </div>  
            <div class="col-6">
                
            </div>
            <div class="col-6">
                <div id="wallet_container"></div>
            </div>
        </div>
    </div>

</main>

<?php

$preference->items = $productos_mp;

$preference->back_urls = array(
    "success" => "http://localhost/trigo-y-canela/captura.php",
    "failure" => "http://localhost/trigo-y-canela/fallo.php",
);

$preference->auto_return = "approved";
$preference->binary_mode = true;

$preference->save();


?>


<script>
        paypal.Buttons({
            style:{
                label:'pay'
            },
            createOrder: function(data, actions){
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: <?php echo $total; ?>
                        }
                    }]
                });
            },
            onApprove: function(data, actions){
                let URL = 'clases/captura.php'
                actions.order.capture().then(function (detalles){
                    console.log(detalles)

                    let url = 'clases/captura.php'

                    return fetch(url, {
                    method: 'post',
                    headers: {
                        'content-type': 'application/json'
                    },
                    body: JSON.stringify({
                        detalles: detalles
                    })
                }).then(function (response) {
                    window.location.href = '../trigo-y-canela/index.php';
                });
            });
            },
            onCancel: function(data){
                alert("Pago cancelado");
                console.log(data)
            }
        }).render('#paypal-button-container');

        const mp = new MercadoPago('TEST-8b8d145e-05af-4049-9827-d02bc207a236',{
            locale: 'es-CO'
            
        });

        mp.bricks().create("wallet", "wallet_container",{
            initialization: {
                preferenceId: '<?php echo $preference->id; ?>',
                redirectMode: 'modal'
            },
            customization: {
                texts:{
                    action: 'buy',
                    valueProp: 'security_details'
                }
            }
        })

    </script>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>

