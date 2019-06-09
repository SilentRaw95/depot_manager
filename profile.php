<?php
  include('./scripts/profile_info.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Depot manager - Perfil</title>

    <link href="./css/base.css" rel="stylesheet" type="text/css" />
  </head>
  <body class="bg">
    <div class="contenedor">
      <!-- Banner -->
      <div class="borde banner">
        <!--<img class="logo" src="./img/joy_emoji.jpg"/>-->
        <h2 class="banner_tutulo">Perfil</h2>
      </div>
      <!-- Menu -->
      <div class="menusup topSpace">
        <a href="#" class="active">Perfil</a>
        <?php if($rol == 1){
          echo '<a href="./users.php">Usuarios</a>';
        } ?>
        <a href="#">Productos</a>
        <a href="./scripts/logout.php">Cerrar session</a>
      </div>
      <!-- Contenido -->
      <div class="contet_page topSpace">
        <p>Hola: <?php echo $nombre; ?></p>
      </div>
      <!-- Footer -->
      <div class="borde topSpace">
        <p class="footer_text">Depot manager © 2019</p>
      </div>
    </div>
  </body>
</html>