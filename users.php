<?php
  include('./scripts/profile_info.php');
  include('./scripts/create.php');
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
        <?php if($rol == 1){
          echo '<a href="./users.php" class="active">Usuarios</a>';
        } ?>
        <a href="#">Productos</a>
        <a href="./scripts/logout.php">Cerrar session</a>
      </div>
      <!-- Contenido -->
      <div class="contet_page topSpace">
        <!--formulario de usuarios-->
        <form action="" method="post">
          <label>Usuario :</label>
          <input id="username" name="username" placeholder="username" type="text">
          <label>Contraseña :</label>
          <input id="password" name="password" placeholder="**********" type="password">
          <label>Nombre :</label>
          <input id="name" name="name" placeholder="nombre" type="text">
          <label>Email :</label>
          <input id="email" name="email" placeholder="correo" type="text">
          <label>Rol :</label>
          <select id="rol" name="rol">
            <option value="2">Sub administrador</option>
            <option value="3">Empleado</option>
          </select> 
          <br><br>
          
          <!--botton-->
          <input name="guardar" id="guardar" type="submit" value=" Crear ">
          <span><?php echo $error_add; ?></span>
        </form>
        <!--tabla de usuarios form-->
        <?php include('./scripts/users_table.php'); ?>
        <table>  
          <thead>
            <tr>
              <th>Usuario</th>  
              <th>Nombre</th>
            </tr>
          <thead>
          <tbody>
            <?php  
              while ($row = mysqli_fetch_array($rs_result)) {
                echo "<tr>"; 
                echo "<td>".$row['username']."</td>"; 
                echo "<td>".$row['name']."</td>";
                echo "</tr>"; 
              }; 
            ?>
          </tbody>  
        </table>
        <?php  
          $sql = "SELECT COUNT(id) FROM users";  
          $rs_result = mysqli_query($conexion, $sql);  
          $row = mysqli_fetch_array($rs_result);  
          $total_records = $row[0];  
          $total_pages = ceil($total_records / $limit);  
          $pagLink = "<div class='pagination'>";  
          for ($i=1; $i<=$total_pages; $i++) {  
            $pagLink .= "<a href='./users.php?page=".$i."'>".$i."</a>";  
          };
          echo $pagLink . "</div>";  
        ?>
      </div>
      <!-- Footer -->
      <div class="borde topSpace">
        <p class="footer_text">Depot manager © 2019</p>
      </div>
    </div>
  </body>
</html>