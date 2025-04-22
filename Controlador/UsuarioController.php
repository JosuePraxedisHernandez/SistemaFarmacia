<?php
include_once $_SERVER["DOCUMENT_ROOT"] .'/Sistema_Farmacia/Modelo/UsuarioModelo.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Sistema_Farmacia/Configuraciones/mainModel.php';
session_start();
$usuario = new UsuarioModelo();

if($_POST['funcion']=='obtener_datos'){
    $json = array();
    $id = $_SESSION['id'];
    $usuario->obtener_datos($id);

    foreach($usuario->objetos as $objeto){
        $json=array(
            'nombre'=>$objeto['nombre'],
            'apellido_paterno'=>$objeto['apellido_paterno'],
            'apellido_materno'=>$objeto['apellido_materno'],
            'usuario'=>$objeto['usuario'],
            'password'=>$objeto['pass'],
            'email'=>$objeto['email'],
            'telefono'=>$objeto['telefono'],
            'direccion'=>$objeto['direccion'],
            'estatus'=>$objeto['estatus'],
            'id_perfil'=>$objeto['id_perfil'],
            'perfil'=>$objeto['perfil'],
            'avatar'=>'../Pictures/Usuarios/'.$objeto['avatar']
        );
    }
    $jsonString = json_encode($json);
    echo $jsonString;
} 
else if($_POST['funcion']=='editar_datos'){
    $mensaje='';
    if(!empty($_SESSION['id'])){
        $id = $_SESSION['id'];
        $usser = $_POST['usuario'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $usuario->editar_datos($id, $usser, $email, $telefono, $direccion);
        $mensaje='success';
    } else {
        $mensaje='error_sesion';
    }

    $json = array(
        'mensaje'=>$mensaje
    );

    $jsonString = json_encode($json);
    echo $jsonString;
}
else if($_POST['funcion']=='editar_contraseña'){
    $mensaje='';
    if(!empty($_SESSION['id'])){
        $id = $_SESSION['id'];
        $oldpass = $_POST['oldpass'];
        $newpass = $_POST['newpass'];
        $usuario->obtener_datos($id);
        $pass_base = decryption($usuario->objetos[0]['pass']);
        if($pass_base!=''){
            if($oldpass == $pass_base){
                $passNueva = encryption($newpass);
                $usuario->editar_contraseña($id, $passNueva);
                $mensaje="success";
            } else{
                $mensaje="error_pass";
            }
        } else {
            if($oldpass == $usuario->objetos[0]['pass']){
                $passNueva = encryption($newpass);
                $usuario->editar_contraseña($id, $passNueva);
                $mensaje="success";
            } else{
                $mensaje="error_pass";
            }
        }
    } else {
        $mensaje='error_sesion';
    }

    $json = array(
        'mensaje'=>$mensaje
    );

    $jsonString = json_encode($json);
    echo $jsonString;
}
else if($_POST['funcion']=='editar_avatar'){
    $mensaje='';
    if(!empty($_SESSION['id'])){
        if(($_FILES['avatar_usuario']['type']=='image/jpeg')||($_FILES['avatar_usuario']['type']=='image/png')){
            $id = $_SESSION['id'];
            $nombreDelArchivo = date("Y-m-d-h-i-s");
            $filename = $nombreDelArchivo."__".$_FILES['avatar_usuario']['name'];
            $location = "/Sistema_Farmacia/Pictures/Usuarios/". $filename;
            move_uploaded_file($_FILES['avatar_usuario']['tmp_name'], $location);
            $avat= $_SESSION['avatar'];
            if($avat!='avatar.png'){
                unlink('../Pictures/Usuarios/'.$avat);
            }
            $_SESSION['avatar']=$filename;
            $usuario->editar_avatar($id, $filename);
            $mensaje='success';
        }
    }else {
        $mensaje='error_sesion';
    }

    $json = array(
        'mensaje'=>$mensaje
    );

    $jsonString = json_encode($json);
    echo $jsonString;
}