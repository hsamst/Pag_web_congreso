<?php
    require_once('Sistema.class.php');
    
    

    class Usuario extends Sistema{

        public $id_usuario;
        public $correo;
        public $contrasena;


        public function getId_usuario(){
            return $this->id_usuario;
        }

        public function setId_usuario($id_usuario){
            $this->id_usuario = $id_usuario;
            return $this;
        }

        public function getCorreo(){
            return $this->correo;
        }

        public function setCorreo($correo){
            $this->correo = $correo;
            return $this;
        }

        public function getContrasena(){
            return $this->contrasena;
        }

        public function setContrasena($contrasena){
            $this->contrasena = $contrasena;
            return $this;
        }


        public function read(){
            $this->connect();
            $sql = "SELECT id_usuario, 
                     correo, 
                     contrasena
                     FROM usuario;";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos; 
        }

        public function readOne($id_usuario){
            $this->connect();
            $sql = "SELECT correo, 
                        contrasena 
                        from usuario
                        WHERE usuario.id_usuario = :id_usuario";
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $datos = (isset($datos[0]))?$datos[0]:null;
            return $datos;
        }

        public function create($datos){
            $this->connect();
            $sql = "INSERT INTO usuario (correo, contrasena) VALUES (:correo, :contrasena)"; 
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
            $datos['contrasena'] = md5($datos['contrasena']);
            $stmt -> bindParam(':contrasena', $datos['contrasena'], PDO::PARAM_STR);
            $rs = $stmt->execute();
            return  $stmt->rowCount();
        }

        public function update($datos, $id_usuario){
            require_once('mdlUsuario_rol.class.php');
            $usuarioRol = new UsuarioRol();
            $this->connect();
            $rs = $usuarioRol -> delete($id_usuario);

            if(isset($datos['roles'])){
                foreach($datos['roles'] as $key => $value){
                    $usuarioRol -> create($id_usuario,$value);
                }
            }

            $sql = "UPDATE usuario set 
            correo = :correo    
            WHERE id_usuario = :id_usuario";
            if(strlen($datos['contrasena'])>0){
                $sql = "UPDATE usuario set 
                correo = :correo,
                contrasena = :contrasena     
                WHERE id_usuario = :id_usuario";
            }
           
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt -> bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
            if(strlen($datos['contrasena'])>0){
                $datos['contrasena'] = md5($datos['contrasena']);
                $stmt -> bindParam(':contrasena', $datos['contrasena'], PDO::PARAM_STR);
            }
            $rs = $stmt->execute();
            return  $stmt->rowCount();
        }

        public function delete($id_usuario){
            $this->connect();
            $sql = "DELETE FROM usuario WHERE id_usuario = :id_usuario";
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $rs=$stmt->execute();
            return $stmt->rowCount();
        }


//////////////////////////////credenciales del usuario
        public function credentials($correo){
            $_SESSION['correo'] = $correo;
            $sql = "SELECT r.rol from rol r inner join usuario_rol u on r.id_rol=u.id_rol INNER JOIN usuario us on u.id_usuario= us.id_usuario where us.correo= :correo" ;
            $stmt = $this->con->prepare($sql);
            $stmt -> bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->execute();
            $datos=array();
            $_SESSION['roles']=array();
            $datos=$stmt -> fetchAll(PDO::FETCH_ASSOC);
            foreach($datos as $key => $value){
                array_push($_SESSION['roles'],$value['rol']);
            }
            $_SESSION['validado'] = true;
        }

    }

    $usuario = new Usuario();

?>