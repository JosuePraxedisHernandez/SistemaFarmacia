<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Sistema_Farmacia/Modelo/LaboratorioModelo.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Sistema_Farmacia/Configuraciones/mainModel.php';
session_start();

$laboratorio = new LaboratorioModelo();

if($_POST['funcion']=='obtener_laboratorios'){
    $json = array();
    $laboratorio->obtener_laboratorios();
    foreach($laboratorio->objetos as $objeto){
        $json[]=array(
            'id'=>encryption($objeto['id']),
            'nombre'=>$objeto['laboratorio'],
            'estado'=>$objeto['estado'],
            'avatar'=>$objeto['avatar']
        );
    }
    $jsonString = json_encode($json);
    echo $jsonString;
}
else if($_POST['funcion']=='crear_laboratorio'){
    $mensaje='';
    if(!empty($_SESSION['id'])){
        $nombre = $_POST['nombre'];
        $laboratorio->crear_laboratorio($nombre);
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
else if($_POST['funcion']=='obtener_laboratorio'){
    $json = array();
    $id = decryption($_POST['id']);
    $laboratorio->obtener_laboratorio($id);
    foreach($laboratorio->objetos as $objeto){
        $json=array(
            'id'=>$objeto['id'],
            'nombre'=>$objeto['laboratorio'],
            'estado'=>$objeto['estado'],
            'avatar'=>$objeto['avatar']
        );
    }
    $jsonString = json_encode($json);
    echo $jsonString;
}
else if($_POST['funcion']=='editar_laboratorio'){
    $mensaje='';
    if(!empty($_SESSION['id'])){
        $nombre = $_POST['nombre_lab'];
        $avatar = $_FILES['avatar']['name'];
        $id = $_POST['id_laboratorio'];
        $id_laboratorio = decryption($id);
        if(is_numeric($id_laboratorio)){
            $laboratorio->buscar_laboratorio($nombre, $id_laboratorio);
            if(empty($laboratorio->objetos)){
                if($avatar !=''){
                    $nombreDelArchivo = date("Y-m-d-h-i-s");
                    $filename = $nombreDelArchivo."__".$_FILES['avatar']['name'];
                    $location = $_SERVER["DOCUMENT_ROOT"] . '/Sistema_Farmacia/Pictures/Laboratorios/'. $filename;
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $location);
                    $laboratorio->obtener_laboratorio($id_laboratorio);
                    $avatar_Actual= $laboratorio->objetos[0]['avatar'];
                    if($avatar_Actual!='lab_default.png'){
                        unlink($_SERVER["DOCUMENT_ROOT"] . '/Sistema_Farmacia/Pictures/Laboratorios/'. $avatar_Actual);
                    }
                    $laboratorio->editar_avatar($id_laboratorio, $nombre, $filename);
                } else {
                    $laboratorio->editar_laboratorio($id_laboratorio, $nombre);
                }
                $mensaje='success';
            } else {
                $mensaje='error_lab';
            }
        } else {
            $mensaje='error_decrypt';
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
else if($_POST['funcion']=='inactivar_laboratorio'){
    $mensaje='';
    if(!empty($_SESSION['id'])){
        $id = $_POST['id'];
        $id = decryption($id);
        if(is_numeric($id)){
            $laboratorio->inactivar_laboratorio($id);
            $mensaje='success';
        } else {
            $mensaje='error_decrypt';
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
else if($_POST['funcion']=='activar_laboratorio'){
    $mensaje='';
    if(!empty($_SESSION['id'])){
        $id = $_POST['id'];
        $id = decryption($id);
        if(is_numeric($id)){
            $laboratorio->activar_laboratorio($id);
            $mensaje='success';
        } else {
            $mensaje='error_decrypt';
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