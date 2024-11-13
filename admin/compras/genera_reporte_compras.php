<?php
require_once '../config/config.php';


if(!isset($_SESSION['user_type']) ||  $_SESSION['user_type'] != 'admin'){
  header('Location: ../../index.php');
  exit;
}
                            


require_once '../layaouts/header.php';

?>

<main>
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                    <h2>Reporte de compras</h2>
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
                        <li class="breadcrumb-item active" aria-current="page">
                            Compras
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

        <form action="reporte_compras.php" method="post" autocomplete="off">

        <div class="row mb-2">
            <div class="col-12 col-md-4">
                <label for="fecha_ini" class="form-label">Fecha inicial:</label>
                <input type="date" class="form-control" name="fecha_ini" id="fecha_ini" require autofocus>
            </div>
            <div class="col-12 col-md-4">
                <label for="fecha_fin" class="form-label">Fecha final:</label>
                <input type="date" class="form-control"  name="fecha_fin" id="fecha_fin" require>
            </div>
        </div>
        
        
        <button type="submit" class="btn btn-primary mt-4">Generar</button>
        </form>
            

        </div>
    

</main>




<?php 

require_once '../layaouts/Footer.php';
?>