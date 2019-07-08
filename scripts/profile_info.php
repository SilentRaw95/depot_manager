<?php
  include('config.php');
  session_start();// Starting Session
  $login_session = $_SESSION['login_user'];

  $consulta = "SELECT * FROM users WHERE id = '$login_session' LIMIT 1";
  $resultado = mysqli_query($conexion, $consulta);
  $datos = mysqli_fetch_array($resultado);
  
  $perfil_id = $datos['id'];
  $nombre = $datos['name'];
  $rol = $datos['role'];

  mysqli_close($conexion); // Closing Connection 
?>