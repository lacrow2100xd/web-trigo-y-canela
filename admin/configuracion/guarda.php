<?php

require_once '../config/database.php';
require_once '../config/config.php';
require_once '../layaouts/header.php';
require_once '../clases/cifrado.php';

$db = new DataBase();
$con = $db->conectar();

$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$moneda = $_POST['moneda'];

$smtp = $_POST['smtp'];
$puerto = $_POST['puerto'];
$email = $_POST['email'];
$password = $_POST['password'];

$paypal_cliente = $_POST['paypal_cliente'];
$paypal_moneda = $_POST['paypal_moneda'];


$passwordBd = '';
$sqlConfig = $con->query("SELECT valor FROM configuracion WHERE nombre = 'correo_password' LIMIT 1");
$sqlConfig->execute();
if($row_config = $sqlConfig->fetch(PDO::FETCH_ASSOC)){
    $passwordBd = $row_config['valor'];
}

$sql = $con->prepare("UPDATE configuracion SET valor = ? WHERE nombre = ?");
$sql ->execute([$nombre,'tienda_nombre']);
$sql ->execute([$telefono,'tienda_telefono']);
$sql ->execute([$moneda,'tienda_moneda']);
$sql ->execute([$smtp,'correo_smtp']);
$sql ->execute([$puerto,'correo_puerto']);
$sql ->execute([$email,'correo_email']);
$sql ->execute([$paypal_cliente,'paypal_cliente']);
$sql ->execute([$paypal_moneda,'paypal_moneda']);

if($passwordBd != $password){
    $password = cifrado($password, ['key' => 'ABCD.1234-' , 'method' => 'aes-128-cbc']);
    $sql->execute([$password, 'correo_password']);
} 

?>

<main>
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                    <h2>Configuracion actualizada</h2>
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
        <div class="">
            
            <a href="index.php" class="btn btn-secondary"> Regresar </a>
        </div>
    </div class="container-fluid">
</main>
                

<?php include '../footer.php';?>   