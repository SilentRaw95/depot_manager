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
        $temp = mysqli_insert_id($conexion);
        $almacen_values = "($perfil_id, $temp, $val_stock, '".date("d-m-Y")." ".date("h:i:sa")."', 'Producto a&ntilde;adido')";
        $sql_almacen = "INSERT INTO almacen (empleado, producto, cantidad, fecha, accion) VALUES ".$almacen_values;
      
        mysqli_query($conexion, $sql_almacen);
      }
    }
  } 
?>