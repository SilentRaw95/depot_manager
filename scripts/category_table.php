<?php
  include('config.php');

  $sql = "SELECT * FROM categories"; 
  $rs_result = mysqli_query($conexion, $sql);
?>