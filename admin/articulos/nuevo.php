
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

$sql = "SELECT id, nombre FROM categorias WHERE activo = 1";
$resultado = $con->query($sql);
$categorias = $resultado->fetchAll(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
    <title>Blank Page | PlainAdmin Demo</title>

    <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>css/lineicons.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>css/fullcalendar.css" />
    <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>css/main.css" />
    <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>css/inicio.admin.css" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.css" />



    
  </head>
  <body>
    <!-- ======== Preloader =========== -->
   
    <!-- ======== Preloader =========== -->

    <!-- ======== sidebar-nav start =========== -->
    <aside class="sidebar-nav-wrapper">
       
          <div class="navbar-logo d-flex align-items-center">
              <a href="../inicio.php" class="d-flex align-items-center">
                <img src="../../Img/Diseño_sin_título__1_-removebg-preview.png" height="40" width="40" alt="logo" /><strong class="navbar-text">Trigo y canela</strong>
              </a>
          </div>
       
      <nav class="sidebar-nav">
        <ul>
          <li class="nav-item nav-item-has-children">
            <a
              href="#0"
              class="collapsed"
              data-bs-toggle="collapse"
              data-bs-target="#ddmenu_1"
              aria-controls="ddmenu_1"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M8.74999 18.3333C12.2376 18.3333 15.1364 15.8128 15.7244 12.4941C15.8448 11.8143 15.2737 11.25 14.5833 11.25H9.99999C9.30966 11.25 8.74999 10.6903 8.74999 10V5.41666C8.74999 4.7263 8.18563 4.15512 7.50586 4.27556C4.18711 4.86357 1.66666 7.76243 1.66666 11.25C1.66666 15.162 4.83797 18.3333 8.74999 18.3333Z" />
                  <path
                    d="M17.0833 10C17.7737 10 18.3432 9.43708 18.2408 8.75433C17.7005 5.14918 14.8508 2.29947 11.2457 1.75912C10.5629 1.6568 10 2.2263 10 2.91665V9.16666C10 9.62691 10.3731 10 10.8333 10H17.0833Z" />
                </svg>
              </span>
              <span class="text">Panel de control</span>
            </a>
            <ul id="ddmenu_1" class="collapse dropdown-nav">
              <li>
                <a href="index.html"> eCommerce </a>
              </li>
            </ul>
          </li>
          
            <li class="nav-item">
                <a href="<?php echo ADMIN_URL; ?>configuracion">
                  <span class="icon">
                    <i class="fa-solid fa-gear"></i>
                  </span>
                  <span class="text">Configuracion</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?php echo ADMIN_URL; ?>categorias">
                <span class="icon">
                <i class="fa-solid fa-tags"></i>
                </span>
                <span class="text">Categorias</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo ADMIN_URL; ?>productos">
                <span class="icon">
                <i class="fa-solid fa-box"></i>
                </span>
                <span class="text">Productos</span>
                </a>
            </li>
        
        </ul>
      </nav>
     
    </aside>
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
      <!-- ========== header start ========== -->
      <header class="header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-5 col-md-5 col-6">
              <div class="header-left d-flex align-items-center">
                <div class="menu-toggle-btn mr-15">
                  <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                    <i class="lni lni-chevron-left me-2"></i> Menu
                  </button>
                </div>
                
              </div>
            </div>
            <div class="col-lg-7 col-md-7 col-6">
              <div class="header-right">
                <!-- notification start -->
                
                <!-- notification end -->
                <!-- message start -->
                
                <!-- message end -->
                <div class="profile-box ml-15">
    <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile" data-bs-toggle="dropdown" aria-expanded="false">
        <div class="profile-info">
            <div class="info">
                <div class="image" style="width: 40px; height: 40px; border-radius: 50%; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                    <!-- Ajustando el tamaño del ícono -->
                    <i class="fas fa-user" style="font-size: 25px;"></i>
                </div>
                <div>
                    <h6 class="fw-500">Adam Joe</h6>
                    <p>Admin</p>
                </div>
            </div>
        </div>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
        <li>
            <div class="author-info flex items-center !p-1">
                <div class="image" style="width: 30px; height: 30px; border-radius: 50%; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                    <!-- Ajustando el tamaño del ícono -->
                    <i class="fas fa-user" style="font-size: 20px;"></i>
                </div>
                <div class="content">
                    <h4 class="text-sm">Adam Joe</h4>
                    <a class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white text-xs" href="#">Email@gmail.com</a>
                </div>
            </div>
        </li>
        <li class="divider"></li>
        <li>
            <a href="#0">
                <i class="lni lni-user"></i> View Profile
            </a>
        </li>
        <li>
            <a href="#0"> <i class="lni lni-cog"></i> Settings </a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="#0"> <i class="lni lni-exit"></i> Sign Out </a>
        </li>
    </ul>
</div>





              </div>
            </div>
          </div>
        </div>
      </header>

<style>
    .ck-editor__editable[role="textbox"]{
        min-height: 180px;
    }
</style>       


<script src="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.umd.js"></script>
   

<main>
  <div class="container-fluid">
    <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                    <h2>Nuevo articulo</h2>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="<?php echo ADMIN_URL; ?>inicio.php">Panel de control</a>
                      </li>
                      <li class="breadcrumb-item"><a href="<?php echo ADMIN_URL; ?>productos">Articulos</a></li>
                      <li class="breadcrumb-item active" aria-current="page">
                        Nuevo articulo
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
                <!-- end col -->
                </div>
                <!-- end row -->
        </div>
        <div class="card-style">
          

        <form action="guarda.php" method="post" enctype="multipart/form-data" autocomplete="off">
    <div class="col-4 mb-3">
        <label for="nombre" class="form-label mt-2">Nombre</label>
        <input type="text" class="form-control" name="nombre" id="nombre" required autofocus />
    </div>
    <div class="mb-3">
        <label for="descripcion" class="form-label mt-2">Descripción</label>
        <textarea class="form-control" name="descripcion" id="editor"></textarea>
    </div>

    <div class="row mb-2">
        <div class="col-4">
            <label for="imagen_principal" class="form-label">Imagen producto</label>
            <input type="file" class="form-control" name="imagen_principal" id="imagen_principal" accept="image/jpeg">        
        </div>
    </div>

    <!-- Select de Categoría -->
    <div class="row">
        <div class="col-4 mb-3">
            <label for="categoria" class="form-label mt-2">Categoría</label>
            <select class="form-select" name="categoria" id="categoria" required onchange="cargarProductos(this.value)">
                <option value="">Seleccionar</option>
                <?php foreach ($categorias as $categoria) { ?>
                    <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <!-- Select de Productos -->
    <div class="row">
        <div class="col-4 mb-3">
            <label for="producto" class="form-label mt-2">Producto</label>
            <select class="form-select" name="producto" id="producto" required>
                <option value="">Seleccionar</option>
            </select>
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-4">Guardar</button>
</form>
      </div>
  </div>
</main>

<script>
    function cargarProductos(categoriaId) {
        if (categoriaId) {
            fetch('../clases/obtener_productos.php?categoria_id=' + categoriaId)
                .then(response => response.json())
                .then(data => {
                    const productoSelect = document.getElementById('producto');
                    productoSelect.innerHTML = '<option value="">Seleccionar producto</option>';
                    data.forEach(producto => {
                        const option = document.createElement('option');
                        option.value = producto.id;
                        option.text = producto.nombre;
                        productoSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error al cargar productos:', error));
        } else {
            document.getElementById('producto').innerHTML = '<option value="">Selecciona primero una categoría</option>';
        }
    }
</script>

<script type="module">
   
   const {
        ClassicEditor,
        Essentials,
        Bold,
        Italic,
        Font,
        Paragraph
    } = CKEDITOR;

    ClassicEditor
        .create( document.querySelector( '#editor' ), {
            plugins: [ Essentials, Bold, Italic, Font, Paragraph ],
            toolbar: [
                'undo', 'redo', '|', 'bold', 'italic', '|',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
            ]
        } )
        .then( /* ... */ )
        .catch( /* ... */ );

        function cargarProductos(categoriaId) {
        if (categoriaId) {
            fetch('obtener_productos.php?categoria_id=' + categoriaId)
                .then(response => response.json())
                .then(data => {
                    const productoSelect = document.getElementById('producto');
                    productoSelect.innerHTML = '<option value="">Seleccionar producto</option>';
                    data.forEach(producto => {
                        const option = document.createElement('option');
                        option.value = producto.id;
                        option.text = producto.nombre;
                        productoSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error al cargar productos:', error));
        } else {
            document.getElementById('producto').innerHTML = '<option value="">Selecciona primero una categoría</option>';
        }
    }
</script>



<?php 

require_once '../layaouts/Footer.php';
?>
