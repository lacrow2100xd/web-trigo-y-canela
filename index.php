<?php
require_once 'config/config.php';
require_once 'config/database.php';
$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT id, nombre, 
       CASE 
           WHEN CHAR_LENGTH(valor) > 120 THEN 
               TRIM(SUBSTRING(valor, 1, LOCATE(' ', valor, 120) - 1)) 
           ELSE 
               valor 
       END AS valor, 
       imagen 
FROM articulos 
WHERE activo = 1;");
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
    <link rel="stylesheet" href="css/inicio.css">
    <link rel="stylesheet" href="css/estilos.footer.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>
<body>
    
<header data-bs-theme="white">
  
  <div class="navbar navbar-expand-lg navbar-white bg-white ">
    <div class="container">
      <a href="#" class="navbar-brand">
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
              <a href="#" class="nav-link active btn rounded-pill">Inicio</a>
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

<div class="slider">
    <div class="slides">
        <img src="Img/Bolleria.jpg" alt="Imagen 1">
        <img src="Img/amasando-pan.jpg" alt="Imagen 2">
        <img src="Img/Pasteleria.jpg" alt="Imagen 3">
        <img src="Img/Panes.jpg" alt="Imagen 4">
    </div>
    <div class="indicators">
        <span class="indicator" data-index="0"></span>
        <span class="indicator" data-index="1"></span>
        <span class="indicator" data-index="2"></span>
        <span class="indicator" data-index="3"></span> 
    </div>
    <button class="nav-button left" onclick="prevSlide()"><i class="fa-solid fa-chevron-left"></i></button>
    <button class="nav-button right" onclick="nextSlide()"><i class="fa-solid fa-chevron-right"></i></button>
</div>

<div class="container custom-container">
    <div class="row align-items-center custom-row">
        <div class="col-md-6">
            <div class="img-container">
                <img src="Img/pngtree-brown-bread-shot-on-white.png" alt="Pan caliente de trigo y canela" class="img-fluid">
            </div>
        </div>
        <div class="col-md-6">
            <p id="super-titulo">Hablemos de <span id="color">Pan</span></p>
            <strong>Trigo y canela</strong>
            <p class="mt-2">En nuestros más de 100 años de historia, nuestra máxima no ha cambiado. “El mejor pan se hace con los mejores ingredientes.” Bollería y pastelería de alta calidad y procesos inspirados en técnicas artesanales, conservan el mismo espíritu en los más de 200 establecimientos de Trigo y Canela.</p>
        </div>
    </div>
</div>

<div class="container custom-container2">
    <div class="row align-items-center custom-row">
        <div class="col-md-6">
            <h2 class="titulos">Por que nuestro pan es unico</h2>
           
            <p class="mt-3">El secreto de todos nuestros panes son las largas fermentaciones, unas recetas creadas por los mejores Chefs, y que ahora también se utilizan en Trigo y canela.

            Varios años testeando nuestras masas nos han permitido conseguir la acidez, textura y humedad en miga que hacen de nuestro pan un producto único. 

            Debido a los procesos de elaboración creados en Trigo y canela, conseguimos un pan exquisito en olor y sabor y lo más importante, que tiene una mayor vida útil a la del resto de pan que hay en el mercado.</p>
        </div>
        <div class="col-md-6">
            <div class="img-container">
                <img src="Img/Pan-Abierto.png" alt="Pan caliente de trigo y canela" class="img-fluid">
            </div>

           
        </div>
    </div>
</div>

