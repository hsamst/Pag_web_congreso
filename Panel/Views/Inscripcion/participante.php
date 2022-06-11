<h1>Inscribir en: <?php echo $conferencia['titulo']; ?></h1>
<form method="get" action="CtrlInscripcion.php">
    <select name="id_participante">
        <option value="...">...</option>
        <?php foreach ($participantes_disponibles as $key => $dato): ?>
            <option value="<?php echo $dato['id_participante'];?>"><?php echo $dato['apaterno']." ".$dato['amaterno']." ".$dato['nombre'];?></option>
            <?php endforeach; ?>
    </select>

    <input type="hidden" name="accion" value="participante"> </input>
    <input type="hidden" name="id_evento" value="<?php echo $id_evento;?>"> </input>
    <input type="hidden" name="id_conferencia_p" value="<?php echo $id_conferencia_p;?>"> </input>
    <input type="hidden" name="id_conferencia" value="<?php echo $id_conferencia;?>"> </input>
    <input type="submit" name="accion_participante" value="agregar"> </input>
</form>
<h1>Conferencias</h1>
<table class="table" style="background-color: #e3f2fd;">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Primer Apellido</th>
            <th scope="col">Segundo Apellido</th>
            <th scope="col">Nombres</th>
            <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>

            <?php
                foreach ($inscritos as $key => $dato):
            ?>
            <tr>
                <th scope="row"><?php echo $dato['id_participante']; ?></th>
                <td><?php echo $dato['apaterno']; ?></td>
                <td><?php echo $dato['amaterno']; ?></td>
                <td><?php echo $dato['nombre']; ?></td>
                <td>  
                    <lu>
                    <i class="btn btn-outline-danger bi-trash"><a href="CtrlInscripcion.php?accion=participante&id_evento=<?php echo $id_evento; ?>&id_conferencia_p=<?php echo $id_conferencia_p; ?>&id_conferencia=<?php echo $id_conferencia; ?>&id_participante=<?php echo $dato['id_participante'];?>&accion_participante=eliminar">   Eliminar</a></i>
                    </lu>
                </td>
            </tr>

            <?php
                endforeach;
            ?>

        </tbody>
</table>