<?php
  include('config.php');
  //funcion de anadir producto

  if (isset($_POST['crear_producto'])) {
    $val_name = $_POST['name'];
    $val_categoria = $_POST['categoria'];
    $val_precio = $_POST['precio'];
    $val_stock = $_POST['stock'];
    $val_bodega = $_POST['bodega'];

    $consulta = "SELECT * FROM products WHERE name = '$val_name'";
    $resultado = mysqli_query($conexion, $consulta);

    $name = mysqli_fetch_array($resultado);
    $name_result = $name['name'];

    if($name_result == null){
      $values = "('$val_categoria','$val_name', $val_stock, $val_precio, '$val_bodega')";
      $sql = "INSERT INTO products (category_id, name, stock, price, cell) VALUES ".$values;

      if(mysqli_query($conexion, $sql)){
        //$error_add = "Records inserted successfully.";
      } else{
        //$error_add = "ERROR: Could not able to execute". mysqli_error($conexion);
      }
    }
  } 
?>