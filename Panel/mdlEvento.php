<?php
    require_once('Sistema.class.php');
    
    class Evento extends Sistema{
        public $id_evento;
        public $evento;
        public $fecha_inicio;
        public $fecha_fin;

        public function getId_evento(){
            return $this->id_evento;
        }

        public function setId_evento($id_evento){
            $this->id_evento = $id_evento;
            return $this;
        }

        public function setEvento($evento){
            $this->evento = $evento;
            return $this;
        }

        public function setFecha_inicio($fecha_inicio){
            $this->fecha_inicio = $fecha_inicio;
            return $this;
        }

        public function getFecha_fin(){
            return $this->fecha_fin;
        }

        public function setFecha_fin($fecha_fin){
            $this->fecha_fin = $fecha_fin;
            return $this;
        }


        public function create($datos){
            $this->connect();
            $sql = "INSERT INTO evento (evento, fecha_inicio, fecha_fin) VALUES (:evento, :fecha_inicio, :fecha_fin)"; 
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':evento', $datos['evento'], PDO::PARAM_STR);
            $stmt -> bindParam(':fecha_inicio', $datos['fecha_inicio'], PDO::PARAM_STR);
            $stmt -> bindParam(':fecha_fin', $datos['fecha_fin'], PDO::PARAM_STR);
            $rs = $stmt->execute();
            return  $stmt->rowCount();
        }

    }

  $evento = new Evento;
?>