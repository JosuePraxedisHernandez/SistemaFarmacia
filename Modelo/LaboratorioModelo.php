<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Sistema_Farmacia/Configuraciones/Conexion.php';

class LaboratorioModelo{

    var $objetos;
    var $acceso;

    public function __construct(){
        $conexion = new Conexion();
        $this->acceso = $conexion->pdo;
    }

    function obtener_laboratorios(){
        $consulta = "SELECT * FROM tblLaboratorios ORDER BY laboratorio";
        $query = $this->acceso->prepare($consulta);
        $query->execute();
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    function crear_laboratorio($nombre){
        $consulta = "INSERT INTO tblLaboratorios (id, laboratorio) VALUES (NULL, :laboratorio)";
        $query = $this->acceso->prepare($consulta);
        $query->bindParam(':laboratorio', $nombre);
        $query->execute();
    }
    
    function obtener_laboratorio($id){
        $consulta = "SELECT * FROM tblLaboratorios WHERE id=:id";
        $query = $this->acceso->prepare($consulta);
        $query->bindParam(':id', $id);
        $query->execute();
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    function buscar_laboratorio($nombre, $id_laboratorio){
        $consulta = "SELECT * FROM tblLaboratorios WHERE laboratorio=:laboratorio AND id!=:id";
        $query = $this->acceso->prepare($consulta);
        $query->bindParam(':laboratorio', $nombre);
        $query->bindParam(':id', $id_laboratorio);
        $query->execute();
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    function editar_laboratorio($id_laboratorio, $nombre){
        $consulta = "UPDATE tblLaboratorios SET laboratorio=:laboratorio WHERE id=:id";
        $query = $this->acceso->prepare($consulta);
        $query->bindParam(':laboratorio', $nombre);
        $query->bindParam(':id', $id_laboratorio);
        $query->execute();
    }

    function editar_avatar($id_laboratorio, $nombre, $filename){
        $consulta = "UPDATE tblLaboratorios SET laboratorio=:laboratorio, avatar=:avatar WHERE id=:id";
        $query = $this->acceso->prepare($consulta);
        $query->bindParam(':laboratorio', $nombre);
        $query->bindParam(':avatar', $filename);
        $query->bindParam(':id', $id_laboratorio);
        $query->execute();
    }

    function inactivar_laboratorio($id){
        $estado = "I";
        $consulta = "UPDATE tblLaboratorios SET estado=:estado WHERE id=:id";
        $query = $this->acceso->prepare($consulta);
        $query->bindParam(':estado', $estado);
        $query->bindParam(':id', $id);
        $query->execute();
    }

    function activar_laboratorio($id){
        $estado = "A";
        $consulta = "UPDATE tblLaboratorios SET estado=:estado WHERE id=:id";
        $query = $this->acceso->prepare($consulta);
        $query->bindParam(':estado', $estado);
        $query->bindParam(':id', $id);
        $query->execute();
    }
}