<?php
include_once "../Configuraciones/Conexion.php";

class usuarioModelo{
    
    var $objetos;
    var $acceso;

    public function __construct(){
        $conexion = new Conexion();
        $this->acceso = $conexion->pdo;
    }

    function login($usuario){
        $consulta = "SELECT * 
            FROM tblUsuarios u 
            /*INNER JOIN tblPerfiles p ON u.IdPerfil = p.IdPerfil*/
            WHERE u.usuario= :usuario AND estatus = 1";
        $query = $this->acceso->prepare($consulta);
        $query->bindParam(':usuario', $usuario);
        $query->execute();
        $this->objetos=$query->fetchAll();
        return $this->objetos;
    }

    function obtener_datos($id){
        $consulta = "SELECT * FROM tblUsuarios u
            INNER JOIN tblPerfiles p ON u.id_perfil = p.id
            WHERE u.id = :id";
        $query = $this->acceso->prepare($consulta);
        $query->bindParam(':id', $id);
        $query->execute();
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    function editar_datos($id, $usser, $email, $telefono, $direccion){
        $consulta = "UPDATE tblUsuarios SET usuario=:usuario, email=:email, telefono=:telefono, direccion=:direccion WHERE id=:id";
        $query = $this->acceso->prepare($consulta);
        $query->bindParam(':id', $id);
        $query->bindParam(':usuario', $usser);
        $query->bindParam(':email', $email);
        $query->bindParam(':telefono', $telefono);
        $query->bindParam(':direccion', $direccion);
        $query->execute();
    }

    function editar_contraseña($id, $passNueva){
        $consulta = "UPDATE tblUsuarios SET pass=:pass WHERE id=:id";
        $query = $this->acceso->prepare($consulta);
        $query->bindParam(':id', $id);
        $query->bindParam(':pass', $passNueva);
        $query->execute();
    }

    function editar_avatar($id, $filename){
        $consulta = "UPDATE tblUsuarios SET avatar=:avatar WHERE id=:id";
        $query = $this->acceso->prepare($consulta);
        $query->bindParam(':id', $id);
        $query->bindParam(':avatar', $filename);
        $query->execute();
    }
 
}