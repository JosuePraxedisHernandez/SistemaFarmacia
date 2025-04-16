<?php

    class Conexion{

        private $opciones=[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        private $servidor = "localhost";
        private $base = "Sistema_Farmacia";
        private $usuario = "root";
        private $pass = "";
        public $pdo = null;

        function __construct(){
            $this->pdo = new PDO("mysql:host={$this->servidor}; dbname={$this->base}", $this->usuario, $this->pass, $this->opciones);
        }
    }