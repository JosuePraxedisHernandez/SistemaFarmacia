<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Sistema_Farmacia/Modelo/ClienteModelo.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Sistema_Farmacia/Configuraciones/mainModel.php';
session_start();
$cliente = new ClienteModelo();

if($_POST['funcion']=='obtener_clientes'){
    $json = array();
    $cliente->obtener_clientes();
    foreach($cliente->objetos as $objeto){
        $json[]=array(
            'id'=>encryption($objeto['id']),
            'no_cliente'=>$objeto['no_cliente'],
            'nombre'=>$objeto['nombre'],
            'apellido_paterno'=>$objeto['apellido_paterno'],
            'apellido_materno'=>$objeto['apellido_materno'],
            'sexo'=>$objeto['sexo'],
            'direccion'=>$objeto['direccion'],
            'email'=>$objeto['email'],
            'telefono'=>$objeto['telefono'],
            'avatar'=>$objeto['avatar'],
            'estatus'=>$objeto['estatus']
        );
    }
    $jsonString = json_encode($json);
    echo $jsonString;
}
else if($_POST['funcion']=='rellenar_codigo'){
    $json = array(); 
    $codigo = '';
    $longitud = 5; // Definir la longitud del código 
    for ($i = 0; $i < $longitud; $i++) { 
        $codigo .= rand(0, 9); 
    } 
    $json = array( 
        'code' => $codigo 
    ); 
    $jsonString = json_encode($json); 
    echo $jsonString;
}
else if($_POST['funcion']=='crear_cliente'){
    $mensaje='';
    if(!empty($_SESSION['id'])){
        $no_cliente = $_POST['no_cliente'];
        $nombre = $_POST['nombre'];
        $apellido_paterno = $_POST['apellido_paterno'];
        $apellido_materno = $_POST['apellido_materno'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $sexo = $_POST['sexo'];
        $cliente->obtener_datos($no_cliente);
        if(empty($cliente->objetos)){
            $cliente->crear_cliente($no_cliente, $nombre, $apellido_paterno, $apellido_materno, $sexo, $direccion, $email, $telefono);
            $mensaje='success';
        } else {
            $mensaje='error_cliente';
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
else if($_POST['funcion']=='obtener_cliente'){
    $json = array();
    $id = decryption($_POST['id']);
    $cliente->obtener_cliente($id);
    foreach($cliente->objetos as $objeto){
        $json=array(
            'no_cliente'=>$objeto['no_cliente'],
            'nombre'=>$objeto['nombre'],
            'apellido_paterno'=>$objeto['apellido_paterno'],
            'apellido_materno'=>$objeto['apellido_materno'],
            'sexo'=>$objeto['sexo'],
            'direccion'=>$objeto['direccion'],
            'email'=>$objeto['email'],
            'telefono'=>$objeto['telefono'],
            'estatus'=>$objeto['estatus'],
        );
    }
    $jsonString = json_encode($json);
    echo $jsonString;
}
else if($_POST['funcion']=='editar_cliente'){
    $mensaje='';
    if(!empty($_SESSION['id'])){
        $id = decryption($_POST['id']);
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $sexo = $_POST['sexo'];
        $cliente->editar_cliente($id, $email, $telefono, $direccion, $sexo);
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