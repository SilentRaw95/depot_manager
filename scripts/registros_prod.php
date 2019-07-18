<?php
  include('config.php');
  $reg_prod  = $_GET["reg_prod"];
  
  $values_sql = "p2.name as producto, p2.price, p1.cantidad, p1.subtotal";
  $inner_join = "INNER JOIN products p2 ON p1.producto = p2.id";

  $sql = "SELECT $values_sql FROM registro_producto p1 $inner_join WHERE p1.id_registro_venta = $reg_prod";
  
  $rs_result = mysqli_query($conexion, $sql);
?>