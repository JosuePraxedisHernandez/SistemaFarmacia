<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/Sistema_Farmacia/Configuraciones/Conexion.php";

class ClienteModelo{
    
    var $objetos;
    var $acceso;

    public function __construct(){
        $conexion = new Conexion();
        $this->acceso = $conexion->pdo;
    }

    function obtener_clientes(){
        $consulta = "SELECT * FROM tblClientes WHERE estatus = 1";
        $query = $this->acceso->prepare($consulta);
        $query->execute();
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    function obtener_datos($no_cliente){
        $consulta = "SELECT * FROM tblClientes WHERE no_cliente = :no_cliente";
        $query = $this->acceso->prepare($consulta);
        $query->bindParam(':no_cliente', $no_cliente);
        $query->execute();
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    function obtener_cliente($id){
        $consulta = "SELECT * FROM tblClientes WHERE id=:id";
        $query = $this->acceso->prepare($consulta);
        $query->bindParam(':id', $id);
        $query->execute();
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    function crear_cliente($no_cliente, $nombre, $apellido_paterno, $apellido_materno, $sexo, $direccion, $email, $telefono){
        $consulta = "INSERT INTO tblClientes (id, no_cliente, nombre, apellido_paterno, apellido_materno, sexo, direccion, email, telefono) VALUES 
                    (NULL, :no_cliente, :nombre, :apellido_paterno, :apellido_materno, :sexo, :direccion, :email, :telefono)";
        $query = $this->acceso->prepare($consulta);
        $query->bindParam(':no_cliente', $no_cliente);
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':apellido_paterno', $apellido_paterno);
        $query->bindParam(':apellido_materno', $apellido_materno);
        $query->bindParam(':sexo', $sexo);
        $query->bindParam(':direccion', $direccion);
        $query->bindParam(':email', $email);
        $query->bindParam(':telefono', $telefono);
        $query->execute();
    }

    function editar_cliente($id, $email, $telefono, $direccion, $sexo){
        $consulta = "UPDATE tblClientes SET sexo=:sexo, direccion=:direccion, email=:email, telefono=:telefono WHERE id=:id";
        $query = $this->acceso->prepare($consulta);
        $query->bindParam(':sexo', $sexo);
        $query->bindParam(':direccion', $direccion);
        $query->bindParam(':email', $email);
        $query->bindParam(':telefono', $telefono);
        $query->bindParam(':id', $id);
        $query->execute();
    }
}