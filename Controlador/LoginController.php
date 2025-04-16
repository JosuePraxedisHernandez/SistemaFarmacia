<?php
    include_once '../Modelo/UsuarioModelo.php';
    require "../Configuraciones/mainModel.php";

    $usuario = new UsuarioModelo();
    session_start();

    if($_POST['funcion']=='login'){
        $usser= $_POST['usser'];
        $pass = $_POST['pass'];
        $usuario->login($usser);
        $mensaje='';
        if(!empty($usuario->objetos)){
            $contraseña = $usuario->objetos[0]['pass'];
            $desencryted = decryption($contraseña);
            if($pass == $desencryted){
                $_SESSION['id'] = $usuario->objetos[0]['id'];
                //$_SESSION['idperfil'] = $usuario->objetos[0]['id_perfil'];
                //$_SESSION['perfil'] = $usuario->objetos[0]['perfil'];*/
                $_SESSION['pass'] = $usuario->objetos[0]['pass'];
                $_SESSION['nombre'] = $usuario->objetos[0]['nombre'];
                $_SESSION['apellido_paterno'] = $usuario->objetos[0]['apellido_paterno'];
                $_SESSION['apellido_materno'] = $usuario->objetos[0]['apellido_materno'];
                $_SESSION['avatar'] = $usuario->objetos[0]['avatar'];
                $_SESSION['usuario'] = $usuario->objetos[0]['usuario'];
                $mensaje='success';
            } else {
                $mensaje='error';
            }
        } else {
            $mensaje='error';
        }
        $json=array(
            'mensaje'=>$mensaje
        );
        $jsonString = json_encode($json);
        echo $jsonString;

    } else if($_POST['funcion']=='verificar_sesion'){
        if(!empty($_SESSION['id'])){
            $json=array(
                'id'=>$_SESSION['id'],
                //'perfil'=>$_SESSION['perfil'],
                'usuario'=>$_SESSION['usuario'],
                //'idperfil'=>$_SESSION['idperfil'],
                'nombre'=>$_SESSION['nombre'],
                'apellido_paterno'=>$_SESSION['apellido_paterno'],
                'apellido_materno'=>$_SESSION['apellido_materno'],
                'avatar'=>$_SESSION['avatar']
            );
        } else {
            $json=array();
        }
        $jsonString = json_encode($json);
        echo $jsonString;
}