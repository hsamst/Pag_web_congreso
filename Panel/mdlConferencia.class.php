<?php
    require_once('Sistema.class.php');

    class Conferencia extends Sistema{
        
        public $id_conferencia;
        public $titulo;
        public $sinopsis;
        public $imagen;
        public $id_ponente;
       

        public function getId_conferencia(){
            return $this->id_conferencia;
        }


        public function setId_conferencia($id_conferencia){
            $this->id_conferencia = $id_conferencia;
            return $this;
        }

        public function getTitulo(){
            return $this->titulo;
        }


        public function setTitulo($titulo){
            $this->titulo = $titulo;
            return $this;
        }

        public function getSinopsis(){
            return $this->sinopsis;
        }

        public function setSinopsis($sinopsis){
            $this->sinopsis = $sinopsis;
            return $this;
        }

        public function getImagen(){
            return $this->imagen;
        }

        public function setImagen($imagen){
            $this->imagen = $imagen;
            return $this;
        }

        public function getId_ponente(){
            return $this->id_ponente;
        }

        /**
         * Set the value of id_ponente
         *
         * @return  self
         */ 
        public function setId_ponente($id_ponente)
        {
            $this->id_ponente = $id_ponente;
            return $this;
        }

        /* Metodos proncipales para la manipulacion de la informacion (CRUD)*/

        /**
         * Recuperar todos los ponentes
         *
         * @return  array
         */ 
        public function read(){
            $this->connect();
            $sql = "SELECT id_conferencia, 
                     titulo, 
                     sinopsis, 
                     imagen,  
                     CONCAT(nombre,' ',primer_apellido) as nombre,
                     ponente.id_ponente
                     FROM conferencia
                     INNER JOIN ponente on conferencia.id_ponente = ponente.id_ponente;";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos; 
        }
        public function readEvento($id_evento){
            $this->connect();
            $sql = "SELECT cp.id_evento, 
                    cp.id_conferencia_p, 
                    c.id_conferencia, 
                    c.titulo, 
                    cp.fecha, 
                    cp.hora_inicio, 
                    cp.hora_fin, 
                    COUNT(DISTINCT ip.id_participante) as inscritos 
                    from conferencia_programacion cp 
                    JOIN conferencia c on cp.id_conferencia=c.id_conferencia 
                    left join inscripcion_participante ip on cp.id_conferencia_p = ip.id_conferencia_p 
                    WHERE cp.id_evento=:id_evento;";
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':id_evento', $id_evento, PDO::PARAM_INT);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos; 
        }

        public function readConferencia($id_evento){
            $this->connect();
            $sql = "SELECT cp.id_evento, 
                            cp.id_conferencia_p, 
                            c.id_conferencia, 
                            c.titulo, 
                            cp.fecha, 
                            cp.hora_inicio, 
                            cp.hora_fin 
                    from conferencia_programacion cp 
                    JOIN conferencia c on cp.id_conferencia=c.id_conferencia 
                    WHERE cp.id_evento=:id_evento;";
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':id_evento', $id_evento, PDO::PARAM_INT);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos; 
        }

        /**
         * Retornar solo un ponente
         * @integger id_ponente
         * @return  array
         */ 
        public function readOne($id_conferencia){
            $this->connect();
            $sql = "SELECT titulo, 
                        sinopsis, 
                        imagen, 
                        CONCAT(nombre,' ',primer_apellido) as nombre,
                        ponente.id_ponente
                        from conferencia
                        INNER JOIN ponente on conferencia.id_ponente = ponente.id_ponente
                        WHERE conferencia.id_conferencia = :id_conferencia";
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':id_conferencia', $id_conferencia, PDO::PARAM_INT);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $datos = (isset($datos[0]))?$datos[0]:null;
            return $datos;
        }

  
        public function create($datos){
            $this->connect();
            $archivo = $this->cargarImagen("imagen","../image/ImgConferencias/");
            if(is_null($archivo)){
                $sql = "INSERT INTO conferencia (titulo, sinopsis, id_ponente) VALUES (:titulo, :sinopsis, :id_ponente)"; 
            } else{
                $sql = "INSERT INTO conferencia (titulo, sinopsis, imagen, id_ponente) VALUES (:titulo, :sinopsis, :imagen, :id_ponente)";
            }
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':id_ponente', $datos['id_ponente'], PDO::PARAM_INT);
            $stmt -> bindParam(':titulo', $datos['titulo'], PDO::PARAM_STR);
            $stmt -> bindParam(':sinopsis', $datos['sinopsis'], PDO::PARAM_STR);
            if(!is_null($archivo)){
                $stmt -> bindParam(':imagen', $archivo, PDO::PARAM_STR);
            }
            $rs = $stmt->execute();
            return  $stmt->rowCount();
        }

        public function update($datos, $id_conferencia){
            $this->connect();
            $archivo = $this->cargarImagen("imagen","../../image/ImgConferencias/");
            if(is_null($archivo)){
                $sql = "UPDATE conferencia set 
                            titulo = :titulo,
                            sinopsis = :sinopsis, 
                            id_ponente =  :id_ponente    
                            WHERE id_conferencia = :id_conferencia";
            } else{
                $sql = "UPDATE conferencia set 
                            titulo = :titulo,
                            sinopsis = :sinopsis, 
                            id_ponente =  :id_ponente,
                            imagen =  :imagen   
                        WHERE id_conferencia = :id_conferencia";
            }
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':titulo', $datos['titulo'], PDO::PARAM_STR);
            $stmt -> bindParam(':sinopsis', $datos['sinopsis'], PDO::PARAM_STR);
            $stmt -> bindParam(':id_ponente', $datos['id_ponente'], PDO::PARAM_INT);
            $stmt -> bindParam(':id_conferencia', $id_conferencia, PDO::PARAM_INT);
            if(!is_null($archivo)){
                $stmt -> bindParam(':imagen', $archivo, PDO::PARAM_STR);
            }
            $rs = $stmt->execute();
            return  $stmt->rowCount();;
        }

        public function delete($id_conferencia){
            $this->connect();
            $sql = "DELETE FROM conferencia WHERE id_conferencia = :id_conferencia";
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':id_conferencia', $id_conferencia, PDO::PARAM_INT);
            $rs = $stmt->execute();
            return $stmt->rowCount();
        }


    }  

    $conferencia = new Conferencia();

?>