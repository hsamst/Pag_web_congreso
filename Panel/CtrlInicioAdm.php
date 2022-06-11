<?php
 require_once('mdlInicioAdm.class.php');

 $sistema -> validarRol('Usuario');
    require_once('Views/header.php');
    $accion = NULL;
    switch($accion){
        default:
            $participante['ponente']=$inicioAdm->conteoParticipantes(1);
            $participante['panelista']=$inicioAdm->conteoParticipantes(2);
            $participante['moderador']=$inicioAdm->conteoParticipantes(3);
            $conferencia['conferencia']=$inicioAdm->conteoConferencias();
            require_once('Views/InicioAdm/index.php');
    }
    require_once('Views/footer.php');


?>