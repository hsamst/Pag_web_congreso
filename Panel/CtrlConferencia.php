<?php
    require_once('mdlConferencia.class.php');
    require_once('mdlPonente.class.php');

    $sistema -> validarRol('Usuario');

    $id_conferencia = NULL;
    $accion = NULL;
    if(isset($_GET['accion'])){
        $id_conferencia = isset($_GET['id_conferencia']) ? $_GET['id_conferencia'] : NULL;
        $accion = $_GET['accion'];
    }

    require_once('Views/header.php');

    switch($accion){
        case 'readOne':
            $datos = $conferencia->readOne($id_conferencia);
            if(is_array($datos)){
                require_once('Views/Conferencia/index.php');
            } else{
                $conferencia->message(0,"Ocurrio un error, la conferencia no exixte");
                $datostipo = $conferencia->read();
                require_once('Views/Conferencia/form.php');
            }
        break;

        case 'new':
            $sistema -> validarRol('Administrador');
            $datostipo = $ponente->read();
            require_once('Views/Conferencia/form.php');
        break;

        case 'add':
            $sistema -> validarRol('Administrador');  
            $datos = $_POST;
            $resultado = $conferencia->create($datos);
            $conferencia->message($resultado, ($resultado)?"La conferencia se agrego correctamente": "Ocurrio un error al agregar La conferencia");
            $datos = $conferencia->read();
            require_once('Views/Conferencia/index.php');
        break;

        case 'modify':
            $sistema -> validarRol('Administrador');
            $datos = $conferencia->readOne($id_conferencia);
            $datostipo = $ponente->read();
            if(is_array($datos)){
                require_once('Views/Conferencia/form.php');
            } else{
                $conferencia->message(0,"Ocurrio un error, la conferencia no exixte");
                $datostipo = $ponente->read();
                require_once('Views/Conferencia/form.php');
            }
        break;

        case 'update':
            $sistema -> validarRol('Administrador');
            $datos=$_POST;
            $resultado=$conferencia->update($datos,$id_conferencia);
            $conferencia->message($resultado, ($resultado)?"La conferencia se modifco correctamente": "Ocurrio un error al modificar la conferencia");
            $datos = $conferencia->read();
            require_once('Views/Conferencia/index.php');
        break;

        case 'delete':
            $sistema -> validarRol('Administrador');
            $resultado = $conferencia->delete($id_conferencia);
            $conferencia->message($resultado, ($resultado)?"La conferencia se elimino correctamente": "Ocurrio un error al elimar la conferencia");
        default:
            $datos = $conferencia->read();
            require_once('Views/Conferencia/index.php');
    }


    require_once('Views/footer.php');


?>