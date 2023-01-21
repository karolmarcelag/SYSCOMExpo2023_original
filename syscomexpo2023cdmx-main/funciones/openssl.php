<?php
class Openssl
{
    static function encriptar($dato) 
    {
        $llave = 'pyT6Htm9aN9l61N5n7nxRf3VUAxskskg7nPqAVpK';

        $llave_encriptacion = base64_decode($llave);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($dato, 'aes-256-cbc', $llave_encriptacion, 0, $iv);
        return base64_encode($encrypted . '::' . $iv);
    }

    static function desencriptar($dato) 
    {
        $llave = 'pyT6Htm9aN9l61N5n7nxRf3VUAxskskg7nPqAVpK';

        $llave_encriptacion = base64_decode($llave);
        list($dato_encriptado, $iv) = explode('::', base64_decode($dato), 2);
        return openssl_decrypt($dato_encriptado, 'aes-256-cbc', $llave_encriptacion, 0, $iv);
    }
}

/*
-- Encriptar --
$valor = Openssl::encriptar($dato);

-- Desencriptar --
$valor = Openssl::desencriptar($dato);
*/