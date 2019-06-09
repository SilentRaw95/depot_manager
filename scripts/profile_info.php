<?php
  session_start();// Starting Session
  $login_session = $_SESSION['login_user'];
  $conexion = mysqli_connect("localhost", "root", "", "depot_manager"); 

  $consulta = "SELECT * FROM users WHERE id = '$login_session' LIMIT 1";
  $resultado = mysqli_query($conexion, $consulta);
  $datos = mysqli_fetch_array($resultado);
  
  $nombre = $datos['name'];
  $rol = $datos['role'];

  mysqli_close($conexion); // Closing Connection 
?>