<?php
require_once 'config/config.php';
require_once 'config/database.php';
$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT id, nombre, imagen, precio FROM productos WHERE activo=1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trigo y canela</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/tiendas.css">
    <link rel="stylesheet" href="css/estilos.footer.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
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
              <a href="index.php" class="nav-link btn rounded-pill">Inicio</a>
          </li>
          <li class="nav-item">
              <a href="productos.php" class="nav-link btn rounded-pill">Productos</a>
          </li>
          <li class="nav-item">
              <a href="nosotros.php" class="nav-link btn rounded-pill">Nosotros</a>
          </li>
          <li class="nav-item">
              <a href="servicios.php" class="nav-link btn rounded-pill ">Servicios</a>
          </li>
          <li class="nav-item">
              <a href="tiendas.php" class="nav-link active btn rounded-pill">Tiendas</a>
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

<div id="mi_mapa"></div>






<?php 
include("footer.php");
?>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
   let map = L.map('mi_mapa').setView([4.666, -74.070],6)
   L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);
  

  L.marker([6.176142, -75.649903]).addTo(map).bindPopup("Calle 51 Sur # 48 – 57 Local 9910")
  L.marker([6.18471, -75.65636]).addTo(map).bindPopup("Calle 51 Sur # 48 – 57 Local 358")
  L.marker([6.37929, -75.44329]).addTo(map).bindPopup("Cra. 43a # 6 Sur – 15 Local 1324")
  L.marker([6.18471, -75.65636]).addTo(map).bindPopup("Calle 51 Sur # 48 – 57 Local 358")
  L.marker([8.7493, -75.8750]).addTo(map).bindPopup("Cra 66 B # 34 A 76")
  L.marker([6.1465, -75.3731]).addTo(map).bindPopup("Cra. 43a # 18 Sur – 166")
  L.marker([5.0582, -75.5083]).addTo(map).bindPopup("Cra. 52 # 43-31")
  L.marker([4.5911, -74.2099]).addTo(map).bindPopup("Circular 1 # 70 – 018")
  L.marker([4.7419, -74.0533]).addTo(map).bindPopup("Carrera 81 # 37 – 100")
  L.marker([4.7241, -74.1261]).addTo(map).bindPopup("Cra. 65 # 8 B 91 Local 146")
  L.marker([4.4323, -75.2138]).addTo(map).bindPopup("Cra. 65a # 13 – 157 Local 27 – 28")
  L.marker([4.6007, -74.0781]).addTo(map).bindPopup("Entrada 4, Sala 9 Frente al counter de Avianca")
  L.marker([3.226, -76.553]).addTo(map).bindPopup("Carrera. 64c # 78 – 580")
  L.marker([2.382, -76.641]).addTo(map).bindPopup("Carrera 43A # 8 – 36")
  L.marker([4.5830, -74.1234]).addTo(map).bindPopup("Calle 82 11-75 Local 124")
  L.marker([4.8049, -75.7013]).addTo(map).bindPopup("Cra. 71d # 6 – 94 Sur Local 1908")
  L.marker([5.687, -76.663]).addTo(map).bindPopup("Av. Cra. 7 # 115 – 60 Local 220")
  L.marker([4.8049, -75.7013]).addTo(map).bindPopup("Calle 119 # 14 – 10")
  L.marker([6.482, -74.413]).addTo(map).bindPopup("Cra 68b # 25 B – 80")
  L.marker([5.506, -73.345]).addTo(map).bindPopup("Calle 95 # 13 – 55")





  
  map.on('click', onMapClick)

  function onMapClick(e){
    alert("Posición: " + e.latlng)
  }


</script>
 
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</body>
</html>

