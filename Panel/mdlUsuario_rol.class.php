<?php
    require_once('Sistema.class.php');

    class UsuarioRol extends Sistema{

        public function read($id_usuario){
            $this->connect();
            $sql = "SELECT id_rol FROM usuario_rol WHERE id_usuario = :id_usuario";
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $rs = $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        }

        public function create($id_usuario, $id_rol){
            $this->connect();
            $sql = "INSERT INTO usuario_rol (id_usuario, id_rol) VALUES (:id_usuario, :id_rol)"; 
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt -> bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
            $rs = $stmt->execute();
            return  $stmt->rowCount();
        }

        public function delete($id_usuario){
            $this->connect();
            $sql = "DELETE FROM usuario_rol WHERE id_usuario = :id_usuario"; 
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $rs = $stmt->execute();
            return  $stmt->rowCount();
        }

        public function roles_usuario($id_usuario){
            $datos = $this -> read($id_usuario);
            $roles = array();
            foreach($datos as $key => $value){
                array_push($roles,$value['id_rol']);
            }
            return $roles;
        }

    }
        
    $usuarioRol = new UsuarioRol();
    
?>