<div class="container container-icons">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card card-tarjetitas shadow-sm"> 
                <div class="svg-container">
                    <svg fill="#ffffff" height="45px" width="45px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 511.999 511.999" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M354.761,154.586c-5.926,0-11.74,0.49-17.408,1.419c16.182-18.799,25.979-43.243,25.979-69.936 c0-4.734-3.838-8.572-8.572-8.572c-23.543,0-45.335,7.624-63.049,20.527c1.177-6.406,1.785-12.965,1.785-19.618 c0-28.67-11.165-55.623-31.438-75.896c-3.348-3.348-8.775-3.348-12.122,0c-20.273,20.272-31.437,47.226-31.437,75.896 c0,6.653,0.609,13.212,1.785,19.618c-17.714-12.902-39.506-20.527-63.049-20.527c-4.734,0-8.572,3.838-8.572,8.572 c0,26.684,9.79,51.121,25.965,69.918c-5.697-0.922-11.508-1.401-17.393-1.401c-4.734,0-8.572,3.838-8.572,8.572 c0,26.692,9.797,51.137,25.979,69.936c-5.668-0.929-11.481-1.419-17.408-1.419c-4.734,0-8.572,3.838-8.572,8.572 c0,26.692,9.797,51.137,25.979,69.936c-5.668-0.929-11.482-1.419-17.408-1.419c-4.734,0-8.572,3.838-8.572,8.572 c0,56.299,43.57,102.609,98.762,106.99v79.102c0,4.734,3.838,8.572,8.572,8.572s8.572-3.838,8.572-8.572v-79.102 c55.191-4.382,98.761-50.693,98.761-106.99c0-4.734-3.838-8.572-8.572-8.572c-5.927,0-11.74,0.49-17.408,1.419 c16.184-18.799,25.979-43.244,25.979-69.936c0-4.734-3.838-8.572-8.572-8.572c-5.926,0-11.74,0.49-17.408,1.419 c16.182-18.799,25.979-43.244,25.979-69.936C363.333,158.424,359.495,154.586,354.761,154.586z M345.741,95.089 c-4.245,42.544-38.18,76.479-80.723,80.723C269.263,133.269,303.199,99.333,345.741,95.089z M238.679,191.998 c5.64,0.919,11.425,1.405,17.321,1.405c5.926,0,11.74-0.49,17.408-1.419c-7.131,8.284-13.02,17.663-17.378,27.848 C251.755,209.802,245.933,200.423,238.679,191.998z M273.406,269.073c-7.146,8.301-13.046,17.704-17.408,27.916 c-4.361-10.212-10.261-19.613-17.408-27.916c5.668,0.929,11.481,1.419,17.408,1.419 C261.925,270.492,267.739,270.002,273.406,269.073z M256,21.32c13.185,16.068,20.355,36.027,20.355,57.087 s-7.171,41.019-20.355,57.088c-13.185-16.069-20.355-36.028-20.355-57.088C235.645,57.346,242.814,37.388,256,21.32z M166.257,95.089c42.543,4.245,76.478,38.18,80.723,80.723C204.437,171.567,170.502,137.631,166.257,95.089z M166.257,172.178 c42.543,4.245,76.478,38.179,80.723,80.723C204.437,248.656,170.502,214.721,166.257,172.178z M166.257,249.266 c42.543,4.245,76.478,38.18,80.723,80.723C204.437,325.744,170.502,291.809,166.257,249.266z M166.257,326.356 c42.543,4.245,76.478,38.18,80.723,80.723C204.436,402.833,170.501,368.898,166.257,326.356z M255.999,374.077 c-4.361-10.212-10.262-19.613-17.409-27.916c5.669,0.929,11.483,1.419,17.409,1.419c5.927,0,11.74-0.49,17.409-1.419 C266.261,354.463,260.361,363.865,255.999,374.077z M345.741,326.356c-4.245,42.543-38.18,76.478-80.723,80.723 C269.263,364.536,303.199,330.6,345.741,326.356z M345.741,249.266c-4.245,42.544-38.18,76.478-80.723,80.723 C269.263,287.446,303.199,253.511,345.741,249.266z M265.014,252.902c2.04-20.683,11.083-39.865,25.974-54.756 c14.891-14.89,34.071-23.932,54.755-25.974C341.501,214.723,307.563,248.661,265.014,252.902z"></path> </g> </g> </g></svg>
                </div>
                
                <div class="card-body">
                    <h5 class="card-title mt-2">Ingredientes naturales</h5>
                    <p class="card-text card-text-tarjetitas">Sin saborizantes ni colorantes artificiales. Seleccionamos con rigor todas las materias primas y utilizamos productos de origen local o de proximidad.</p>
                    <button class="toggle-button btn btn-light no-hover">Saber más 
                      <i class="fa-solid fa-chevron-down" id="chevron-down" style="display: inline-block;"></i>
                      <i class="fa-solid fa-chevron-up" id="chevron-up" style="display: none;"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-tarjetitas shadow-sm">
                <div class="svg-container">
                    <svg fill="#ffffff" width="45px" height="45px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M6.9917,14.502a.99974.99974,0,0,0-1,1v1.78229a7.97243,7.97243,0,0,1-2-5.28229,7.29085,7.29085,0,0,1,.05273-.87988.99992.99992,0,1,0-1.98535-.24023A9.17334,9.17334,0,0,0,1.9917,12.002a9.96434,9.96434,0,0,0,2.41687,6.5H2.9917a1,1,0,1,0,0,2h4a.98173.98173,0,0,0,.79413-.42181c.01166-.01538.02655-.0268.03741-.043.00666-.00995.00684-.02173.01306-.03186a.96576.96576,0,0,0,.106-.2583.95234.95234,0,0,0,.03143-.15589c.00287-.03088.018-.05749.018-.08911v-4A.99974.99974,0,0,0,6.9917,14.502Zm1.5-8.5H6.70923a7.9737,7.9737,0,0,1,5.28247-2,7.07475,7.07475,0,0,1,.87939.05274,1.00046,1.00046,0,0,0,.24121-1.98633A9.22717,9.22717,0,0,0,11.9917,2.002a9.96421,9.96421,0,0,0-6.5,2.41669V3.002a1,1,0,0,0-2,0v4a.95355.95355,0,0,0,.03931.19471l.00024.00122a.96893.96893,0,0,0,.14117.345l.01142.0169a.97291.97291,0,0,0,.2445.24634c.01093.008.01636.02026.02771.02789.01429.00946.03046.01246.04505.02112a.95817.95817,0,0,0,.17932.084.98784.98784,0,0,0,.26184.05285c.01733.00092.03192.01.04944.01h4a1,1,0,0,0,0-2ZM20.45215,16.80609a.96745.96745,0,0,0-.14124-.34509l-.01129-.01679a.97315.97315,0,0,0-.24469-.24646c-.01092-.00793-.01629-.02026-.02759-.02783-.0108-.00714-.02362-.00738-.0346-.0141a1.15354,1.15354,0,0,0-.40973-.13543c-.03162-.003-.0589-.01844-.09131-.01844h-4a1,1,0,0,0,0,2h1.78241a7.97338,7.97338,0,0,1-5.28241,2,7.07446,7.07446,0,0,1-.8794-.05371,1.00046,1.00046,0,0,0-.24121,1.98633,9.36538,9.36538,0,0,0,1.12061.06738,9.96425,9.96425,0,0,0,6.5-2.41668V21.002a1,1,0,0,0,2,0v-4a.95345.95345,0,0,0-.03931-.1947ZM20.9917,5.502a1,1,0,0,0,0-2h-4a.9519.9519,0,0,0-.19183.0387l-.00666.00134a.96837.96837,0,0,0-.3407.13953l-.01959.01324a.974.974,0,0,0-.2453.24378c-.00787.0108-.02.01611-.02746.02728-.00714.01074-.00739.02344-.0141.03436a1.14563,1.14563,0,0,0-.13636.41266c-.00286.03089-.018.0575-.018.08911v4a1,1,0,1,0,2,0V6.71912a7.97527,7.97527,0,0,1,2,5.28283,7.289,7.289,0,0,1-.05274.87989,1.00106,1.00106,0,0,0,.87208,1.11328,1.02916,1.02916,0,0,0,.12207.00683.99971.99971,0,0,0,.99121-.87988A9.17363,9.17363,0,0,0,21.9917,12.002a9.96411,9.96411,0,0,0-2.417-6.5Z"></path></g></svg>
                </div>
                <div class="card-body">
                    <h5 class="card-title mt-2">Proceso artesanal</h5>
                    <p class="card-text card-text-tarjetitas ">En nuestro obrador cuidamos al máximo cada paso en la elaboración de nuestro pan.</p>
                    <button class="toggle-button btn btn-light no-hover">Saber más 
                      <i class="fa-solid fa-chevron-down" id="chevron-down" style="display: inline-block;"></i>
                      <i class="fa-solid fa-chevron-up" id="chevron-up" style="display: none;"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-tarjetitas shadow-sm">
                <div class="svg-container">
                <svg height="45px" width="45px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#ffffff;} </style> <g> <path class="st0" d="M482.01,226.209c-20.105-18.897-48.03-35.352-80.138-48.1c-7.233-2.873-7.326-2.633-7.326-2.633 c-3.052-1.1-6.458-0.472-8.921,1.65c-2.447,2.114-3.578,5.398-2.927,8.58c0,0,0.278-0.139,1.332,6.684 c3.376,21.584,2.866,36.855,2.85,44.313c-0.015,17.417-11.926,22.536-13.956,6.931c-4.212-29.924-25.416-77.69-25.416-77.69 c-1.038-3.199-3.78-5.546-7.11-6.079c0,0-12.855-5.182-37.466-7.024c-26.439-1.983-41.169-1.378-42.795,1.03 s-1.998,5.452-0.976,8.178c0,0,6.443,14.815,9.743,26.13c7.496,25.711,8.611,44.15,9.385,52.552 c1.596,17.339-13.025,21.15-16.324,7.938c-6.01-25.246-15.056-48.913-26.285-69.73c-5.173-9.595-13.692-21.847-13.692-21.847 c-1.905-3.036-5.421-4.646-8.968-4.112c0,0-23.016,2.718-37.111,5.614c-15.644,3.206-33.378,8.898-33.378,8.898 c-2.803,0.751-5.08,2.803-6.102,5.522c-1.022,2.726-0.666,5.769,0.96,8.178c0,0,10.501,13.979,16.557,24.642 c13.335,23.519,18.694,41.378,21.374,49.424c5.514,16.526-8.271,22.04-11.028,11.012c-11.554-23.108-27.104-43.794-43.616-61.319 c-7.465-7.93-18.137-17.401-18.137-17.401c-2.726-2.626-6.83-3.253-10.222-1.564c0,0-11.725,5.335-19.748,9.82 c-16.387,9.13-30.822,19.353-42.578,30.404C-17.59,270.925-9.66,360.348,61.711,360.348c71.371,0,194.289,0,194.289,0 s122.918,0,194.289,0C521.66,360.348,529.59,270.925,482.01,226.209z"></path> </g> </g></svg>
                </div>
                <div class="card-body">
                    <h5 class="card-title mt-2">Masa tradicional</h5>
                    <p class="card-text card-text-tarjetitas">100% artesanal, de larga fermentación.</p>
                    <button class="toggle-button btn btn-light no-hover">Saber más 
                      <i class="fa-solid fa-chevron-down" id="chevron-down" style="display: inline-block;"></i>
                      <i class="fa-solid fa-chevron-up" id="chevron-up" style="display: none;"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-tarjetitas shadow-sm">
                <div class="svg-container">
                    <svg fill="#ffffff" height="45px" width="45px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M226.932,399.948c-19.96,18.445-47.567,22.576-72.053,10.786c-8.852-4.263-16.322-10.149-22.17-17.199l-33.341,73.744 c-1.517,3.355,0.177,5.884,0.975,6.815c0.798,0.93,3.039,2.989,6.585,2.003l24.272-6.756c2.766-0.769,5.562-1.14,8.319-1.14 c11.631,0,22.578,6.583,27.849,17.492l10.962,22.685c1.601,3.315,4.604,3.646,5.854,3.621c1.226-0.016,4.242-0.414,5.758-3.769 l53.033-117.304C237.148,392.603,231.63,395.606,226.932,399.948z"></path> </g> </g> <g> <g> <path d="M412.631,467.279l-33.341-73.744c-5.848,7.051-13.318,12.937-22.17,17.199c-24.487,11.79-52.093,7.659-72.053-10.786 c-4.698-4.342-10.216-7.345-16.045-9.022l53.033,117.304c1.517,3.356,4.533,3.753,5.758,3.769c1.25,0.025,4.253-0.306,5.854-3.621 l10.962-22.685c5.27-10.909,16.218-17.492,27.849-17.492c2.757,0,5.554,0.371,8.319,1.14l24.272,6.756 c3.546,0.987,5.788-1.072,6.585-2.003C412.454,473.162,414.148,470.633,412.631,467.279z"></path> </g> </g> <g> <g> <path d="M438.821,207.791c-27.69-18.96-36.282-56.605-19.56-85.702c10.051-17.491,4.82-34.775-3.427-45.118 c-8.248-10.34-23.936-19.285-43.223-13.38c-32.084,9.827-66.877-6.925-79.201-38.141C286.002,6.686,269.227,0,256,0 c-13.227,0-30.002,6.686-37.41,25.451c-12.324,31.217-47.114,47.967-79.201,38.141c-19.289-5.904-34.974,3.039-43.223,13.38 c-8.247,10.343-13.478,27.625-3.427,45.118c16.722,29.096,8.13,66.742-19.56,85.702c-16.646,11.399-19.431,29.24-16.489,42.136 c2.942,12.896,13.194,27.761,33.137,30.808c33.174,5.068,57.248,35.256,54.809,68.727c-1.468,20.121,10.745,33.423,22.662,39.163 c11.918,5.739,29.932,6.995,44.748-6.698c12.322-11.387,28.141-17.083,43.953-17.083c15.818,0,31.628,5.693,43.952,17.083 c14.818,13.694,32.833,12.438,44.75,6.698c11.917-5.739,24.129-19.041,22.662-39.162c-2.439-33.471,21.635-63.659,54.809-68.728 c19.943-3.047,30.193-17.913,33.137-30.808C458.252,237.03,455.465,219.189,438.821,207.791z M256,335.923 c-72.575,0-131.619-59.044-131.619-131.619S183.424,72.684,256,72.684c72.576,0,131.619,59.044,131.619,131.619 C387.618,276.878,328.575,335.923,256,335.923z"></path> </g> </g> <g> <g> <path d="M255.999,97.225c-59.044,0-107.079,48.036-107.079,107.079c0,59.043,48.034,107.079,107.079,107.079 s107.079-48.036,107.079-107.079S315.043,97.225,255.999,97.225z M310.874,193.922l-66.642,48.675 c-2.115,1.545-4.653,2.362-7.237,2.362c-0.666,0-1.335-0.054-2.001-0.164c-3.249-0.537-6.147-2.358-8.041-5.054l-19.934-28.382 c-3.895-5.547-2.556-13.2,2.989-17.095c5.546-3.895,13.198-2.557,17.094,2.989l12.75,18.154l56.548-41.302 c5.473-3.995,13.15-2.803,17.146,2.671C317.543,182.248,316.346,189.924,310.874,193.922z"></path> </g> </g> </g></svg>
                </div>
                <div class="card-body">
                    <h5 class="card-title mt-2">Maxima calidad</h5>
                    <p class="card-text card-text-tarjetitas">Todo esto garantiza una inmejorable textura y completa homogeneidad en el pan, que refleja la calidad de Trigo y canela, para hacer un PAN ÚNICO.</p>
                    <button class="toggle-button btn btn-light no-hover">Saber más 
                      <i class="fa-solid fa-chevron-down" id="chevron-down" style="display: inline-block;"></i>
                      <i class="fa-solid fa-chevron-up" id="chevron-up" style="display: none;"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid content-container d-flex justify-content-center align-items-center">
    <div class="row">
        <div class="col text-center">
            <div class="card custom-card mt-5">
                <div class="card-body">
                    <h5 class="card-title">Trigo y canela cuenta con un método de elaboración del pan propio, que respeta los procesos tradicionales y las largas fermentaciones.</h5>
                    <p>En Trigo y Canela, valoramos la elaboración tradicional del pan. Es en nuestro obrador donde nacen recetas artesanas, únicas y con los mejores ingredientes. Nuestros panaderos realizan la mezcla y el amasado que caracterizan cada tipo de pan. El secreto de la calidad de nuestros productos radica en la cuidadosa selección de materias primas y en el proceso de fermentación de la masa, respetando los tiempos necesarios para que cada pan tenga la fuerza, el sabor y el aroma perfectos.

                    Gracias a este enfoque, garantizamos la durabilidad de nuestros panes durante varios días, al mismo tiempo que les otorgamos cuerpo, fuerza, volumen y esponjosidad, lo que facilita la digestión. En Trigo y Canela, preparamos masas únicas que se transforman en panes excepcionales con un sabor inigualable, asegurando así la fidelidad de nuestros clientes y confirmando que siempre somos su primera opción.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container custom-container3">
    <div class="row align-items-center custom-row">
        <div class="col-12">
            <h2 class="titulos text-center">Blog de pastelería y repostería</h2>
           
            <p class="text-center mt-3">Descubre deliciosas recetas de pastelería fáciles de preparar, recomendaciones gastronómicas y entretenidas historias sobre el origen de tus postres o tortas favoritas.</p>
        </div>

    </div>
