<?php
  include('./scripts/profile_info.php');
  include('./scripts/session.php');
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Depot manager - Usuarios</title>

    <link rel="stylesheet" href="./css/base.css" type="text/css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.4.2/vue.min.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Depot Manager</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <!-- Perfil -->
          <li class="nav-item">
            <a class="nav-link" href="./profile.php">Perfil</a>
          </li>
          <!-- Usuario -->
          <?php
            if($rol == 1){
              echo '<li class="nav-item">';
              echo '<a class="nav-link" href="./users.php">Usuarios</a>';
              echo '</li>';
            }
          ?>
          <!-- Inventario -->
          <?php
            if($rol == 1){
              echo '<li class="nav-item">';
              echo ' <a class="nav-link" href="./inventario.php">Inventario</a>';
              echo '</li>';
            }
          ?>
          <!-- Almacen -->
          <?php
            if($rol == 1 || $rol == 2){
              echo '<li class="nav-item">';
              echo '<a class="nav-link" href="almacen.php">Alamacen</a>';
              echo '</li>';
            }
          ?>
          <!-- Registro -->
          <?php
            if($rol == 1 || $rol == 2){
              echo '<li class="nav-item active">';
              echo '<a class="nav-link" href="#">Registro</a>';
              echo '</li>';
            }
          ?>
          <!-- Vender -->
          <?php
            if($rol == 3){
              echo '<li class="nav-item">';
              echo '<a class="nav-link" href="./sell.php">Vender</a>';
              echo '</li>';
            }
          ?>
          <li class="nav-item">
            <a class="nav-link" href="./scripts/logout.php">Cerrar session</a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Cantidad -->
    <div class="contenedor espacio">
    </div>
  </body>
  <footer class="page-footer font-small blue pt-4">
    <div class="footer-copyright text-center py-3">Depot manager © 2019</div>
  </footer>
</html>