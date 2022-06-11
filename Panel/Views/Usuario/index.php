<h1> ¡Usuarios! </h1>
<a href="CtrlUsuarios.php?accion=new" class="btn btn-primary"> Añadir nuevo usuario</a>
<table class="table" style="background-color: #e3f2fd;">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Correo</th>
            <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>

            <?php
                foreach ($datos as $key => $dato):
            ?>

            <tr>
            <td><?php echo $dato['id_usuario'] ?></td>
            <td><?php echo $dato['correo'] ?></td>

                <td>  
                    <lu>
                    <i class="btn btn-outline-success bi-pencil"><a href="CtrlUsuarios.php?accion=modify&id_usuario=<?php echo $dato['id_usuario']; ?>">Modificar</a></i>
                    <i class="btn btn-outline-danger bi bi-trash"><a href="CtrlUsuarios.php?accion=delete&id_usuario=<?php echo $dato['id_usuario']; ?>">Eliminar</a></i>
                    </lu>
                </td>

            </tr>

            <?php
                endforeach;
            ?>

        </tbody>
</table>