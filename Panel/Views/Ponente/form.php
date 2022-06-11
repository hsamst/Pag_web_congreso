  <h1><?php echo(isset($id_ponente))? "Modificar ": "Nevo ";?>Ponente</h1>

  <?php 
    if(isset($id_ponente)){
      ?>
      <div class="text-center">
        <img src="../../../image/ImgPonentes/<?php echo $datos['fotografia']; ?>" class="img-circle" width="500" style="border-radius:300px"  alt="imagen_ponente">
      </div>
      <?php
    }
  ?>

  <form method="POST" action="CtrlPonente.php?accion=<?php echo(isset($id_ponente))? "update&id_ponente=".$id_ponente: "add"; ?>" enctype="multipart/form-data">
          <div>
              <label>Nombre</label>
              <input type="text" name="nombre" value="<?php echo(isset($id_ponente)) ? $datos['nombre']:"";?>" class="form-control" 
                  required
                  placeholder="AP-AM-Nombre(s)"
                  autofocus
                  autocomplete />
          </div>
          
          <div>
              <label for="nombre">Primer Apellido</label>
              <input type="text" name="primer_apellido" value="<?php echo(isset($id_ponente)) ? $datos['primer_apellido']:"";?>" class="form-control"
                  placeholder="AP-AM-Nombre(s)"
                  autofocus
                  autocomplete />
          </div>

          <div>
              <label for="nombre">Segundo Apellido</label>
              <input type="text" name="segundo_apellido" value="<?php echo(isset($id_ponente)) ? $datos['segundo_apellido']:"";?>" class="form-control"
                  placeholder="AP-AM-Nombre(s)"
                  autofocus
                  autocomplete />
          </div>

          <div>
            <label for="nombre">Tratamiento</label>
            <input type="text" name="tratamiento" value="<?php echo(isset($id_ponente)) ? $datos['tratamiento']:"";?>" class="form-control"
                placeholder="AP-AM-Nombre(s)"
                autofocus
                autocomplete />
          </div>

          <div>
            <label for="email">E-mail</label>
            <input type="email" name="correo" value="<?php echo(isset($id_ponente)) ? $datos['correo']:"";?>" class="form-control"
              placeholder="ejemplo@email.com" />
          </div>

          <div>
            <label>Resumen*</label>
            <input type=textarea name="resumen" value="<?php echo(isset($id_ponente)) ? $datos['resumen']:"";?>" id="comentarios" rows="10" class="form-control" />
            <br />
          </div>

          <div class="custom-file">
              <input type="file" class="custom-file-input" id="customFile"name="fotografia">
              <label class="custom-file-label" for="customFile">Selecciona una foto</label>
          </div>
          <br />

          <div class="input-group is-invalid"> 
            <label class="input-group-text" for="validatedInputGroupSelect">Options</label>
            <select class="custom-select" id="validatedInputGroupSelect" name="id_tipo" required >
                <option selected>Choose...</option>
                <?php foreach ($datostipo as $key => $value): 
                  $selected = "";
                    if($value['id_tipo'] == $datos['id_tipo']):
                      $selected = "selected";
                    endif;
                ?>
                  <option value="<?php echo $value['id_tipo'];?>" <?php echo $selected; ?>> <?php echo $value['tipo']?> </option>
                <?php endforeach; ?>
             </select>
          </div>
          <br />
      
          <input class="btn btn-success" type="submit" value="Guardar" />
          <a href="CtrlPonente.php" class="btn btn-danger">Cancelar</a>

</form>