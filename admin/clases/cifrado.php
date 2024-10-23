<?php


function cifrado($datos, $opciones = [])
{
    $password = $opciones['key'] ?? '';
    $metodo = $opciones['method'] ?? '';

    if (empty($password)) {
        throw new InvalidArgumentException('Debe agregar una clave de cifrado.');
    }

    if (empty($metodo) || !in_array($metodo, openssl_get_cipher_methods())) {
        throw new InvalidArgumentException('Debe agregar un método de cifrado válido.');
    }

    $ivSize = openssl_cipher_iv_length($metodo);
    $iv = openssl_random_pseudo_bytes($ivSize);
    $datosCifrados = openssl_encrypt($datos, $metodo, $password,  OPENSSL_RAW_DATA, $iv);

    return base64_encode($iv . $datosCifrados);
}


function descifrar($datos, $opciones = [])
{
    $password = $opciones['key'] ?? '';
    $metodo = $opciones['method'] ?? '';

    if (empty($password)) {
        throw new InvalidArgumentException('Debe agregar una clave de cifrado');
    }

    if (empty($metodo) || !in_array($metodo, openssl_get_cipher_methods())) {
        throw new InvalidArgumentException('Debe agregar un método de cifrado válido');
    }

    $datos = base64_decode($datos);
    $ivSize = openssl_cipher_iv_length($metodo);
    $iv = substr($datos, 0, $ivSize);
    $datosCifrados = substr($datos, $ivSize);

    return openssl_decrypt($datosCifrados, $metodo, $password, OPENSSL_RAW_DATA, $iv);
}

?>