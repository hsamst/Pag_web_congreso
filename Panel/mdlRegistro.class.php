<?php
    require_once('Sistema.class.php');

    class Registro extends Sistema{
 
        public function register($datos){
            if ($this->validarCorreo($datos['correo'])) {
                if (isset($datos['nombre']) && isset($datos['contrasena'])) {
                    $this->connect();
                    $this->con->beginTransaction();
                    try{
                        $sql = "INSERT INTO usuario (correo,contrasena) VALUES (:correo, :contrasena)";
                        $stmt = $this->con->prepare($sql);
                        $datos['contrasena'] = md5($datos['contrasena']);
                        $stmt->bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
                        $stmt->bindParam(':contrasena', $datos['contrasena'], PDO::PARAM_STR);
                        $rs = $stmt->execute();
                        if ($stmt->rowCount()>0) {
                            $sql =  "SELECT * FROM usuario WHERE correo = :correo";
                            $stmt = $this->con->prepare($sql);
                            $stmt->bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
                            $rs = $stmt->execute();
                            $usuario = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            $sql = "INSERT INTO usuario_rol(id_usuario,id_rol) VALUES (:id_usuario, 7/*2*/),(:id_usuario, 11/*6*/)";
                            $stmt = $this->con->prepare($sql);
                            $stmt->bindParam(':id_usuario', $usuario[0]['id_usuario'], PDO::PARAM_INT);
                            $stmt->execute();
                            if ($stmt->rowCount()>1) {
                                $sql = "INSERT INTO participante(nombre, apaterno, amaterno, id_tipo, id_usuario) VALUES
                                    (:nombre, :apaterno, :amaterno, 4 /*6*/, :id_usuario)";
                                $stmt = $this->con->prepare($sql);
                                $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
                                $stmt->bindParam(':apaterno', $datos['apaterno'], PDO::PARAM_STR);
                                $stmt->bindParam(':amaterno', $datos['amaterno'], PDO::PARAM_STR);
                                $stmt->bindParam(':id_usuario', $usuario[0]['id_usuario'], PDO::PARAM_INT);
                                $rs = $stmt->execute();
                                if ($stmt->rowCount()>0) {
                                    $this->sendMail($datos['correo'], "Bienvenido al congreso", "Ingrese al congreso y de mas");
                                    $this->con->commit();
                                    return true;
                                }
                            }
                        }
                        $this->con->rollback();
                        return false;
                    }catch (Exception $e){
                    $this->con->rollback();
                    return false;
                    }
                }
            }
            return false;
            
        }

       
    }

    $registro = new Registro;
    
?>