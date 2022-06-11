<?php
    require_once('Sistema.class.php');

    class Tipo extends Sistema{
 
        public function read(){
            $this->connect();
            $sql = "SELECT * FROM tipo";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        }

        public function readOne($id_tipo){
            $this->connect();
            $sql = "SELECT * FROM tipo WHERE id_tipo = :id_tipo";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id_tipo",$id_tipo, PDO::PARAM_INT);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $datos = $datos[0];
            return $datos;
        }

        public function create($datos){
            $this->connect();
            $sql = "INSERT INTO tipo (tipo) VALUES (:tipo)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":tipo",$datos['tipo'], PDO::PARAM_STR);
            $rs = $stmt->execute();
            return $rs; 
        }

        public function update($datos, $id_tipo){
            $this->connect();
            $sql = "UPDATE tipo SET tipo = :tipo WHERE id_tipo = :id_tipo";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":tipo",$datos['id_tipo'], PDO::PARAM_STR);
            $stmt->bindParam(":id_tipo",$id_tipo, PDO::PARAM_INT);
            $rs = $stmt->execute();
            return $rs;
        }

        public function delete($id_tipo){
            $this->connect();
            $sql = "DELETE * FROM tipo WHERE id_tipo = :id_tipo";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id_tipo",$id_tipo, PDO::PARAM_INT);
            $rs = $stmt->execute();
            return $rs;
        }



    }

    $tipo = new Tipo;
    
?>