</div>
<div class="container custom-container5 mb-5">
    <div class="row custom-row">
        <?php foreach($resultado as $row) { ?>
            <div class="col-md-4 d-flex">
                <div class="card flex-fill">
                    <img src="Img/articulos/<?php echo $row['imagen']?>.jpg" class="card-img-top" alt="Imagen <?php echo $row['nombre']?>">
                    <div class="card-body d-flex flex-column"> <!-- d-flex y flex-column -->
                        <h5 class="card-title"><?php echo $row['nombre']?></h5>
                        <p class="card-text"><?php echo substr($row['valor'], 0, 100) . '...'; ?></p>
                        <div class="mt-auto"> <!-- mt-auto para empujar hacia abajo -->
                            <a href="#" class="btn btn-warning">Ver más »</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>



<script>
  const slides = document.querySelector('.slides');
    const indicators = document.querySelectorAll('.indicator');
    let currentIndex = 0;

    // Función para mostrar la imagen actual
    function showSlide(index) {
        const totalSlides = indicators.length;
        currentIndex = (index + totalSlides) % totalSlides; // Evita sobrepasar el índice
        slides.style.transform = `translateX(-${currentIndex * 100}%)`;

        // Actualiza los indicadores
        indicators.forEach((indicator, i) => {
            indicator.classList.toggle('active', i === currentIndex);
        });
    }

    // Función para ir a la imagen anterior
    function prevSlide() {
        showSlide(currentIndex - 1);
    }

    // Función para ir a la imagen siguiente
    function nextSlide() {
        showSlide(currentIndex + 1);
    }

    // Cambia automáticamente las imágenes cada 6 segundos
    setInterval(() => {
        nextSlide();
    }, 6000);

    // Configura los eventos de clic en los indicadores
    indicators.forEach((indicator) => {
        indicator.addEventListener('click', () => {
            const index = parseInt(indicator.getAttribute('data-index'));
            showSlide(index);
        });
    });

    // Inicializa el slider mostrando la primera imagen
    showSlide(currentIndex);

    document.querySelectorAll('.toggle-button').forEach(button => {
        button.addEventListener('click', () => {
            const cardText = button.previousElementSibling; // Obtener el texto anterior (p.card-text)
            const chevronDown = button.querySelector('#chevron-down');
            const chevronUp = button.querySelector('#chevron-up');

            if (cardText.style.display === 'block') {
                cardText.style.display = 'none'; // Oculta el texto
                chevronDown.style.display = 'inline-block'; // Muestra el chevron hacia abajo
                chevronUp.style.display = 'none'; // Oculta el chevron hacia arriba
            } else {
                cardText.style.display = 'block'; // Muestra el texto
                chevronDown.style.display = 'none'; // Oculta el chevron hacia abajo
                chevronUp.style.display = 'inline-block'; // Muestra el chevron hacia arriba
            }
        });
    });
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

