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
    
    <link rel="stylesheet" href="css/servicios.css">
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
              <a href="nosotros.php" class="nav-link btn rounded-pill">Nosotros</a>
          </li>
          <li class="nav-item">
              <a href="#" class="nav-link active btn rounded-pill ">Servicios</a>
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


<div class="background-div">
    <div class="container-fluid">
        <div class="row h-100 row-class-mia">
            <!-- Primera columna con la imagen -->
            <div class="col-md-6 col-md-mia p-0">
                <div class="img-container" style="position: relative;"> <!-- Contenedor para la imagen y el degradado -->
                    <img src="Img/croissants.jpg" alt="Pan caliente de trigo y canela" class="img-fluid">
                    <div class="degradado"></div> <!-- Degradado agregado aquí -->
                </div>
            </div>
            <!-- Segunda columna con texto -->
            <div class="col-md-6 col-md-mia p-0">
                <div class="card card-mia">
                    <div class="card-body">
                        <h1 class="titulos">Refrigerios para eventos <br>y regalos corporativos</h1>
                        <p class="parrafo-grande mt-3">La excelente calidad de nuestros productos y servicio oportuno, han hecho que clientes empresariales confíen en nosotros.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container custom-container3">
    <div class="row align-items-center custom-row">
        <div class="col-md-6">
            <h2 class="titulos">Regalos corporativos</h2>
            <p class="parrafo-grande mt-3">Cualquier ocasión es la excusa perfecta para que los miembros de tu equipo se sientan valorados y aumenten su sentido de pertenencia. Sorpréndelos en fechas especiales con productos artesanales.</p>
        </div>
        <div class="col-md-6" > <!-- Agrega la clase ms-3 aquí -->
            <div class="img-container">
                <img src="Img/Refrigerios-caja-de-galletas-scaled-Photoroom (1).png" alt="Pan caliente de trigo y canela" class="img-fluid">
            </div>    
        </div>
    </div>
</div>

<div class="container-fluid contenedor-lado-lado-servicios mt-5">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center titulos">
            Refrigerios para todo tipo de eventos
            </h2>   
            <p class="parrafo-grande mt-3">En las reuniones y eventos corporativos siempre necesitamos una pausa para deleitarnos. Así que te ofrecemos nuestros combos para refrigerios:</p>
        </div>
    </div>
</div>

<div class="container custom-container4 mb-5">
    <div class="row align-items-center custom-row">
        <div class="col-md-6">
            <ul class="list-unstyled"> <!-- Cambia a una lista desordenada -->
                <li class="parrafo-grande">Productos de sal</li>
                <li class="parrafo-grande">Productos dulces</li>
                <li class="parrafo-grande">Sánduches</li>
                <li class="parrafo-grande">Bebidas frías</li>
                <li class="parrafo-grande">Tortas</li>
                <li class="parrafo-grande">Copa de frutas</li>
                <li class="parrafo-grande">Variedad de frutas</li>
                <li class="parrafo-grande">Otras referencias de la línea de postres, galletas y chocolates.</li>
            </ul>
        </div>
        <div class="col-md-6" > <!-- Agrega la clase ms-3 aquí -->
            <div class="img-container">
                <img src="Img/refrigerio-premium.jpg" alt="Pan caliente de trigo y canela" class="img-fluid">
            </div>    
        </div>
    </div>
</div>


<div class="container custom-container5 mb-5">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-servicios-a">
                <img src="Img/babette.jpg" alt="Descripción de la imagen 1" class="card-img-top-a">
                <div class="card-body">
                    <h2 class="card-title titulos text-center">Distribuidores</h2>
                    <p class="card-text parrafo-mediano">Nuestros productos están presentes en los principales almacenes de cadena del país, gracias a esta modalidad más de doce ciudades de Colombia pueden disfrutar de los deliciosos sabores tradicionales.

                    Conoce los privilegios de ser un distribuidor de Pastelería Santa Elena.</p>
                    <a href="#" class="btn">Descubre aqui los detalles</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-servicios-a">
                <img src="Img/asi-es-el-panorama-actual-de-las-panaderias-en-colombia.jpg" alt="Descripción de la imagen 2" class="card-img-top-a">
                <div class="card-body">
                    <h2 class="card-title titulos text-center">Exportaciones</h2>
                    <p class="card-text parrafo-mediano text-left">La producción artesanal, los sabores tradicionales y los empaques sofisticados de nuestros productos nos han permitido entrar a mercados internacionales como Estados Unidos, Costa Rica y España.</p>
                    <br>
                    <a href="#" class="btn">Descargar portafolio de exportaciones</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container faq-container mb-5">
<h2 class="titulos text-center mb-3">Preguntas frecuentes sobre nuestros servicios</h2>
    <div class="faq-item">
        <div class="faq-question" onclick="toggleAnswer(this)">
            <span>¿Qué tipo de refrigerios corporativos ofrecemos en Pastelería Santa Elena?</span>
            <button class="faq-toggle">+</button>
        </div>
        <div class="faq-answer">
            <p class="p-faq">Nos dedicamos a deleitar a todos nuestros clientes a diario y nos encanta estar presentes en los eventos corporativos con nuestra variedad de opciones, con las que podrás armar tu combo para todos tus invitados. Los productos que ofrecemos son: productos de sal, productos dulces, sánduches y pasteles crujientes, Parfaits, bebidas frías (gaseosas, jugos y agua), deliciosas tortas, otras referencias de la línea de postres, galletas y chocolates.</p>
            <p class="p-faq">Antes de realizar tu cotización, verifica cobertura y disponibilidad al número de WhatsApp 3206775833</p>
        </div>
    </div>

    <div class="faq-item">
        <div class="faq-question" onclick="toggleAnswer(this)">
            <span>¿Para qué tipo de eventos son nuestros regalos corporativos en Pastelería Santa Elena?</span>
            <button class="faq-toggle">+</button>
        </div>
        <div class="faq-answer">
            <p class="p-faq">Nuestros refrigerios para eventos y regalos empresariales son para cada ocasión en la que quieras deleitar a tus invitados: cumpleaños, aniversarios empresariales, temporada navideña, reuniones, celebraciones corporativas y cada evento en el que quieras encantar a los presentes con nuestros productos artesanales.</p>
        </div>
    </div>

    <div class="faq-item">
        <div class="faq-question" onclick="toggleAnswer(this)">
            <span>¿Cuál es el horario de atención?</span>
            <button class="faq-toggle">+</button>
        </div>
        <div class="faq-answer">
            <p class="p-faq">Nuestro horario de atención es de lunes a viernes de 8:00 am a 6:00 pm.</p>
        </div>
    </div>
</div>




<script>
   function toggleAnswer(questionElement) {
    const answerElement = questionElement.nextElementSibling;
    const toggleButton = questionElement.querySelector(".faq-toggle");

    if (answerElement.style.maxHeight) {
        // Si la respuesta está abierta, la cerramos
        answerElement.style.maxHeight = null;
        toggleButton.textContent = "+";
    } else {
        // Si la respuesta está cerrada, calculamos su altura y la mostramos
        answerElement.style.maxHeight = answerElement.scrollHeight + "px";
        toggleButton.textContent = "-";
    }
}


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

