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
          <li class="nav-item">
            <a class="nav-link" href="./profile.php">Adminstrador</a>
          </li>
          <?php
            if($rol == 1){
              echo '<li class="nav-item">';
              echo '<a class="nav-link" href="./users.php">Usuarios</a>';
              echo '</li>';
            }
          ?>
          <li class="nav-item">
            <a class="nav-link" href="inventario.php">Inventario</a>
          </li>
          <?php
            if($rol == 1 || $rol == 2){
              echo '<li class="nav-item active">';
              echo '<a class="nav-link" href="#">Registros</a>';
              echo '</li>';
            }
          ?>
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
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="venta-tab" data-toggle="tab" href="#venta" role="tab" aria-controls="products" aria-selected="true">Venta</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="almacen-tab" data-toggle="tab" href="#almacen" role="tab" aria-controls="almacen" aria-selected="false">Alamacen</a>
      </li>
    </ul>
    <!-- Contenido -->
    <div class="tab-content">
      <!-- Venta -->
      <div class="tab-pane active" id="venta" role="tabpanel" aria-labelledby="venta-tab">
        <div class="contenedor espacio">
          
        </div>
      </div>

      <!-- Almacen -->
      <div class="tab-pane" id="almacen" role="tabpanel" aria-labelledby="almacen-tab">
        <div class="contenedor espacio">
          <!-- Barra de busqueda -->
          <form actions="" method="get">
            <div class="form-row">
              <input id="busqueda" name="busqueda" class="form-control col-md-10" type="text">
              <input class="btn btn-primary col-md-2" name="btn_buscar" type="submit" value="Buscar">
            </div>
            <!-- Tabla de usuarios form -->
            <?php
              if(isset($_GET['busqueda'])){
                echo "<span>Resultados de: ".$_GET['busqueda']."</span>";
              }
            ?>
          </form>

          <!-- Tabla de productos -->
          <?php include('./scripts/registro_almacen.php'); ?>
          <table class="table espacio">  
            <thead class="thead-dark">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Empleado</th>
                <th scope="col">Producto</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Fecha</th>
                <th scope="col">Accion</th>
              </tr>
            <thead>
            <tbody>
              <?php  
                while ($row = mysqli_fetch_array($rs_result)) {
                  echo "<tr>"; 
                  //id
                  echo "<th scope='row'>".$row['id']."</th>";
                  //username
                  echo "<th>".$row['empleado']."</th>";
                  //productname
                  echo "<th>".$row['producto']."</th>";
                  //cantidad
                  echo "<th>".$row['cantidad']."</th>";
                  //fecha
                  echo "<th>".$row['fecha']."</th>";
                  //accion
                  echo "<th>".$row['accion']."</th>";
                  echo "</tr>"; 
                }; 
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
  <footer class="page-footer font-small blue pt-4">
    <div class="footer-copyright text-center py-3">Depot manager © 2019</div>
  </footer>
</html>