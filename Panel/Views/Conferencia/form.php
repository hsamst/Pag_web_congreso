<h1><?php echo(isset($id_conferencia))? "Modificar ": "Nevo ";?>Conferencia</h1>

  <?php 
    if(isset($id_conferencia)){
      ?>
      <div class="text-center">
        <img src="../../../image/ImgConferencistas/<?php echo $datos['imagen']; ?>" class="img-circle" width="500" style="border-radius:300px"  alt="img_persona">
      </div>
      <?php
    }
  ?>

  <form method="POST" action="CtrlConferencia.php?accion=<?php echo(isset($id_conferencia))? "update&id_conferencia=".$id_conferencia: "add"; ?>" enctype="multipart/form-data">
          <div>
              <label>Titulo</label>
              <input type="text" name="titulo" value="<?php echo(isset($id_conferencia)) ? $datos['titulo']:"";?>" class="form-control" 
                  required
                  autofocus
                  autocomplete />
          </div>
          
          <div>
              <label >sinopsis</label>
              <input type="text" name="sinopsis" value="<?php echo(isset($id_conferencia)) ? $datos['sinopsis']:"";?>" class="form-control"
                  autofocus
                  autocomplete />
          </div>

          <div class="custom-file">
              <input type="file" class="custom-file-input" id="customFile"name="imagen">
              <label class="custom-file-label" for="customFile">Selecciona una foto</label>
          </div>

          <div class="input-group is-invalid"> 
            <label class="input-group-text" for="validatedInputGroupSelect">Ponente</label>
            <select class="custom-select" id="validatedInputGroupSelect" name="id_ponente" required >
                <option selected>Choose...</option>
                <?php foreach ($datostipo as $key => $value): 
                  $selected = "";
                    if($value['id_ponente'] == $datos['id_ponente']):
                      $selected = "selected";
                    endif;
                ?>
                  <option value="<?php echo $value['id_ponente'];?>" <?php echo $selected; ?>> <?php echo $value['nombre']?> </option>
                <?php endforeach; ?>
             </select>
          </div>
          

          <br />
          <br />
      
          <input class="btn btn-success" type="submit" value="Guardar" />
          <a href="CtrlConferencia.php" class="btn btn-danger">Cancelar</a>

</form>