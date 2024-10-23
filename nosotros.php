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
    <link rel="stylesheet" href="css/nosotros.css">
    <link rel="stylesheet" href="css/estilos.footer.css">
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
              <a href="nosotros.php" class="nav-link active btn rounded-pill">Nosotros</a>
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

<div class="banner">
    <div class="banner-text">
        <h1>¿QUIÉNES SOMOS?</h1>
    </div>
</div>

<div class="container-fluid custom-container">
    <div class="row align-items-center custom-row">
        <div class="col-md-6">
            <p id="titulo-somos">Panadería <br>Trigo y Canela</p>
            <p class="parrafo-grande">Somos una <span class="resaltado">franquicia</span> con más de 100 años de experiencia en la elaboración y venta de productos artesanales de repostería y pastelería en Colombia. Contamos con 130 puntos de venta y un equipo humano dispuesto siempre a brindar la mejor experiencia.</p>
        </div>
        <div class="col-md-6">
            <div class="img-container">
                <img src="Img/f1f7885395b34553a1f850415f4f92c5_editor.webp" alt="Pan caliente de trigo y canela" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<div class="container-fluid contenedor-lado-lado mt-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mensaje-movimiento">
                <span class="msj-dorado">Somos mucho más que pan</span> <br> Somos una familia de más de <span class="msj-dorado">+</span><span class="msj-dorado" id="numero">0</span> profesionales.
            </h1>   
        </div>
    </div>
</div>

<div class="container-fluid custom-container">
    <div class="row align-items-start custom-row">
        <div class="col-md-6 d-flex flex-column justify-content-start">
            <p id="subtitulo-somos">Misión</p>
            <p class="parrafo-grande">En Pastelería Trigo y Canela nos comprometemos a deleitar con cariño y calidez a nuestros clientes, para esto, día a día nos fortalecemos, adaptamos y trabajamos en equipo.
            Además, buscamos innovar sin dejar de lado una tradición llena de sabor y liderar en el desarrollo de productos de pastelería con creatividad.</p>
        </div>
        <div class="col-md-6 d-flex flex-column justify-content-start">
            <p id="subtitulo-somos">Propuesta de valor</p>
            <p class="parrafo-grande">Usamos técnicas de cocina internacional para desarrollar recetas de elaboración artesanal con ingredientes locales, típicos de Colombia.</p>
        </div>
    </div>
</div>


<div class="container-fluid contenedor-lado-lado-clientes mt-5 mb-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mensaje-movimiento mt-5" >
                <p>Nuestros clientes<p>    
            </h1>
            <p class="parrafo-grande text-center">La experiencia y la calidad de nuestros servicios nos han permitido trabajar con grandes organizaciones como</p>
            

<div class="slider contenedor-de-clientes">
    <div class="slide-track">
        <div class="slide">
            <img src="Img/sodexo.webp" alt="">
        </div>
        <div class="slide">
            <img src="Img/sodimac.webp" alt="">
        </div>
        <div class="slide">
            <img src="Img/eafit.webp" alt="">
        </div>
        <div class="slide">
            <img src="Img/familia.webp" alt="">
        </div>
        <div class="slide">
            <img src="Img/kimberly.webp" alt="">
        </div>
        <div class="slide">
            <img src="Img/orbis.webp" alt="">
        </div>
        <div class="slide">
            <img src="Img/procolombia.webp" alt="">
        </div>

        <div class="slide">
            <img src="Img/sodexo.webp" alt="">
        </div>
        <div class="slide">
            <img src="Img/sodimac.webp" alt="">
        </div>
        <div class="slide">
            <img src="Img/eafit.webp" alt="">
        </div>
        <div class="slide">
            <img src="Img/familia.webp" alt="">
        </div>
        <div class="slide">
            <img src="Img/kimberly.webp" alt="">
        </div>
        <div class="slide">
            <img src="Img/orbis.webp" alt="">
        </div>
        <div class="slide">
            <img src="Img/procolombia.webp" alt="">
        </div>
    </div>
</div>
        </div>
    </div>
</div>



<script>
    // Función para animar el número
    function animateNumber(targetNumber, duration) {
        const numberElement = document.getElementById('numero');
        let currentNumber = 0;
        const startTime = performance.now();

        const updateNumber = () => {
            const elapsedTime = performance.now() - startTime;
            const progress = Math.min(elapsedTime / duration, 1); // Progreso entre 0 y 1
            currentNumber = Math.floor(progress * targetNumber); // Calcular el número actual
            
            numberElement.textContent = currentNumber;

            if (progress < 1) {
                requestAnimationFrame(updateNumber); // Continúa la animación
            } else {
                numberElement.textContent = targetNumber; // Asegúrate de que se establezca el número final
            }
        };

        requestAnimationFrame(updateNumber); // Iniciar la animación
    }

    // Configuración del Intersection Observer
    const options = {
        root: null, // El viewport del navegador
        rootMargin: '0px',
        threshold: 0.1 // Porcentaje del elemento visible antes de disparar la animación
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateNumber(600, 4000); // Iniciar la animación
                observer.unobserve(entry.target); // Dejar de observar después de la animación
            }
        });
    }, options);

    // Observa el elemento que contiene el número
    const targetElement = document.querySelector('.mensaje-movimiento');
    observer.observe(targetElement);
</script>

<?php 
include("footer.php");
?>

    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

