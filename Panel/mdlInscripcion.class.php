<?php
    require_once('Sistema.class.php');

    class Inscripcion extends Sistema{
        public function read(){
            $this->connect();
            $sql="select * from vw_evento_chido";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $datos=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        }

        public function agregar($id_conferencia_p, $id_participante){
            $this->connect();
            $sql="INSERT INTO inscripcion_participante (id_conferencia_p, id_participante) VALUES (:id_conferencia_p, :id_participante)";
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':id_conferencia_p', $id_conferencia_p, PDO::PARAM_INT);
            $stmt -> bindParam(':id_participante', $id_participante, PDO::PARAM_INT);
            $rs=$stmt->execute();
        }

        public function agregarConferencia($id_evento, $id_conferencia,$fecha, $hora_inicio, $hora_fin){
            $this->connect();
            $sql="INSERT INTO conferencia_programacion (id_evento, id_conferencia, fecha, hora_inicio, hora_fin) VALUES (:id_evento, :id_conferencia, :fecha, :hora_inicio, :hora_fin)";
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':id_evento', $id_evento, PDO::PARAM_INT);
            $stmt -> bindParam(':id_conferencia', $id_conferencia, PDO::PARAM_INT);
            $stmt -> bindParam(':fecha', $fecha, PDO::PARAM_STR);
            $stmt -> bindParam(':hora_inicio', $hora_inicio, PDO::PARAM_STR);
            $stmt -> bindParam(':hora_fin', $hora_fin, PDO::PARAM_STR);
            $rs=$stmt->execute();
        }

        public function inscritos($id_conferencia_p){
            $this->connect();
            $sql="SELECT p.id_participante, 
                            p.nombre, 
                            p.apaterno, 
                            p.amaterno 
                    FROM participante p 
                    JOIN inscripcion_participante ip on p.id_participante = ip.id_participante
                    JOIN conferencia_programacion cp on ip.id_conferencia_p = cp.id_conferencia_p
                    WHERE cp.id_conferencia_p = :id_conferencia_p
                    ORDER BY p.apaterno,p.amaterno,p.nombre";
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':id_conferencia_p', $id_conferencia_p, PDO::PARAM_INT);
            $stmt->execute();
            $datos=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        }

        public function eliminar($id_conferencia_p, $id_participante){
            $this->connect();
            $sql="DELETE From inscripcion_participante WHERE id_conferencia_p=:id_conferencia_p and id_participante=:id_participante";
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':id_conferencia_p', $id_conferencia_p, PDO::PARAM_INT);
            $stmt -> bindParam(':id_participante', $id_participante, PDO::PARAM_INT);
            $rs=$stmt->execute();
            $datos=$stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function eliminarConferencia($id_evento, $id_conferencia){
            $this->connect();
            $sql="DELETE FROM conferencia_programacion WHERE id_evento=:id_evento and id_conferencia=:id_conferencia";
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':id_evento', $id_evento, PDO::PARAM_INT);
            $stmt -> bindParam(':id_conferencia', $id_conferencia, PDO::PARAM_INT);
            $rs=$stmt->execute();
        }

        public function participantes_disponibles(){
            $this->connect();
            $sql="SELECT p.id_participante, 
                            p.nombre, 
                            p.apaterno, 
                            p.amaterno 
                    FROM participante p  
                    left join inscripcion_participante ip on p.id_participante = ip.id_participante
                    WHERE ip.id_participante is null
                    ORDER BY p.apaterno,p.amaterno,p.nombre";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $datos=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        }

        public function conferencias_disponibles(){
            $this->connect();
            $sql="SELECT c.id_conferencia, 
                         c.titulo 
                  FROM conferencia c 
                  LEFT join conferencia_programacion cp ON c.id_conferencia = cp.id_conferencia 
                  WHERE cp.id_conferencia is null; ";
             $stmt = $this->con->prepare($sql);
             $stmt->execute();
             $datos=$stmt->fetchAll(PDO::FETCH_ASSOC);
             return $datos;
        }
    }
    $inscripcion=new Inscripcion;
?>        