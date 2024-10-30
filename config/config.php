<?php

$path = dirname(__FILE__) . DIRECTORY_SEPARATOR;  

require_once $path . 'database.php';
require_once $path . '/../admin/clases/cifrado.php';

$db = new DataBase();
$con = $db->conectar();

$sql = "SELECT nombre, valor FROM configuracion";
$resultado = $con->query($sql);
$datosConfig = $resultado->fetchAll(PDO::FETCH_ASSOC);

$config = [];

foreach($datosConfig as $datoConfig){
    $config[$datoConfig['nombre']] = $datoConfig['valor'];
}


//Configuracion del sistema
define("SITE_URL", "http://localhost/trigo-y-canela");
define('KEY_TOKEN',"APR.wqc-354*");
define('KEY_CIFRADO', 'ABCD.1234-');
define('METODO_CIFRADO', 'aes-128-cbc');

define("MONEDA", $config['tienda_moneda']);

//Configuracion para paypal
define('CLIENT_ID', $config['paypal_cliente']);
define('CURRENCY', $config['paypal_moneda']);

//Configuracion para mercado pago
define('TOKEN_MP',"TEST-4868021780773026-092919-3ef007fb451a838823be741569237ef8-2010936843");

//Datos para envio de correo electronico
define("MAIL_HOST", $config['correo_smtp']);
define("MAIL_USER", $config['correo_email']);
define("MAIL_PASS", descifrar($config['correo_password'],['key' => KEY_CIFRADO,
'method' => METODO_CIFRADO]));
define("MAIL_PORT", $config['correo_puerto']);


session_start();

$num_cart=0;
if(isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}
?>