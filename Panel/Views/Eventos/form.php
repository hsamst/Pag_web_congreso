<h3>Holi</h3>
<h1><?php echo(isset($id_evento))? "Modificar ": "Nevo ";?>Evento</h1>

  <form method="POST" action="CtrlInscripcion.php?accion=<?php echo(isset($id_evento))? "update&id_evento=".$id_evento: "add"; ?>" enctype="multipart/form-data">
          <div>
              <label>Nombre Evento</label>
              <input type="text" name="evento" value="<?php echo(isset($id_evento)) ? $datos['evento']:"";?>" class="form-control" 
                  required
                  autofocus
                  autocomplete />
          </div>
          
          <div>
              <label >Fecha de Inicio</label>
              <input type="date" name="fecha_inicio" value="<?php echo(isset($id_evento)) ? $datos['fecha_inicio']:"";?>" class="form-control"
                  autofocus
                  autocomplete />
          </div>

          <div>
              <label >Fecha de Fin</label>
              <input type="date" name="fecha_fin" value="<?php echo(isset($id_evento)) ? $datos['fecha_fin']:"";?>" class="form-control"
                  autofocus
                  autocomplete />
          </div>
          

          <br />
          <br />
      
          <input class="btn btn-success" type="submit" value="Guardar" />
          <a href="CtrlInscripcion.php" class="btn btn-danger">Cancelar</a>

</form>