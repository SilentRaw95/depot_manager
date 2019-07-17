<?php
  include('config.php');
  $limit = 10;

  if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
  if (isset($_GET['busqueda'])) { $search = $_GET['busqueda']; } else { $search = ''; };
  $start_from = ($page-1) * $limit;
  
  $sql = "";
  $sql_temp = "";
  
  $values_sql = "p1.id, p2.username as empleado, p1.fecha, p1.total";
  $inner_join = "INNER JOIN users p2 ON p1.empleado = p2.id";

  if(isset($search)){
    $sql = "SELECT $values_sql FROM registro_venta p1 $inner_join WHERE p1.fecha LIKE '%".$search."%' LIMIT $start_from, $limit"; 
    $sql_temp = "SELECT COUNT(p1.id) FROM registro_venta p1 $inner_join WHERE p1.fecha LIKE '%".$search."%'"; 
  } else {
    $sql = "SELECT $values_sql FROM registro_venta p1 $inner_join LIMIT $start_from, $limit"; 
    $sql_temp = "SELECT COUNT(p1.id) FROM registro_venta p1"; 
  }
  //echo "<script>console.log( " . $sql_temp . " );</script>";
  $rs_result = mysqli_query($conexion, $sql);
?>