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
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="<?php echo ADMIN_URL; ?>css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.css" />
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Trigo y canela</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                           
                            <a class="nav-link" href="<?php echo ADMIN_URL; ?>configuracion">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></div>
                                Configuracion
                            </a>
                            <a class="nav-link" href="<?php echo ADMIN_URL; ?>categorias">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-tags"></i></div>
                                Categorias
                            </a>
                            <a class="nav-link" href="<?php echo ADMIN_URL; ?>productos">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-box"></i></div>
                                Productos
                            </a>
                            
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Layouts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                                </nav>
                            </div>
                            
                            
                           
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">

<style>
    .ck-editor__editable[role="textbox"]{
        min-height: 180px;
    }
</style>          

<script src="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.umd.js"></script>


<main>
    <div class="container-fluid px-4">
        <h2 class="mt-4">Nuevo producto</h2>

        <form action="guarda.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="col-4 mb-3">
                <label for="nombre" class="form-label mt-2">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" required autofocus/>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label mt-2">Descripcion</label>
                <textarea class="form-control" name="descripcion" id="editor" ></textarea>
            </div>

            <div class="row mb-2">
                <div class="col-4">
                        <label for="imagen_principal" class="form-label">Imagen producto</label>
                        <input type="file" class="form-control" name="imagen_principal" id="imagen_principal" accept="image/jpeg" 
                        >        
                </div>
               
            </div>
            

            <div class="row">
                <div class="col mb-3">
                    <label for="precio" class="form-label mt-2">Precio</label>
                    <input type="number" class="form-control" name="precio" id="precio" required />
                </div>
                <div class="col mb-3">
                    <label for="descuento" class="form-label mt-2">Descuento</label>
                    <input type="number" class="form-control" name="descuento" id="descuento" required />
                </div>
                <div class="col mb-3">
                    <label for="stock" class="form-label mt-2">Stock</label>
                    <input type="number" class="form-control" name="stock" id="stock" required />
                </div>
            </div>

            <div class="row">
                <div class="col-4 mb-3">
                    <label for="categoria" class="form-label mt-2">Categoria</label> 
                        <select class="form-select" name="categoria" id="categoria" required>
                            <option value="">Seleccionar</option>
                            <?php foreach($categorias as $categoria){ ?>
                                <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></option>

                                <?php } ?>
                        </select>
             
                    
                </div>
            </div>

            
            <button type="submit" class="btn btn-primary mt-4">Guardar
            </button>
            
        </form>

    </div>
</main>

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
</script>



<?php 

require_once '../layaouts/Footer.php';
?>