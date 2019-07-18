<?php
  include('./scripts/profile_info.php');
  include('./scripts/create.php');
  include('./scripts/session.php');
  include('./scripts/editar_usuario.php');
?>
<!DOCTYPE html>
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
              echo '<li class="nav-item active">';
              echo '<a class="nav-link" href="#">Usuarios</a>';
              echo '</li>';
            }
          ?>
          <!-- Inventario -->
          <?php
            if($rol == 1){
              echo '<li class="nav-item">';
              echo ' <a class="nav-link" href="inventario.php">Inventario</a>';
              echo '</li>';
            }
          ?>
          <!-- Almacen -->
          <?php
            if($rol == 1 || $rol == 2){
              echo '<li class="nav-item">';
              echo '<a class="nav-link" href="./almacen.php">Almacen</a>';
              echo '</li>';
            }
          ?>
          <!-- Registro -->
          <?php
            if($rol == 1 || $rol == 2){
              echo '<li class="nav-item">';
              echo '<a class="nav-link" href="./registro.php">Registro</a>';
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
      <?php include('./scripts/users_table.php'); ?>
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
              //nombre
              echo "<td>".$row['name']."</td>";
              //email
              echo "<td>".$row['email']."</td>";
              //role
              if($row['role'] == 1){
                echo "<td>Administrador</td>"; 
              } else if($row['role'] == 2){
                echo "<td>Sub administrador</td>"; 
              } else if($row['role'] == 3){
                echo "<td>Empleado</td>"; 
              }
              //activo
              if($row['active'] == 1){
                echo "<td>Activo</td>"; 
              } else {
                echo "<td>Desactivado</td>"; 
              }
              //role
              if($row['role'] != 1){
                $parametros = $row['id'].','.'\''.$row['username'].'\''.','.'\''.$row['password'].'\''.','.'\''.$row['name'].'\''.','.'\''.$row['email'].'\''.','.$row['role'].','.$row['active'];
                echo '<td><input class="btn btn-primary" type="button" value="Editar" onclick="editarUsusario('.$parametros.')"></td>';
              } else {
                echo "<td></td>"; 
              }
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

      <!-- Modal de editar -->
      <div class="modal fade" id="miModal" role="dialog">
        <div class="modal-dialog modal-lg">
          <!-- Contenido del modal -->
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Editar usuario</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="" method="post">
              <div class="modal-body">
                <div class="form-group">
                  <input id="modal_id" name="modal_id" class="form-control" type="text" style="display: none;">
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="modal_username">Usuario:</label>
                    <input id="modal_username" name="modal_username" class="form-control" type="text">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="modal_password">Contraseña:</label>
                    <input id="modal_password" name="modal_password" class="form-control" type="password">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="modal_name">Nombre:</label>
                    <input id="modal_name" name="modal_name" class="form-control" type="text">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="modal_email">Email:</label>
                    <input id="modal_email" name="modal_email" class="form-control" type="email">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="modal_rol">Rol:</label>
                    <select id="modal_rol" name="modal_rol" class="form-control">
                      <option value="2">Sub administrador</option>
                      <option value="3">Empleado</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="modal_active">Activo:</label>
                    <select id="modal_active" name="modal_active" class="form-control">
                      <option value="1">Si</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <input class="btn btn-primary" name="save_edit" id="save_edit" type="submit" value="Guardar">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script>
      function editarUsusario(id, username, password, name, email, role, active) {
        console.log(id, username, password, name, email, role, active);
        $("#miModal").modal("show");
        document.getElementById("modal_username").value = ""+username;
        document.getElementById("modal_password").value = ""+password;
        document.getElementById("modal_name").value = ""+name;
        document.getElementById("modal_email").value = ""+email;
        $("#modal_rol").val(""+role);
        $("#modal_active").val(""+active);
        $("#modal_id").val(id);
      };
    </script>
  </body>
  <footer class="page-footer font-small blue pt-4">
    <div class="footer-copyright text-center py-3">Depot manager © 2019</div>
  </footer>
</html>