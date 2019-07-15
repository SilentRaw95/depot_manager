<?php
  include('config.php');

  if (isset($_POST['save_order'])) {
    //valores
    $total = $_POST['total'];

    $sql1_values = "($perfil_id, '".date("d-m-Y")." ".date("h:i:sa")."', $total)";
    $sql1 = "INSERT INTO registro_venta (empleado, fecha, total) VALUES ".$sql1_values;

    if(mysqli_query($conexion, $sql1)){
      $venta_id = mysqli_insert_id($conexion);

      //registro prod
      $contador = $_POST['cant_prod'];
      for($x=0; $x < $contador; $x++){
        //campos
        $field_id = "id_prod_".$x;
        $field_cantidad = "cant_".$x;
        $field_sub = "sub_".$x;

        //valores
        $val_id = $_POST[$field_id];
        $val_cantidad = $_POST[$field_cantidad];
        $val_sub = $_POST[$field_sub];

        //tabla pregistro de productos
        $sql2_values = "($venta_id, $val_id, $val_cantidad, $val_sub)";
        $sql2 = "INSERT INTO registro_producto (id_registro_venta, producto, cantidad, subtotal) VALUES $sql2_values";
        mysqli_query($conexion, $sql2);

        //tabla productos
        $sql3_values = "stock = stock - $val_cantidad";
        $sql3_update = "UPDATE products SET ".$sql3_values." WHERE id = ".$val_id;
        mysqli_query($conexion, $sql3_update);
      }
    }
  } 
?>