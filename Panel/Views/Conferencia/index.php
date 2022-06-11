<h1>Conferencias</h1>
<a href="CtrlConferencia.php?accion=new" class="btn btn-primary"> Añadir nueva Conferencia</a>
<table class="table" style="background-color: #e3f2fd;">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Imagen</th>
            <th scope="col">Conferencia</th>
            <th scope="col">Sinopsis</th>
            <th scope="col">Ponente</th>
            </tr>
        </thead>
        <tbody>

            <?php
                foreach ($datos as $key => $dato):
            ?>
            <tr>
                <th scope="row"><?php echo $dato['id_conferencia']; ?></th>
                <td>
                    <div class="text-center">
                        <img src="../image/ImgConferencias/<?php echo $dato['imagen']; ?>" class="img-circle" width="200" style="border-radius:300px"  alt="img_persona">
                    </div>
                </td>
                <td><?php echo $dato['titulo']; ?></td>
                <td><?php echo $dato['sinopsis']; ?></td>
                <td><?php echo $dato['nombre']; ?></td>
                <td>  
                    <lu>
                    <i class="btn btn-outline-success bi-pencil"><a href="CtrlConferencia.php?accion=modify&id_conferencia=<?php echo $dato['id_conferencia']; ?>">Modificar</a></i>
                    <i class="btn btn-outline-danger bi bi-trash"><a href="CtrlConferencia.php?accion=delete&id_conferencia=<?php echo $dato['id_conferencia']; ?>">Eliminar</a></i>
                    </lu>
                </td>
            </tr>

            <?php
                endforeach;
            ?>

        </tbody>
</table>


  </body>
</html>


