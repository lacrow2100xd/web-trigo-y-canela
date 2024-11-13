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

require_once '../layaouts/header.php';

$db = new DataBase();
$con = $db->conectar();

?>

<main>
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                    <h2>Nueva categoria</h2>
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
                          <li class="breadcrumb-item"><a href="<?php echo ADMIN_URL; ?>categorias">Categorias</a></li>
                          <li class="breadcrumb-item active" aria-current="page">
                            Nueva categoria
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
            <form action="guarda.php" method="post" autocomplete="off">
                <div class="mb-3">
                    <label for="nombre" class="form-label mt-2">Nombre</label>
                    <input
                        type="text"
                        class="form-control"
                        name="nombre"
                        id="nombre"
                        required autofocus
                    />
                </div>
                
                <button type="submit" class="btn btn-primary" required>  Guardar
                </button>
                
            </form>
        </div>
    </div>
</main>


<?php 

require_once '../layaouts/Footer.php';
?>