<h1><?php echo(isset($id_usuario))? "Modificar ": "Nevo ";?>Usuario</h1>

  <form method="POST" action="CtrlUsuarios.php?accion=<?php echo(isset($id_usuario))? "update&id_usuario=".$id_usuario: "add"; ?>" enctype="multipart/form-data">
          <div>
              <label>Correo</label>
              <input type="text" name="correo" value="<?php echo(isset($id_usuario)) ? $datos['correo']:"";?>" class="form-control" 
                  required
                  autofocus
                  autocomplete />
          </div>
          
          <div>
              <label >Contraseña</label>
              <input type="password" name="contrasena"  class="form-control"
                  autofocus
                  autocomplete />
          </div>
           
            <?php  if(isset($id_usuario)): ?>
                    <h3>Roles del Usuario:</h3>

                    <?php 
                        foreach($datos_roles as $key => $values):
                            $checked = "";
                            if(in_array($values['id_rol'], $datos_usuario_rol)){
                                $checked = "checked";
                            }
                    ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<?php echo($values['id_rol']);?>" id="flexCheckDefault" name="roles[]" <?php echo $checked; ?>>
                            <label class="form-check-label" for="flexCheckDefault">
                                <?php echo ($values['rol'])?>
                            </label>
                        </div>
                    <?php 
                    //echo "Aguja ".$values['id_rol'];
                    //echo("<pre>");
                    //print_r($datos_usuario_rol);
                    //echo("<pre>");
                        endforeach;
                    ?>

            <?php  endif; ?>

          <br />
          <br />

          <input class="btn btn-success" type="submit" value="Guardar" />
          <a href="CtrlUusarios.php" class="btn btn-danger">Cancelar</a>

</form>