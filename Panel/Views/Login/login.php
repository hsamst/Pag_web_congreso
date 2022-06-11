<form method="POST" action="CtrlLogin.php?accion=login">
  <h1>Ingresar al Sistema</h1>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Correo Electronico</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name ="correo">
 </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name ="contrasena">
  </div>
  <input type="submit" class="btn btn-primary" name ="enviar" value ="Ingresar"></input> 
  <br />
  <a href="CtrlLogin.php?accion=recovery">¿Olvido su contraseña?</a> 
  <br />
  <br />
</form>