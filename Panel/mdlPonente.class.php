<?php
    require_once('Sistema.class.php');

    class Ponente extends Sistema{
        
        public $id_ponente;
        public $nombre;
        public $primer_apellido;
        public $segundo_apellido;
        public $tratamiento;
        public $correo;
        public $resumen;
        public $fotografia;
        public $id_tipo;
        
        public function getId_ponente() {
            return $this->id_ponente;
        }

        public function setId_ponente($id_ponente){
            $this->id_ponente = $id_ponente;
            return $this;
        }



        public function getNombre(){
            return $this->nombre;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
            return $this;
        }

 
        public function getPrimer_apellido(){
            return $this->primer_apellido;
        }

        public function setPrimer_apellido($primer_apellido){
            $this->primer_apellido = $primer_apellido;
            return $this;
        }


        public function getSegundo_apellido(){
            return $this->segundo_apellido;
        }
 
        public function setSegundo_apellido($segundo_apellido){
            $this->segundo_apellido = $segundo_apellido;
            return $this;
        }


        public function getTratamiento(){
            return $this->tratamiento;
        }

        public function setTratamiento($tratamiento){
            $this->tratamiento = $tratamiento;
            return $this;
        }


        public function getCorreo(){
            return $this->correo;
        }
 
        public function setCorreo($correo){
            $this->correo = $correo;
            return $this;
        }


        public function getResumen(){
            return $this->resumen;
        }

        /**
         * Set the value of resumen
         *
         * @return  self
         */ 
        public function setResumen($resumen){
            $this->resumen = $resumen;
            return $this;
        }

        /**
         * Get the value of fotografia
         */ 
        public function getFotografia(){
            return $this->fotografia;
        }

        /**
         * Set the value of fotografia
         *
         * @return  self
         */ 
        public function setFotografia($fotografia){
            $this->fotografia = $fotografia;
            return $this;
        }
        public function getId_tipo()
        {
                return $this->id_tipo;
        }

        public function setId_tipo($id_tipo)
        {
                $this->id_tipo = $id_tipo;

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
            $sql = "SELECT ponente.id_ponente, 
                CONCAT(nombre,' ',primer_apellido) as nombre, 
                tipo.tipo, 
                fotografia 
                from ponente 
                INNER JOIN tipo on ponente.id_tipo = tipo.id_tipo; ";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos; 
        }

        /**
         * Retornar solo un ponente
         * @integger id_ponente
         * @return  array
         */ 
        public function readOne($id_ponente){
            $this->connect();
            $sql = "SELECT *, 
                CONCAT(nombre,' ',primer_apellido) as nombre, 
                tipo.tipo, 
                fotografia 
                from ponente 
                INNER JOIN tipo on ponente.id_tipo = tipo.id_tipo 
                where ponente.id_ponente = :id_ponente";
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':id_ponente', $id_ponente, PDO::PARAM_INT);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $datos = (isset($datos[0]))?$datos[0]:null;
            return $datos;
        }

        /**
         * Generar un nievo ponente e insertarlo en la DB
         * 
         * @return  boolean
         */ 
        public function create($datos){
            $this->connect();
            $archivo = $this->cargarImagen("fotografia","../image/ImgPonentes/");
            if(is_null($archivo)){
                $sql = "INSERT INTO ponente (id_tipo,nombre,primer_apellido,segundo_apellido,tratamiento,correo,resumen) VALUES (:id_tipo, :nombre, :primer_apellido, :segundo_apellido, :tratamiento, :correo, :resumen)"; 
            } else{
                $sql = "INSERT INTO ponente (id_tipo,fotografia,nombre,primer_apellido,segundo_apellido,tratamiento,correo,resumen) VALUES (:id_tipo, :fotografia, :nombre, :primer_apellido, :segundo_apellido, :tratamiento, :correo, :resumen)";
            }
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':id_tipo', $datos['id_tipo'], PDO::PARAM_INT);
            $stmt -> bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
            $stmt -> bindParam(':primer_apellido', $datos['primer_apellido'], PDO::PARAM_STR);
            $stmt -> bindParam(':segundo_apellido', $datos['segundo_apellido'], PDO::PARAM_STR);
            $stmt -> bindParam(':tratamiento', $datos['tratamiento'], PDO::PARAM_STR);
            $stmt -> bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
            $stmt -> bindParam(':resumen', $datos['resumen'], PDO::PARAM_STR);
            if(!is_null($archivo)){
                $stmt -> bindParam(':fotografia', $archivo, PDO::PARAM_STR);
            }
            $rs = $stmt->execute();
            return  $stmt->rowCount();;
        }

        /**
         * Modoficar un ponente
         * recibo un array y un entero
         * @return  boolean
         */ 
        public function update($datos, $id_ponente){
            $this->connect();
            $archivo = $this->cargarImagen("fotografia","../image/ImgPonentes/");
            if(is_null($archivo)){
                $sql = "UPDATE ponente set 
                                nombre = :nombre  , 
                                primer_apellido = :primer_apellido  , 
                                segundo_apellido =  :segundo_apellido  ,
                                tratamiento = :tratamiento  , 
                                correo = :correo  , resumen = :resumen  , 
                                id_tipo = :id_tipo    
                        WHERE id_ponente = :id_ponente";
            } else{
                $sql = "UPDATE ponente set 
                                nombre = :nombre  , 
                                primer_apellido = :primer_apellido  , 
                                segundo_apellido =  :segundo_apellido  ,
                                tratamiento = :tratamiento  , 
                                correo = :correo  , 
                                resumen = :resumen  , 
                                id_tipo = :id_tipo, 
                                fotografia = :fotografia
                        WHERE id_ponente = :id_ponente";
            }
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
            $stmt -> bindParam(':primer_apellido', $datos['primer_apellido'], PDO::PARAM_STR);
            $stmt -> bindParam(':segundo_apellido', $datos['segundo_apellido'], PDO::PARAM_STR);
            $stmt -> bindParam(':tratamiento', $datos['tratamiento'], PDO::PARAM_STR);
            $stmt -> bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
            $stmt -> bindParam(':resumen', $datos['resumen'], PDO::PARAM_STR);
            $stmt -> bindParam(':id_tipo', $datos['id_tipo'], PDO::PARAM_INT);
            $stmt -> bindParam(':id_ponente', $id_ponente, PDO::PARAM_INT);

            if(!is_null($archivo)){
                $stmt -> bindParam(':fotografia', $archivo, PDO::PARAM_STR);
            }
            $rs = $stmt->execute();
            return  $stmt->rowCount();;
        }

        /**
         * Eliminar un ponente
         * 
         * @return  boolean
         */ 
        public function delete($id_ponente){
            $this->connect();
            $sql = "DELETE FROM ponente where id_ponente = :id_ponente";
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':id_ponente', $id_ponente, PDO::PARAM_INT);
            $rs = $stmt->execute();
            return $stmt->rowCount();
        }


    }

    $ponente = new Ponente();
    

    
?>