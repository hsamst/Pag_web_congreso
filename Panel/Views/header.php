<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <title>Congreso</title>

  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-light sticky-top " style="background-color: #e3f2fd;">

        <a class="navbar-brand" href="Index.html">
          <img src="../image/logo2.png" width="150" height="70" alt="LogoRCH">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
          aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <div class="navbar-nav text-center ml-auto mr-auto">
          <a class="nav-link active" href="../Index.php">Home Principal</a>
            <a class="nav-link active" href="CtrlInicioAdm.php">Home </a>
             <a class="nav-link active" href="CtrlInscripcion.php">Lista de eventos </a>
             <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Catalogos
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="CtrlPonente.php">Ponentes</a>
                  <a class="dropdown-item" href="CtrlConferencia.php">Conferencias</a>
             </li>
             <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Sistema
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="CtrlUsuarios.php">Usuarios</a>
                  <a class="dropdown-item" href="CtrlRol.php">Roles</a>
             </li>

             <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle bi-person" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <label> <?php echo $_SESSION['correo']; ?> </label> <br />
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="CtrlLogin.php?accion=logOut">Log Out</a>
                  </div>
                </li>
          
              </div>

          <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
          </form>

        </div>

      </nav>

      