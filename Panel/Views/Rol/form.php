<h1><?php echo(isset($id_rol))? "Modificar ": "Nevo ";?>Rol</h1>

  <form method="POST" action="CtrlRol.php?accion=<?php echo(isset($id_rol))? "update&id_rol=".$id_rol: "add"; ?>" enctype="multipart/form-data">
          <div>
              <label>rol</label>
              <input type="text" name="rol" value="<?php echo(isset($id_rol)) ? $datos['rol']:"";?>" class="form-control" 
                  required
                  autofocus
                  autocomplete />
          </div>

          <br />
          <br />
      
          <input class="btn btn-success" type="submit" value="Guardar" />
          <a href="CtrlRol.php" class="btn btn-danger">Cancelar</a>

</form>