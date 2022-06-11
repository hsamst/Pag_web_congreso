<?php
    $content = "
    <h1>".$datos['evento']."</h1>
    <h1>".$datos['fecha_inicio']."</h1>
    <h1>".$datos['fecha_fin']."</h1>";
    foreach ($conferencias as $key => $conferencia):
        $content.="<h4>".$conferencia['titulo']."</h4>";
        $content.="<h4>".$conferencia['primer_apellido']." ".$conferencia['segundo_apellido']." ". $conferencia['nombre']."</h4>";
        $content.="<h4>".$conferencia['fecha']." ".$conferencia['hora_inicio']." ".$conferencia['hora_inicio']."</h4>";
        foreach ($participantes[$key] as $key2 => $participante):
            $content.=$participante['nombre'];
            $content.="<br>";
        endforeach;
        $content.="<hr />";
    endforeach;
    return $content;
?>