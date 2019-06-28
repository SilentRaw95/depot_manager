<?php
  include('./scripts/profile_info.php');
  include('./scripts/create.php');
  include('./scripts/session.php');
  include('./scripts/users_table.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Depot manager - Usuarios</title>

    <link rel="stylesheet" href="./css/base.css" type="text/css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Depot Manager</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="./profile.php">Adminstrador</a>
          </li>
          <?php
            if($rol == 1){
              echo '<li class="nav-item active">';
              echo '<a class="nav-link" href="./users.php">Usuarios</a>';
              echo '</li>';
            }
          ?>
          <li class="nav-item">
            <a class="nav-link" href="#">Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./scripts/logout.php">Cerrar session</a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Contenido -->
    <div class="contenedor espacio">
      <!-- Formulario de usuarios -->
      <form action="" method="post">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="user">Usuario:</label>
            <input id="username" name="username" class="form-control" type="text">
          </div>
          <div class="form-group col-md-6">
            <label for="password">Contraseña:</label>
            <input id="password" name="password" class="form-control" type="password">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="name">Nombre:</label>
            <input id="name" name="name" class="form-control" type="text">
          </div>
          <div class="form-group col-md-6">
            <label for="email">Email:</label>
            <input id="email" name="email" class="form-control" type="email">
          </div>
        </div>
        <div class="form-group">
          <label>Rol:</label>
          <select id="rol" name="rol" class="form-control">
            <option value="2">Sub administrador</option>
            <option value="3">Empleado</option>
          </select>
        </div>
        
        <!-- Boton -->
        <div class="form-group">
          <input class="btn btn-primary" name="guardar" id="guardar" type="submit" value="Crear">
          <span><?php echo $error_add; ?></span>
        </div>
      </form>

      <!-- Barra de busqueda -->
      <form actions="" method="get">
        <div class="form-row">
          <input id="busqueda" name="busqueda" class="form-control col-md-4" type="text">
          <input class="btn btn-primary col-md-2" name="btn_buscar" type="submit" value="Buscar">
        </div>
        <!-- Tabla de usuarios form -->
        <?php
          if(isset($_GET['busqueda'])){
            echo "<span>Resultados de: ".$_GET['busqueda']."</span>";
          }
        ?>
      </form>

      <!--Tabla de usuarios-->
      <table class="table espacio">  
        <thead class="thead-dark">
          <tr>
            <th scope="col">Usuario</th>  
            <th scope="col">Nombre</th>
            <th scope="col">Email</th>
            <th scope="col">Rol</th>
            <th scope="col">Estado</th>
            <th scope="col"></th>
          </tr>
        <thead>
        <tbody>
          <?php  
            while ($row = mysqli_fetch_array($rs_result)) {
              echo "<tr>"; 
              echo "<th scope='row'>".$row['username']."</th>";
              echo "<td>".$row['name']."</td>";
              echo "<td>".$row['email']."</td>";
              if($row['role'] == 1){
                echo "<td>Administrador</td>"; 
              } else if($row['role'] == 2){
                echo "<td>Sub administrador</td>"; 
              } else if($row['role'] == 3){
                echo "<td>Empleado</td>"; 
              }
              if($row['active'] == 1){
                echo "<td>Activo</td>"; 
              } else {
                echo "<td>Desactivado</td>"; 
              }
              echo '<td><input class="btn btn-primary" name="guardar" type="submit" value=" Editar"></td>';
              echo "</tr>"; 
            }; 
          ?>
        </tbody>
      </table>
      <?php
        $rs_result = mysqli_query($conexion, $sql_temp);  
        $row = mysqli_fetch_array($rs_result);  
        $total_records = $row[0];  
        $total_pages = ceil($total_records / $limit);  
        $pagLink = "<div class='pagination'>";  
        for($i = 0; $i < $total_pages; $i++) {
          $num = $i + 1;
          if(isset($_GET['busqueda'])){
            $pagLink .= "<a href='./users.php?page=".$num."+&busqueda=".$_GET['busqueda']."'>".$num."</a>";  
          } else {
            $pagLink .= "<a href='./users.php?page=".$num."'>".$num."</a>";  
          }
        };
        echo $pagLink . "</div>";  
      ?>
    </div>
  </body>
  <footer class="page-footer font-small blue pt-4">
    <div class="footer-copyright text-center py-3">Depot manager © 2019</div>
  </footer>
</html>