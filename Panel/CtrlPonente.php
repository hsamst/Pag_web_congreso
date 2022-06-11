<?php
    require_once('mdlPonente.class.php');
    require_once('mdlTipo.class.php');

    $sistema -> validarRol('Usuario');

    $id_ponente = NULL;
    $accion = NULL;
    if(isset($_GET['accion'])){
        $id_ponente = isset($_GET['id_ponente']) ? $_GET['id_ponente'] : NULL;
        $accion = $_GET['accion'];
    }

    require_once('Views/header.php');

    switch($accion){
        case 'readOne':
            $datos = $ponente->readOne($id_ponente);
            if(is_array($datos)){
                require_once('Views/Ponente/index.php');
            } else{
                $ponente->message(0,"Ocurrio un error, el ponente no exixte");
                $datostipo = $tipo->read();
                require_once('Views/Ponente/form.php');
            }
            
        break;

        case 'new':
            $sistema -> validarRol('Administrador');
            $datostipo = $tipo->read();
            require_once('Views/Ponente/form.php');
            
        break;

        case 'add': 
            $sistema -> validarRol('Administrador'); 
            $datos = $_POST;
            $resultado = $ponente->create($datos);
            $ponente->message($resultado, ($resultado)?"El ponente se agrego correctamente": "Ocurrio un error al agregar al Ponente");
            $datos = $ponente->read();
            require_once('Views/Ponente/index.php');
        break;

        case 'modify':
            $sistema -> validarRol('Administrador');
            $datos = $ponente->readOne($id_ponente);
            $datostipo = $tipo->read();
            if(is_array($datos)){
                require_once('Views/Ponente/form.php');
            } else{
                $ponente->message(0,"Ocurrio un error, el ponente no exixte");
                $datostipo = $tipo->read();
                require_once('Views/Ponente/form.php');
            }
            

        break;

        case 'update':
            $sistema -> validarRol('Administrador');
            $datos=$_POST;
            $resultado=$ponente->update($datos,$id_ponente);
            $ponente->message($resultado, ($resultado)?"El ponente se modifco correctamente": "Ocurrio un error al modificar al Ponente");
            $datos = $ponente->read();
            require_once('Views/Ponente/index.php');
        break;

        case 'delete':
            $sistema -> validarRol('Administrador');
            $resultado = $ponente->delete($id_ponente);
            $ponente->message($resultado, ($resultado)?"El ponente se elimino correctamente": "Ocurrio un error al elimar al Ponente");
        

        default:
            $datos = $ponente->read();
            require_once('Views/Ponente/index.php');
    }


    require_once('Views/footer.php');


?>