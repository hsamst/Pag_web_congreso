<h1>Eventos</h1>
<a href="CtrlInscripcion.php?accion=new" class="btn btn-primary"> Añadir nuevo Evento</a>
<table class="table" style="background-color: #e3f2fd;">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Evento</th>
            <th scope="col">conferencia</th>
            <th scope="col">conferencistas</th>
            <th scope="col">inscritos</th>
            <th scope="col">opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($datos as $key => $dato):
            ?>
            <tr>
                <th scope="row"><?php echo $dato['id_evento']; ?></th>
                <td><?php echo $dato['evento']; ?></td>
                <td><?php echo $dato['conferencias']; ?></td>
                <td><?php echo $dato['conferencistas']; ?></td>
                <td><?php echo $dato['participantes']; ?></td>
                <td>  
                    <lu>
                    <i class="btn btn-outline-secondary bi-pencil"><a href="CtrlInscripcion.php?accion=new_conferencia&id_evento=<?php echo $dato['id_evento'];?>">  Nueva conferencia</a></i>
                    <i class="btn btn-outline-primary bi-pencil" ><a color="#FFFFFF" href="CtrlInscripcion.php?accion=inscribir&id_evento=<?php echo $dato['id_evento'];?>">  Inscripcion </a></i>
                    <i class="btn btn-outline-success"><a href="CtrlReporte.php?accion=lista&id_evento=<?php echo $dato['id_evento'];?>">  Reporte</a></i>  
                    </lu>
                </td>
            </tr>
            <?php
                endforeach;
            ?>
        </tbody>
</table>
