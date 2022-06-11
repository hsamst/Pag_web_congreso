<?php
    require_once('Sistema.class.php');  
    require_once('mdlUsuarios.class.php');

    $accion = NULL;
    if(isset($_GET['accion'])){
        $accion = $_GET['accion'];
    }
    require_once('Views/headerSinMenu.php');
    switch($accion){
        case 'recovery';
        require_once('Views/Login/recuperacion.php');
            break;
        
            case 'change';
                if (isset($_GET['correo']) && isset($_GET['token'])) {
                    $datos = $_GET;
                    require_once('Views/Login/cambio.php');
                }
                else{
                    $sistema -> message(0,"Lo sentimos, el procedimimiento no se puede llevar acabo");
                }

                break;

            case 'login';
                $datos = $_POST;
                if($usuario->login($datos['correo'], $datos['contrasena'])){
                    $usuario -> credentials($datos['correo']);
                    header('Location: CtrlInicioAdm.php');
                    
                }
                else{
                    $sistema -> message(0,"Usuario o contraseña invalidas, porfavor ingresa campos validos");
                    $sistema -> logOut();
                    require_once('Views/Login/login.php');
                    }
                break;
            
            case 'logOut';
                $sistema -> message(1,"La sesion se ha cerrado");
                $sistema -> logOut();
                require_once('Views/Login/login.php');
                break;

            case 'sendMail';
               
                break;

            case 'token';
                $datos = $_POST;
                $token = $sistema -> token($datos['correo']);
                $contenido = "
                    <h1> Recuperacionde Contraseña </h1>
                    <p> Usted ha solicitado un cambio de contraseña, haga click el la siguiente elnace para proceder</p>
                    <a href = 'http://localhost/Proyecto/Panel/CtrlLogin.php?accion=change&correo=".$datos['correo']."&token=".$token."'> Restablecer Contraseña </a>";
                if($token){
                    $sistema -> sendMail($datos['correo'],'Recuperacion de contraseña',$contenido);
                    $sistema -> message(1,"Se ha enviado un correo electronico de recuperacion");
                    require_once('Views/Login/login.php');
                }
                else{
                    $sistema -> message(0,"Error, la direccion de correo es invalida, no existe");
                    require_once('Views/Login/login.php');
                }
                break;

            case 'update';
               $datos = $_POST;
               if (isset($datos['correo']) && isset($datos['contrasena']) && isset($datos['token'])) {
                   if($sistema -> changepassword($datos)){
                        $sistema -> message(1,"Se ha cambiado la contraseña, profavor ingrese sus nuevas credenciales");
                        
                    }else{
                        $sistema -> message(0,"Error, no se puede procesar su solicitud");
                    }
                }
               else{
                    $sistema -> message(0,"Error, no se puede procesar su solicitud");
                }
                require_once('Views/Login/login.php');
            break;
        default:
            require_once('Views/Login/login.php');
    }
    require_once('Views/footer.php');
?>