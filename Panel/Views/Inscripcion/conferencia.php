<h1>Inscripcion Conferencias</h1>
<table class="table" style="background-color: #e3f2fd;">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">titulo</th>
            <th scope="col">fecha</th>
            <th scope="col">hora Inicio</th>
            <th scope="col">hora Finalizacion</th>
            <th scope="col">Num participantes</th>
            </tr>
        </thead>
        <tbody>

            <?php
                foreach ($datos as $key => $dato):
            ?>
            <tr>
                <th scope="row"><?php echo $dato['id_evento']; ?></th>
                <td><?php echo $dato['titulo']; ?></td>
                <td><?php echo $dato['fecha']; ?></td>
                <td><?php echo $dato['hora_inicio']; ?></td>
                <td><?php echo $dato['hora_fin']; ?></td>
                <td><?php echo $dato['inscritos']; ?></td>
                <td>  
                    <lu>
                    <i class="btn btn-outline-success bi-pencil"><a href="CtrlInscripcion.php?accion=participante&id_evento=<?php echo $dato['id_evento']; ?>&id_conferencia_p=<?php echo $dato['id_conferencia_p']; ?>&id_conferencia=<?php echo $dato['id_conferencia']; ?>">   Insicribir</a></i>
                    </lu>
                </td>
            </tr>

            <?php
                endforeach;
            ?>

        </tbody>
</table>