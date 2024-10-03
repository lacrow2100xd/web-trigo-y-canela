<?php

define("SITE_URL", "http://localhost/trigo-y-canela");


define('CLIENT_ID',"Abgb3Df95H4DiacyeLBEQ7imLvdnPWkxVEKUIcgO4fSnFpn8vycBsZJlE1b9OvO-QZqEsCLWybj90zxi");
define('TOKEN_MP',"TEST-4868021780773026-092919-3ef007fb451a838823be741569237ef8-2010936843");
define('CURRENCY',"USD");
define('KEY_TOKEN',"APR.wqc-354*");
define("MONEDA", "$");

define("MAIL_HOST", "smtp.gmail.com");
define("MAIL_USER", "trigoycanelacontacto@gmail.com");
define("MAIL_PASS", "eenfznhgnvvllssw");
define("MAIL_PORT", "587");    


session_start();

$num_cart=0;
if(isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}
?>