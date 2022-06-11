<?php
    require_once('Sistema.class.php');

    class Reporte extends Sistema{

        public function lista($id_evento){
            $this->connect();
            $sql = "SELECT * FROM evento WHERE id_evento = :id_evento;";
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':id_evento', $id_evento, PDO::PARAM_INT);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $datos = (isset($datos[0]))?$datos[0]:null;
            if (! is_null($datos)) {
                $sql = "SELECT id_conferencia_p, titulo, primer_apellido, segundo_apellido, nombre, fecha, hora_inicio from conferencia c join ponente p 
                USING (id_ponente) JOIN conferencia_programacion cp ON c.id_conferencia = cp.id_conferencia WHERE cp.id_evento = :id_evento ORDER BY
                fecha, c.id_conferencia, cp.hora_inicio;";
                $stmt = $this->con->prepare($sql);
                $stmt -> bindParam(':id_evento', $id_evento, PDO::PARAM_INT);
                $stmt->execute();

                $conferencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($conferencias as $key => $conferencia){
                    $sql = "SELECT p.id_participante, p.apaterno, p.amaterno, nombre FROM participante p JOIN inscripcion_participante ip on p.id_participante 
                    = ip.id_participante WHERE ip.id_conferencia_p = :id_conferencia_p;";
                     $stmt = $this->con->prepare($sql);
                     $stmt -> bindParam(':id_conferencia_p', $conferencia['id_conferencia_p'], PDO::PARAM_INT);
                     $stmt->execute();
                     $participantes[$key] = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                $content = include('Views/Reportes/lista.php');
            }else{
                $content = 'No se puede mostrar el reporte';
            }
            return $content;
        }
    }

    $reporte = new Reporte;
?>