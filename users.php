<?php
  $error = '';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Depot manager - Usuarios</title>

    <link href="./css/base.css" rel="stylesheet" type="text/css" />
  </head>
  <body class="bg">
    <div class="contenedor">
      <!-- Banner -->
      <div class="borde banner">
        <!--<img class="logo" src="./img/joy_emoji.jpg"/>-->
        <h2 class="banner_tutulo">Adminstrador</h2>
      </div>
      <!-- Menu -->
      <div class="menusup topSpace">
        <a href="./profile.php">Perfil</a>
        <a href="#" class="active">Administrar</a>
      </div>
      <!-- Contenido -->
      <div class="contet_page topSpace">
        <form action="" method="post">
          <label>Usuario :</label>
          <input id="name" name="username" placeholder="username" type="text">
          <label>Contraseña :</label>
          <input id="password" name="password" placeholder="**********" type="password"><br><br>
          <input name="submit" type="submit" value=" Crear ">
          <span><?php echo $error; ?></span>
        </form>
      </div>
      <!-- Footer -->
      <div class="borde topSpace">
        <p class="footer_text">Depot manager © 2019</p>
      </div>
    </div>
  </body>
</html>