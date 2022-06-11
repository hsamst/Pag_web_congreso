<h1> ¡Roles! </h1>
<a href="CtrlRol.php?accion=new" class="btn btn-primary"> Añadir nuevo rol</a>
<table class="table" style="background-color: #e3f2fd;">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">rol</th>
            <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>

            <?php
                foreach ($datos as $key => $dato):
            ?>

            <tr>
            <td><?php echo $dato['id_rol'] ?></td>
            <td><?php echo $dato['rol'] ?></td>

                <td>  
                    <lu>
                    <i class="btn btn-outline-success bi-pencil"><a href="CtrlRol.php?accion=modify&id_rol=<?php echo $dato['id_rol']; ?>">Modificar</a></i>
                    <i class="btn btn-outline-danger bi bi-trash"><a href="CtrlRol.php?accion=delete&id_rol=<?php echo $dato['id_rol']; ?>">Eliminar</a></i>
                    </lu>
                </td>

            </tr>

            <?php
                endforeach;
            ?>

        </tbody>
</table>