<?php
require_once 'config/config.php';
require_once 'config/database.php';
$db = new Database();
$con = $db->conectar();

$showSweetAlert = false;    

$idCategoria = $_GET['cat'] ?? '';
$orden = $_GET['orden'] ?? '';

$orders = [
  'asc' => 'nombre ASC',
  'desc' => 'nombre DESC',
  'precio_alto' => 'precio DESC',
  'precio_bajo' => 'precio ASC',
];

$order = $orders[$orden] ?? '';

if(!empty($order)){
  $order = "ORDER BY $order";
}


if(!empty($idCategoria)){
  $sql = $con->prepare("SELECT id, nombre, imagen, precio FROM productos WHERE activo=1 AND id_categoria = ? $order");
  $sql->execute([$idCategoria]);
}else{
  $sql = $con->prepare("SELECT id, nombre, imagen, precio FROM productos WHERE activo=1 $order");
  $sql->execute();
}
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

$sqlCategorias = $con->prepare("SELECT id, nombre FROM categorias WHERE activo=1");
$sqlCategorias->execute();
$categorias = $sqlCategorias->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trigo y canela</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/estilos.footer.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="css/productos.css">
    
    
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
              <a href="nosotros.php" class="nav-link btn rounded-pill">Nosotros</a>
          </li>
          <li class="nav-item">
              <a href="servicios.php" class="nav-link btn rounded-pill ">Servicios</a>
          </li>
          <li class="nav-item">
              <a href="tiendas.php" class="nav-link btn rounded-pill">Tiendas</a>
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
        <div class="col-2-5 margin-del-filtro">
          <div class="card shadow-sm"  style="border-radius: 0;">
            <div class="card-header">
              Categorias
            </div>
            <div class="list-group">
              <?php foreach($categorias as $categoria) {?>
                <a href="productos.php?cat=<?php echo $categoria['id'];?>" class="list-group-item list-group-item-action">
                  <?php echo $categoria['nombre'];?>
                </a>
                
              <?php } ?>
            </div>
          </div>
        </div>

        <div class="col-9-5">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3 justify-content-end g-4">
            <div class="col mb-2">
                <form action="productos.php" id="ordenForm" method="get" class="d-flex align-items-center flex-nowrap">
                    <input type="hidden" name="cat" id="cat" value="<?php echo $idCategoria; ?>">

                    
                    <select name="orden" id="cbx-order" class="form-select form-select-sm" onchange="submitForm()">
                        <option value="">Ordenar por</option>
                        <option value="precio_alto" <?php echo ($orden == 'precio_alto') ? 'selected' : ''; ?>>Precios más altos</option>
                        <option value="precio_bajo" <?php echo ($orden == 'precio_bajo') ? 'selected' : ''; ?>>Precios más bajos</option>
                        <option value="asc" <?php echo ($orden == 'asc') ? 'selected' : ''; ?>>Nombre A-Z</option>
                        <option value="desc" <?php echo ($orden == 'desc') ? 'selected' : ''; ?>>Nombre Z-A</option>
                    </select>
                </form>
              </div>
            </div>


       
       

        <div class="col-9-5">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3" id="productos_a_mostrar">
            <?php foreach($resultado as $row) {?>
            <div class="col mb-2 clase-especial">
              <div class="card shadow-sm " id="card-productos">
                <img src="Img/productos/<?php echo $row['imagen']?>" class="card-img-top img-fluid" id="card-img-top-productos" alt="Imagen responsiva">
                <div class="card-body" id="card-body-productos"> 
                  <h5 class="card-title "><?php echo $row['nombre']?> </h5>
                  
                  <p class="card-text">$<?php echo number_format($row['precio'], 0, '.',',');?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                    <a href="detalles.php?id=<?php echo $row['id']; ?>&token=<?php echo
                    hash_hmac('sha1',$row['id'],KEY_TOKEN); ?>" class="btn rounded-pill detalles">Detalles</a>
                    </div>
                    <button class="btn rounded-pill agregar" id="agregarCarrito" type="button" onclick="addProducto(<?php 
                        echo $row['id']; ?>, '<?php echo hash_hmac('sha1',$row['id'],KEY_TOKEN); ?>')">Agregar</button>                         
                  </div>          
                </div>
              </div>         
            </div>  
            <?php } ?>
          </div>
        </div>
      </div>
    </div>

    

</main>

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
                elemento.innerHTML = data.numero;
            }else{ 
              toastr.error('No hay existencias disponibles');
            }
        })
    }

    function submitForm(){
      document.getElementById('ordenForm').submit();
    }

</script>

<?php 
include("footer.php");
?>



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
