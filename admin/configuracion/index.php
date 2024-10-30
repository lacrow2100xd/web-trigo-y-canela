<?php

require_once '../config/database.php';
require_once '../config/config.php';
require_once '../clases/cifrado.php';


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

$sql = "SELECT nombre, valor FROM configuracion";
$resultado = $con->query($sql);
$datos = $resultado->fetchAll(PDO::FETCH_ASSOC);

$config = [];

foreach($datos as $dato){
    $config[$dato['nombre']] = $dato['valor'];
}

?>

<main>
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                    <h2>Configuracion</h2>
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
                            Configuracion
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
            

            <form action="guarda.php" method="post">
            <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">General</button>
                </li>
                
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="otro-tab" data-bs-toggle="tab" data-bs-target="#otro" type="button" role="tab" aria-controls="otro" aria-selected="false">Correo electrónico</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Paypal</button>
                </li>
            </ul>
            <div class="tab-content mt-4" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="nombre">Nombre</label>  
                                <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $config['tienda_nombre']; ?>">
                            </div>
                            <div class="col-6">
                                <label for="telefono">Telefono</label>  
                                <input class="form-control" type="text" name="telefono" id="telefono" value="<?php echo $config['tienda_telefono']; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="moneda">Moneda</label>  
                                <input class="form-control" type="text" name="moneda" id="moneda"value="<?php echo $config['tienda_moneda']; ?>">
                            </div>
                        
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                </div>
                <div class="tab-pane fade" id="otro" role="tabpanel" aria-labelledby="otro-tab">
                    <div class="row mb-3">
                            <div class="col-6">
                                <label for="smtp">SMTP</label>  
                                <input class="form-control" type="text" name="smtp" id="smtp" value="<?php echo $config['correo_smtp']; ?>">
                            </div>
                            <div class="col-6">
                                <label for="puerto">Puerto</label>  
                                <input class="form-control" type="text" name="puerto" id="puerto" value="<?php echo $config['correo_puerto']; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="email">Correo electrónico</label>  
                                <input class="form-control" type="text" name="email" id="email"value="<?php echo $config['correo_email']; ?>">
                            </div>
                            <div class="col-6">
                                <label for="password">Contraseña</label>  
                                <input class="form-control" type="password" name="password" id="password"value="<?php echo $config['correo_password']; ?>">
                            </div>     
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="row mb-3">
                            <div class="col-9">
                                <label for="paypal_cliente">Cliente ID</label>  
                                <input class="form-control" type="text" name="paypal_cliente" id="paypal_cliente" value="<?php echo $config['paypal_cliente']; ?>">
                            </div>
                            <div class="col-3">
                                <label for="paypal_moneda">Moneda</label>  
                                <input class="form-control" type="text" name="paypal_moneda" id="paypal_moneda" value="<?php echo $config['paypal_moneda']; ?>">
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>

                </div>
            </div>

        </div>
    </div>
</main>


<?php 

require_once '../layaouts/Footer.php';
?>