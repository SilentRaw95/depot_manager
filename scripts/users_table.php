<?php
  include('config.php');
  $limit = 10;

  if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
  if (isset($_GET['busqueda'])) { $search = $_GET['busqueda']; } else { $search = ''; };
  $start_from = ($page-1) * $limit;
  
  $sql = "";
  $sql_temp = "";
  if(isset($search)){
    $sql = "SELECT * FROM users WHERE username LIKE '%".$search."%' OR name LIKE '%".$search."%' OR email LIKE '%".$search."%' LIMIT $start_from, $limit"; 
    $sql_temp = "SELECT COUNT(id) FROM users WHERE username LIKE '%".$search."%' OR name LIKE '%".$search."%' OR email LIKE '%".$search."%'"; 
  } else {
    $sql = "SELECT * FROM users LIMIT $start_from, $limit"; 
    $sql_temp = "SELECT COUNT(id) FROM users"; 
  }
  $rs_result = mysqli_query($conexion, $sql);
?>