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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
              echo '<li class="nav-item active">';
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
      <?php include('./scripts/products_table.php'); ?>
      <table class="table espacio">  
        <thead class="thead-dark">
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Categoria</th>
            <th scope="col">Precio</th>
            <th scope="col">Stock</th>
            <th scope="col">Bodega</th>
            <th scope="col"></th>
            <th scope="col">
              <button class="btn btn-primary" id="cart" onclick="verCarrito()">
                <i class="fa fa-shopping-cart" id="icon_cart"> 0</i>
              </button>
            </th>
          </tr>
        <thead>
        <tbody>
          <?php  
            while ($row = mysqli_fetch_array($rs_resultP)) {
              echo "<tr>";
              //name
              echo "<th>".$row['name']."</th>";
              //categoria
              echo "<th>".$row['categoria_name']."</th>";
              //precio
              echo "<th>".$row['price']."</th>";
              //stock
              echo "<th>".$row['stock']."</th>";
              //bodega
              echo "<th>".$row['cell']."</th>";
              //cantidad a añadir
              echo '<td><input id="field_'.$row['id'].'" class="form-control custominput" type="number" min="1"></td>';
              //boton añadir
              $parametros = $row['id'].','.$row['price'].','.$row['stock'].','.'\''.$row['name'].'\'';
              echo '<td>
                <button class="btn btn-primary" onclick="addProduct('.$parametros.')">+</button>
              </td>';
              //fin columna
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
            $pagLink .= "<a href='./sell.php?page=".$num."+&busqueda=".$_GET['busqueda']."'>".$num."</a>";  
          } else {
            $pagLink .= "<a href='./sell.php?page=".$num."'>".$num."</a>";  
          }
        };
        echo $pagLink . "</div>";  
      ?>
      <script>
        // carrito
        var carrito = []
        //storage 
        var storage = JSON.parse(localStorage.getItem("carrito"))
        console.log(storage)

        if (storage != null){
          var carrito = storage
          var divText = document.getElementById('icon_cart');
          divText.textContent = " "+carrito.length;
        }
        
        function doSomething() {
          // Store
          localStorage.setItem("carrito", null);
        }
        
        //anadir algo al carrito
        function addProduct(id, price, stock, name){
          var found = false;
          var field_id = "field_"+id;
          var cant = document.getElementById(field_id).value;

          for(var i = 0; i < carrito.length; i++){
            if(carrito[i].id_prod == id){
              found = true;
            }
          }
          
          if(cant <= stock && found == false){
            var temp = {
              id_prod: id,
              cantidad: cant,
              sub_total: cant * price,
              price: price,
              nombre: name,
              stock: stock
            }
            carrito.push(temp)

            var divText = document.getElementById('icon_cart');
            divText.textContent = " "+carrito.length;

            // Store
            localStorage.setItem("carrito", JSON.stringify(carrito));
          } else if(found == false) {
            alert("se pasa el stock")
          } else {
            alert("ya tienes el producto en el carrito")
          }
        }

        function verCarrito(){
          $("#miModal").modal("show");
          printTable();
        }

        function deleteFn(index) {
          carrito.splice(index, 1);
          localStorage.setItem("carrito", JSON.stringify(carrito));
          printTable();
        }

        function actualizarCantidad(index){
          var field = "cant_"+index;
          var field_sub = "sub_"+index;
          var newCant = document.getElementById(field).value;

          if(newCant <= carrito[index].stock){
            carrito[index].cantidad = newCant;
            carrito[index].sub_total = newCant * carrito[index].price;
            document.getElementById(field_sub).value = newCant * carrito[index].price;

            //actualizar el total
            var total = 0;
            for(var i = 0; i < carrito.length; i++){
              total = total + carrito[index].sub_total;
            }
            localStorage.setItem("carrito", JSON.stringify(carrito));
            document.getElementById("total").value = ""+total;
          } else {
            document.getElementById(field).value = 1;
            alert("se pasa el stock")
          }
        }

        function printTable(){
          var total = 0;
          var estructura = '<div class="form-row">';
          estructura = estructura + '<div class="form-group col-md-3">';
          estructura = estructura + '<label>Nombre:</label>';
          estructura = estructura + '</div>';
          estructura = estructura + '<div class="form-group col-md-3">';
          estructura = estructura + '<label>Precio:</label>';
          estructura = estructura + '</div>';
          estructura = estructura + '<div class="form-group col-md-2">';
          estructura = estructura + '<label>Cantidad:</label>';
          estructura = estructura + '</div>';
          estructura = estructura + '<div class="form-group col-md-2">';
          estructura = estructura + '<label>Subtotal:</label>';
          estructura = estructura + '</div>';
          estructura = estructura + '<div class="form-group col-md-2"></div>';
          estructura = estructura + '<input class="form-control" style="display: none;" type="text" name="cant_prod" value="'+carrito.length+'" readonly="true">';
          estructura = estructura + '</div>';
          estructura = estructura + '</div>';

          for(var i = 0; i < carrito.length; i++){
            estructura = estructura + '<input id="id_prod_'+i+'" name="id_prod_'+i+'" class="form-control" style="display: none;" type="text" value="'+carrito[i].id_prod+'">';
            
            estructura = estructura + '<div class="form-row">';
            estructura = estructura + '<div class="form-group col-md-3">';
            estructura = estructura + '<input class="form-control" type="text" value="'+carrito[i].nombre+'" readonly="true">';
            estructura = estructura + '</div>';
            estructura = estructura + '<div class="form-group col-md-3">';
            estructura = estructura + '<input class="form-control" type="text" value="'+carrito[i].price+'" readonly="true">';
            estructura = estructura + '</div>';
            estructura = estructura + '<div class="form-group col-md-2">';
            estructura = estructura + '<input class="form-control" onchange="actualizarCantidad('+i+')" id="cant_'+i+'" name="cant_'+i+'" type="number" min="1" value="'+carrito[i].cantidad+'">';
            estructura = estructura + '</div>';
            estructura = estructura + '<div class="form-group col-md-2">';
            estructura = estructura + '<input class="form-control" type="text" id="sub_'+i+'" name="sub_'+i+'" value="'+carrito[i].sub_total+'" readonly="true">';
            estructura = estructura + '</div>';
            estructura = estructura + '<div class="form-group col-md-2">';
            estructura = estructura + '<button type="button" class="btn btn-danger" onclick="deleteFn('+i+')">Borrar</button>';
            estructura = estructura + '</div>';
            estructura = estructura + '</div>';
            total = total + carrito[i].sub_total;
          }
          estructura = estructura + '<div class="form-row">';
          estructura = estructura + '<p>Label:</p>';
          estructura = estructura + '<input class="form-control" type="text" id="total" name="total" value="'+total+'" readonly="true">';
          estructura = estructura + '</div>';
          $("div.modal-body").html(estructura);
        }
      </script>

      <!-- Modal de editar -->
      <?php include('./scripts/vender.php'); ?>
      <div class="modal fade" id="miModal" role="dialog">
        <div class="modal-dialog modal-lg">
          <!-- Contenido del modal -->
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Editar pedido</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form onsubmit="return doSomething();" action="" method="post">
              <div class="modal-body"></div>
              <div class="modal-footer">
                <input class="btn btn-primary" name="save_order" id="save_order" type="submit" value="Guardar">
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