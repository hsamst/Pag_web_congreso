<h1>Ponentes</h1>
<a href="CtrlPonente.php?accion=new" class="btn btn-primary"> Añadir nuevo ponente</a>
<table class="table" style="background-color: #e3f2fd;">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Fotografia</th>
            <th scope="col">Nombre</th>
            <th scope="col">Tipo</th>
            <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>

            <?php
                foreach ($datos as $key => $dato):
            ?>

            <tr>
                <th scope="row"><?php echo $dato['id_ponente']; ?></th>
                <td>
                    <div class="text-center">
                        <img src="../image/ImgPonentes/<?php echo $dato['fotografia']; ?>" class="img-circle" width="200" style="border-radius:300px"  alt="img_persona">
                    </div>
                </td>
                <td><?php echo $dato['nombre']; ?></td>
                <td><?php echo $dato['tipo']; ?></td>
                <td>  
                    <lu>
                    <i class="btn btn-outline-success bi-pencil"><a href="CtrlPonente.php?accion=modify&id_ponente=<?php echo $dato['id_ponente']; ?>">   Modificar</a></i>
                    <i class="btn btn-outline-danger bi bi-trash"><a href="CtrlPonente.php?accion=delete&id_ponente=<?php echo $dato['id_ponente']; ?>">   Eliminar</a></i>
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


