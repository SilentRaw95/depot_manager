<?php
  include('config.php');
  $limit = 10;

  if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
  if (isset($_GET['busqueda'])) { $search = $_GET['busqueda']; } else { $search = ''; };
  $start_from = ($page-1) * $limit;
  
  $sql = "";
  $sql_temp = "";
  
  $values_sql = "p1.id, p1.category_id, p2.name as categoria_name, p1.name, p1.stock, p1.price, p1.cell";
  $inner_join = "INNER JOIN categories p2 ON p1.category_id = p2.id";

  if(isset($search)){
    $sql = "SELECT $values_sql FROM products p1 $inner_join WHERE p1.name LIKE '%".$search."%' LIMIT $start_from, $limit"; 
    $sql_temp = "SELECT COUNT(id) FROM products WHERE name LIKE '%".$search."%'"; 
  } else {
    $sql = "SELECT $values_sql FROM products p1 $inner_join LIMIT $start_from, $limit"; 
    $sql_temp = "SELECT COUNT(id) FROM products"; 
  }
  $rs_resultP = mysqli_query($conexion, $sql);
?>