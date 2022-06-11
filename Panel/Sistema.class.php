<?php
    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    require ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/protected/config.php');


    class Sistema{
        public $con;

        public function connect(){
            $dbDriver = "mysql";
            $dbHost = "localhost";
            $dbUser = "congreso";
            $dbPass = "123";
            $db = "congreso";
            /*$this->con = new mysqli($dbHost,$dbUser,$dbPass,$db);*/
            $this->con = new PDO($dbDriver.':host='.$dbHost.';dbname='.$db, $dbUser, $dbPass);
        }

        public function query($sql){
            $this->connect();
            $rs = $this->con->query($sql);
            return $rs;
        }

        public function cargarImagen($dimension, $destino){
           if($_FILES[$dimension]['error'] == 0){

                $tiposPermitidos = array("image/jpeg","image/gif","image/png");
                if(in_array($_FILES[$dimension]['type'],$tiposPermitidos)){ //validacion de tipos permitidos para ña catga de la fotografia 

                    if($_FILES[$dimension]['size']<=512000){ //Validacion de tamaño maximo del archivo (forografia)

                        $nombre = md5(time());
                        $extension = explode("/",$_FILES[$dimension]['type']);
                        $nombre = $nombre.".".$extension[1];
                        $destino = $destino.$nombre;
                
                        if(move_uploaded_file($_FILES[$dimension]['tmp_name'],$destino)){
                            return $nombre;
                        }
                    }
                
                }

           }
           return null;
        }

            //Manejador de mensajes 
        public function message($tipo,$texto){
            switch($tipo){
                case 0:
                    $color = "danger";
                     break;
                case 1:
                    $color = "success";
                    break;

                default: $color = "dark";
                    break;
            }

            require_once("views/message.php");
        }

        //Login
        public function login($correo,$contrasena){
            $this->connect();

            if($this->validarCorreo($correo)){
                $contrasena = md5($contrasena);
                $sql = "SELECT * FROM usuario 
                    WHERE correo = :correo 
                    and contrasena = :contrasena";
                $stmt = $this->con->prepare($sql);
                $stmt -> bindParam(':correo', $correo, PDO::PARAM_STR);
                $stmt -> bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
                $stmt->execute();
                $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if(isset($datos[0])){
                    return true;
                }
                return false; 
            }
        }

        //validar correo
        public function validarCorreo($correo){
            if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
                return true;
            }
            return false;
        }

        public function validarRol($rol){
            $roles = array();
            if(isset($_SESSION['roles'])){
                $roles = $_SESSION['roles'];
            }
    
            if(!in_array($rol,$roles)){
                require_once('Views/header.php');
                $this->message(0,"Ustes no tiene el rol necesario, consulate al administrador");
                require_once('Views/footer.php');
                die();
            }
        }

        //elimir la sesion 
        public function logOut(){
            unset($_SESSION);
            session_destroy();
        }




        public function sendMail($destinatario,$asunto,$mensaje){
            
            $mail = new PHPMailer();
            $mail->isSMTP();
            //Enable SMTP debugging
            //SMTP::DEBUG_OFF = off (for production use)
            //SMTP::DEBUG_CLIENT = client messages
            //SMTP::DEBUG_SERVER = client and server messages
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->SMTPAuth = true;
            $mail->Username = '17030159@itcelaya.edu.mx';
            $mail->Password = SMTPPASSWORD;
            $mail->setFrom('17030159@itcelaya.edu.mx', 'Samira Sanchez');
            $mail->addReplyTo('17030159@itcelaya.edu.mx', 'Samira Sanchez');
            $mail->addAddress($destinatario, 'Samira Sanchez');
            $mail->Subject = $asunto;
            $mail->msgHTML($mensaje);
            $mail->AltBody = 'This is a plain-text message body';
    
            if (!$mail->send()) {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message sent!';
            }
        }


        public function token($correo){

            if($this->validarCorreo($correo)){
                $token = substr(hash('sha256',bin2hex(random_bytes(16)).'CruzAzulCampeon'),1,16);
                $this->connect();
                $sql = "UPDATE usuario SET token = :token WHERE correo = :correo";
                $stmt = $this->con->prepare($sql);
                $stmt -> bindParam(':correo', $correo, PDO::PARAM_STR);
                $stmt -> bindParam(':token', $token, PDO::PARAM_STR);
                $rs = $stmt->execute();
                if ($stmt->rowCount()>=1) {
                    return $token;
                }
                return false; 

            }
            return false; 
            
        }


        public function changepassword($datos){
            if($this->validarCorreo($datos['correo']) && isset($datos['token'])){
                $this->connect();
                $sql = "UPDATE usuario SET contrasena = :contrasena, token = null WHERE correo = :correo and token = :token";
                $stmt = $this->con->prepare($sql);
                $datos['contrasena'] = md5($datos['contrasena']);
                $stmt -> bindParam(':token', $datos['token'], PDO::PARAM_STR);
                $stmt -> bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
                $stmt -> bindParam(':contrasena', $datos['contrasena'], PDO::PARAM_STR);
                $rs = $stmt->execute();
                if ($stmt->rowCount()>=1) {
                    return true;
                }
            }
            return false;
        }
    }

    $sistema = new Sistema();
?>