<?php
    require_once('Sistema.class.php');  
    require_once('mdlUsuarios.class.php');
    require_once('mdlUsuario_rol.class.php');
    require_once('mdlRol.class.php');

    $sistema -> validarRol('Administrador');

    $id_usuario = NULL;
    $accion = NULL;
    if(isset($_GET['accion'])){
        $id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : NULL;
        $accion = $_GET['accion'];
    }

    require_once('Views/header.php');

    switch($accion){
        case 'readOne':
            $datos = $usuario->readOne($id_usuario);
            if(is_array($datos)){
                require_once('Views/Usuario/index.php');
            } else{
                $usuario->message(0,"Ocurrio un error, la el usario no exixte");
                $datostipo = $usuario->read();
                require_once('Views/Usuario/form.php');
            }
        break;

        case 'new':
            $datostipo = $usuario->read();
            require_once('Views/Usuario/form.php');
        break;

        case 'add':  
            $datos = $_POST;
            $resultado = $usuario->create($datos);
            $usuario->message($resultado, ($resultado)?"El usuario se agrego correctamente": "Ocurrio un error al agregar el usuario");
            $datos = $usuario->read();
            require_once('Views/Usuario/index.php');
        break;

        case 'modify':
            $datos = $usuario->readOne($id_usuario);
            $datos_roles = $rol->read();
            $datos_usuario_rol = $usuarioRol -> roles_usuario($id_usuario);
            if(is_array($datos)){
                require_once('Views/Usuario/form.php');
            } else{
                $usuario->message(0,"Ocurrio un error, el usuario no exixte");
                $datostipo = $usuario->read();
                require_once('Views/Usuario/form.php');
            }
        break;

        case 'update':
            $datos=$_POST;
            $resultado=$usuario->update($datos,$id_usuario);
            $usuario->message($resultado, ($resultado)?"El usuario se modifco correctamente": " Ocurrio un error al modificar el usuario");
            $datos = $usuario->read();
            require_once('Views/Usuario/index.php');
        break;

        case 'delete':
            $resultado = $usuario->delete($id_usuario);
            $usuario->message($resultado, ($resultado)?"El usuario se elimino correctamente": "Ocurrio un error al eliminar el usuario");
        default:
            $datos = $usuario->read();
            require_once('Views/Usuario/index.php');
    }


    require_once('Views/footer.php');


?>