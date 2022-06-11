<form method="POST" action="CtrlLogin.php?accion=update">
  <h1>Restablecer contraseña</h1>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Nueva Contraseña</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name ="contrasena">
  </div>
  <input type="hidden"  name ="correo" value = "<?php echo $datos['correo']?>">
  <input type="hidden"  name ="token" value = "<?php echo $datos['token']?>">

  <input type="submit" class="btn btn-primary" name ="enviar" value ="Restablecer Contraseña"></input>
</form>