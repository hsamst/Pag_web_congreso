<?php
    require_once('mdlRol.class.php');
    $sistema -> validarRol('Administrador');
    $id_rol = NULL;
    $accion = NULL;
    if(isset($_GET['accion'])){
        $id_rol = isset($_GET['id_rol']) ? $_GET['id_rol'] : NULL;
        $accion = $_GET['accion'];
    }

    require_once('Views/header.php');

    switch($accion){
        case 'readOne':
            $datos = $rol->readOne($id_rol);
            if(is_array($datos)){
                require_once('Views/Rol/index.php');
            } else{
                $rol->message(0,"Ocurrio un error, el rol no exixte");
                $datostipo = $rol->read();
                require_once('Views/Rol/form.php');
            }
        break;

        case 'new':
            $datostipo = $rol->read();
            require_once('Views/Rol/form.php');
        break;

        case 'add':  
            $datos = $_POST;
            $resultado = $rol->create($datos);
            $rol->message($resultado, ($resultado)?"El rol se agrego correctamente": "Ocurrio un error al agregar el rol");
            $datos = $rol->read();
            require_once('Views/Rol/index.php');
        break;

        case 'modify':
            $datos = $rol->readOne($id_rol);
            $datostipo = $rol->read();
            if(is_array($datos)){
                require_once('Views/Rol/form.php');
            } else{
                $rol->message(0,"Ocurrio un error, el rol no exixte");
                $datostipo = $rol->read();
                require_once('Views/Rol/form.php');
            }
        break;

        case 'update':
            $datos=$_POST;
            $resultado=$rol->update($datos,$id_rol);
            $rol->message($resultado, ($resultado)?"El rol se modifco correctamente": "Ocurrio un error al modificar el rol");
            $datos = $rol->read();
            require_once('Views/Rol/index.php');
        break;

        case 'delete':
            $resultado = $rol->delete($id_rol);
            $rol->message($resultado, ($resultado)?"El rol se elimino correctamente": "Ocurrio un error al eliminar el rol");
        default:
            $datos = $rol->read();
            require_once('Views/Rol/index.php');
    }


    require_once('Views/footer.php');


?>