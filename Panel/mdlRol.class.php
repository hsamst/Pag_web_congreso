<?php
    require_once('Sistema.class.php');

    class Rol extends Sistema{

        public $id_rol;
        public $rol;


        public function getId_rol(){
            return $this->id_rol;
        }

    
        public function setId_rol($id_rol){
            $this->id_rol = $id_rol;
            return $this;
        }


        public function getRol(){
            return $this->rol;
        }

    
        public function setRol($rol){
            $this->rol = $rol;
            return $this;
        }


        public function read(){
            $this->connect();
            $sql = "SELECT id_rol, 
                     rol
                     FROM rol;";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos; 
        }

        public function readOne($id_rol){
            $this->connect();
            $sql = "SELECT rol  
                        from rol
                        WHERE rol.id_rol = :id_rol;";
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $datos = (isset($datos[0]))?$datos[0]:null;
            return $datos;
        }

        public function create($datos){
            $this->connect();
            $sql = "INSERT INTO rol (rol) VALUES (:rol)"; 
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':rol', $datos['rol'], PDO::PARAM_STR);
            $rs = $stmt->execute();
            return  $stmt->rowCount();
        }

        public function update($datos, $id_rol){
            $this->connect();
            $sql = "UPDATE rol set 
                    rol = :rol 
                    WHERE id_rol = :id_rol";
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':rol', $datos['rol'], PDO::PARAM_STR);
            $stmt -> bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
            $rs = $stmt->execute();
            return  $stmt->rowCount();
        }

        public function delete($id_rol){
            $this->connect();
            $sql = "DELETE FROM rol WHERE id_rol = :id_rol";
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
            $rs = $stmt->execute();
            return $stmt->rowCount();
        }

    }

    $rol = new Rol();

?>