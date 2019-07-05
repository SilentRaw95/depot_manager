<?php
  include('./scripts/profile_info.php');
  include('./scripts/session.php');
  include('./scripts/create_category.php');
  include('./scripts/editar_categoria.php');
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
            <a class="nav-link" href="#">Adminstrador</a>
          </li>
          <?php
            if($rol == 1){
              echo '<li class="nav-item">';
              echo '<a class="nav-link" href="./users.php">Usuarios</a>';
              echo '</li>';
            }
          ?>
          <li class="nav-item active">
            <a class="nav-link" href="#">Inventario</a>
          </li>
          <?php
            if($rol == 1 || $rol == 2){
              echo '<li class="nav-item">';
              echo '<a class="nav-link" href="./registers.php">Registros</a>';
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
        <a class="nav-link active" id="products-tab" data-toggle="tab" href="#products" role="tab" aria-controls="products" aria-selected="true">Productos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="categories-tab" data-toggle="tab" href="#categories" role="tab" aria-controls="categories" aria-selected="false">Categorias</a>
      </li>
    </ul>
    <!-- Contenido -->
    <div class="tab-content">
      <!-- Products -->
      <div class="tab-pane active" id="products" role="tabpanel" aria-labelledby="products-tab">

      </div>
      <!-- Categories -->
      <div class="tab-pane" id="categories" role="tabpanel" aria-labelledby="categories-tab">
        <div class="contenedor espacio">
          <!--formulario-->
          <form action="" method="post">
            <div class="form-row">
              <input id="create_category" name="create_category" class="form-control col-md-8" placeholder="Categoria" type="text">
              <input class="btn btn-primary col-md-4" name="crear_categoria" type="submit" value="Crear">
            </div>
          </form>

          <?php include('./scripts/category_table.php'); ?>
          <table class="table espacio">  
            <thead class="thead-dark">
              <tr>
                <th scope="col">Categoria</th>
                <th scope="col"></th>
              </tr>
            <thead>
            <tbody>
              <?php  
                while ($row = mysqli_fetch_array($rs_result)) {
                  echo "<tr>";
                  echo "<th scope='row'>".$row['name']."</th>";
                  $parametros = $row['id'].','.'\''.$row['name'].'\'';
                  echo '<td><input class="btn btn-primary" type="button" value="Editar" onclick="editarCategoria('.$parametros.')"></td>';
                  echo "</tr>"; 
                }; 
              ?>
            </tbody>
          </table>
        </div>
        <script>
          function editarCategoria(id, category) {
            $("#modalCategory").modal("show");
            $("#modal_id").val(id);
            document.getElementById("modal_categoria").value = ""+category;
          };
        </script>
      </div>

      <!-- Modal de editar -->
      <div class="modal fade" id="modalCategory" role="dialog">
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
                <div class="form-group">
                  <label for="modal_categoria">Categoria:</label>
                  <input id="modal_categoria" name="modal_categoria" class="form-control" type="text">
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
  </body>
  <footer class="page-footer font-small blue pt-4">
    <div class="footer-copyright text-center py-3">Depot manager © 2019</div>
  </footer>
</html>