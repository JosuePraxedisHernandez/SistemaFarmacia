<?php

    function encryption($datos){

        $method = "AES-256-CBC";
        $password = "ABCD-1234.aer";
        
        $ivSize = openssl_cipher_iv_length($method);
        $iv = openssl_random_pseudo_bytes($ivSize);
        $datosCifrados = openssl_encrypt($datos, $method, $password, OPENSSL_RAW_DATA, $iv);
        return base64_encode($iv . $datosCifrados);
    }

    function decryption($datos){

        $method = "AES-256-CBC";
        $password = "ABCD-1234.aer";

        $datos = base64_decode($datos);
        $ivSize = openssl_cipher_iv_length($method);
        $iv = substr($datos, 0, $ivSize);
        $datosCifrados = substr($datos, $ivSize);
        return openssl_decrypt($datosCifrados, $method, $password, OPENSSL_RAW_DATA, $iv);
    }