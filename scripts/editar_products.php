<?php
  include('config.php');

  $error_add2 = "";
  if(isset($_POST['save_edit_prod'])) {
    //validaciones
    $edit_id = $_POST['prod_id'];
    $edit_categoria = $_POST['prod_categoria_id'];
    $edit_name = $_POST['prod_name'];
    $edit_stock = $_POST['prod_stock'];
    $edit_price = $_POST['prod_price'];
    $edit_cell = $_POST['prod_cell'];
    
    $sql_values = "name = '".$edit_name."', category_id = ".$edit_categoria.", stock = ".$edit_stock.", price = ".$edit_price.", cell = '".$edit_cell."'";
    $sql_update = "UPDATE products SET ".$sql_values." WHERE id = ".$edit_id;

    //consultar viejos datos
    $consulta = "SELECT * FROM products WHERE id = '$edit_id' LIMIT 1";
    $resultado = mysqli_query($conexion, $consulta);
    $datos = mysqli_fetch_array($resultado);
  
    $og_category = $datos['category_id'];
    $og_stock = $datos['stock'];
    $og_price = $datos['price'];
    $og_cell = $datos['cell'];

    if(mysqli_query($conexion, $sql_update)){
      $accion = "";
      $val_stock = $og_stock;

      if($og_category != $edit_categoria){
        $accion = $accion."Se cambio la categoria"."<br />";
      }
      if($og_stock != $edit_stock){
        $accion = $accion."Se cambio el stock"."<br />";
        $val_stock = $edit_stock;
      }
      if($og_price != $edit_price){
        $accion = $accion."Se cambio el precio"."<br />";
      }
      if($og_cell != $edit_cell){
        $accion = $accion."Se cambio la bodega"."<br />";
      }

      $almacen_values = "($perfil_id, $edit_id, $val_stock, '".date("d-m-Y")." ".date("h:i:sa")."', '$accion')";
      $sql_almacen = "INSERT INTO almacen (empleado, producto, cantidad, fecha, accion) VALUES ".$almacen_values;
      
      echo $sql_almacen;
      mysqli_query($conexion, $sql_almacen);
    }
  }
?>