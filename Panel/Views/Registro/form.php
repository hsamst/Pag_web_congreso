<form method="post" action="CtrlRegistro.php?accion=register">
  <div class="form-group">
    <label>Nombre</label>
    <input type="tetx" class="form-control" name="nombre">
  </div>
  <div class="form-group">
    <label>Apellido Paterno</label>
    <input type="tetx" class="form-control" name="apaterno">
  </div>
  <div class="form-group">
    <label>Apellido Materno</label>
    <input type="tetx" class="form-control" name="amaterno">
  </div>
  <div class="form-group">
    <label>Correo Electronico</label>
    <input type="tetx" class="form-control" name="correo">
  </div>
  <div class="form-group">
    <label for = "exmapleInputPasswordl">Password</label>
    <input type="password" class="form-control" id = "exmapleInputPasswordl" name="contrasena">
  </div>
  <input type="submit" class="btn btn-primary" name ="enviar" value="Registrar"></input>
</form>