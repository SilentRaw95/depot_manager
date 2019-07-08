<?php
  include('config.php');
  $limit = 10;

  if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
  if (isset($_GET['busqueda'])) { $search = $_GET['busqueda']; } else { $search = ''; };
  $start_from = ($page-1) * $limit;
  
  $sql = "";
  $sql_temp = "";
  
  $values_sql = "p1.id, p2.username as empleado, p3.name as producto, p1.cantidad, p1.fecha, p1.accion";
  $inner_join = "INNER JOIN users p2 ON p1.empleado = p2.id INNER JOIN products p3 ON p1.producto = p3.id";

  if(isset($search)){
    $sql = "SELECT $values_sql FROM almacen p1 $inner_join WHERE p3.name LIKE '%".$search."%' LIMIT $start_from, $limit"; 
    $sql_temp = "SELECT COUNT(id) FROM almacen WHERE name LIKE '%".$search."%'"; 
  } else {
    $sql = "SELECT $values_sql FROM almacen p1 $inner_join LIMIT $start_from, $limit"; 
    $sql_temp = "SELECT COUNT(id) FROM almacen"; 
  }
  echo "<script>console.log( " . $sql . " );</script>";
  $rs_result = mysqli_query($conexion, $sql);
?>