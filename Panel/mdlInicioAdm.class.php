<?php
    require_once('Sistema.class.php');

    class InicioAdm extends Sistema{
        
        public function conteoParticipantes($id_tipo){
            $this->connect();
            $sql = "SELECT count(*) as conteo FROM ponente WHERE id_tipo = :id_tipo";
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':id_tipo', $id_tipo, PDO::PARAM_INT);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos[0]['conteo'];
        }

        public function conteoConferencias(){
            $this->connect();
            $sql = "SELECT count(*) as conteo FROM conferencia";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos[0]['conteo'];
        }

    }  

    $inicioAdm = new InicioAdm();

?>