<?php
require_once 'vendor/autoload.php';

MercadoPago\SDK::setAccessToken('TEST-4868021780773026-092919-3ef007fb451a838823be741569237ef8-2010936843');

$preference = new MercadoPago\Preference();

$item = new MercadoPago\Item();
$item->id = '0001';
$item->title = 'Producto';
$item->quantity = 1;
$item->unit_price = 150.00;
$item->currency_id = 'USD';

$preference->items = array($item);

$preference->back_urls = array(
    "success" => "http://localhost/trigo-y-canela/captura.php",
    "failure" => "http://localhost/trigo-y-canela/fallo.php",
);

$preference->auto_return = "approved";
$preference->binary_mode = true;

$preference->save();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <link rel="stylesheet" href="css/mercadoPago.css">


</head>
<body>
    <h3>Mercado pago</h3>
    <div class="checkout-btn"></div>

    <script>
        const mp = new MercadoPago('TEST-8b8d145e-05af-4049-9827-d02bc207a236',{
            locale: 'es-CO'
            
        });

        mp.checkout({
            preference: {
                id: '<?php echo $preference->id;?>'
            },
            render:{
                container: '.checkout-btn',
                label: 'Pagar con Mercado Pago',
                
            },
        })

    </script>
    
</body>
</html>