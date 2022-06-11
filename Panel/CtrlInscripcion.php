<?php
    require_once('mdlInscripcion.class.php');
    require_once('mdlConferencia.class.php');
    require_once('mdlEvento.php');

   // $sistema -> validarRol('Usuario');

    $id_conferencia = NULL;
    $accion = NULL;
    if(isset($_GET['accion'])){
        $id_evento = isset($_GET['id_evento']) ? $_GET['id_evento'] : NULL;
        $accion = $_GET['accion'];
    }

    require_once('Views/header.php');

    switch($accion){
        case 'read':
            $datos=$inscripcion->read();
            require_once('Views/Inscripcion/index.php');
        break;

        case 'inscribir':
           $datos= $conferencia->readEvento($id_evento);
           require_once('Views/Inscripcion/conferencia.php');
        break;

        case 'participante':
            $id_conferencia = $_GET['id_conferencia'];
            $id_conferencia_p = $_GET['id_conferencia_p'];
            $accion_participante = null;

            if(isset($_GET['accion_participante'])){
                $id_participante = isset($_GET['id_participante']) ? $_GET['id_participante'] : NULL;
                $accion_participante = $_GET['accion_participante'];
            } 
            switch($accion_participante){
                case 'eliminar':
                    $inscripcion -> eliminar($id_conferencia_p, $id_participante);
                    break;
                case 'agregar':
                    $inscripcion -> agregar($id_conferencia_p, $id_participante);
                break;
            }

            $datos= $conferencia->readEvento($id_evento);
            $inscritos = $inscripcion->inscritos($id_conferencia_p);
            $conferencia = $conferencia->readOne($id_conferencia);
            $participantes_disponibles = $inscripcion->participantes_disponibles();
            require_once('Views/Inscripcion/participante.php');
        break;

        case 'new':
            require_once('Views/Eventos/form.php');
        break;

        case 'add': 
            $sistema -> validarRol('Administrador'); 
            $datos = $_POST;
            $resultado = $evento->create($datos);
            $evento->message($resultado, ($resultado)?"El evento se agrego correctamente": "Ocurrio un error al agregar al evento");
            $datos = $inscripcion->read();
            require_once('Views/Inscripcion/index.php');
        break;

        case 'new_conferencia':
            $datos= $conferencia->readConferencia($id_evento);
            $conferencias_disponibles = $inscripcion->conferencias_disponibles();
            require_once('Views/Inscripcion/mostrarConferencia.php');
        break;
        
        case 'conferencia':
            $id_evento = $_GET['id_evento'];
            $id_conferencia = $_GET['id_conferencia'];
            $accion_conferencia = null;

            if(isset($_GET['accion_conferencia'])){
                $id_conferencia = isset($_GET['id_conferencia']) ? $_GET['id_conferencia'] : NULL;
                $accion_conferencia = $_GET['accion_conferencia'];
            } 
            switch($accion_conferencia){
                case 'agregar':
                    $fecha = $_GET['fecha'];
                    $hora_inicio = $_GET['hora_inicio'];
                    $hora_fin = $_GET['hora_fin'];
                    $inscripcion -> agregarConferencia($id_evento, $id_conferencia,$fecha, $hora_inicio, $hora_fin);
                break;
                case 'eliminar':
                    $inscripcion -> eliminarConferencia($id_evento, $id_conferencia);
                break;
            }

            $datos= $conferencia->readConferencia($id_evento);
            $conferencia = $conferencia->readOne($id_conferencia);
            $conferencias_disponibles = $inscripcion->conferencias_disponibles();
            require_once('Views/Inscripcion/mostrarConferencia.php');
        break;

        case 'delete':
        default:
            $datos = $inscripcion->read();
            require_once('Views/Inscripcion/index.php');
    }
    require_once('Views/footer.php');
?>