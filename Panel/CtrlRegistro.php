<?php 
    require_once('mdlRegistro.class.php');
    $accion = NULL;
    if (isset($_GET['accion'])) {
        $accion = $_GET['accion'];
    }
    require_once('Views/headerSinMenu.php');
    switch ($accion) {
        case 'register':
            $datos = $_POST;
            if ($registro->register($datos)) {
                $sistema->message(1, "Se ha registrado el partcipante, Ingrese sus credenciales");
                require_once('Views/Login/login.php');
            }
            else{
                $sistema->message(0, "Ocurrio un error");
            }
        break;

        default:
            require_once('Views/Registro/form.php');
    }

    require_once('Views/footer.php');
?>