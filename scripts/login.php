<?php
  session_start();
  $error = '';

  if (isset($_POST['submit'])) { 
    if (empty($_POST['username']) || empty($_POST['password'])) { 
      $error = "Username or Password is invalid"; 
    } else {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $conexion = mysqli_connect("localhost", "root", "", "depot_manager"); 
      $consulta = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
      $resultado = mysqli_query($conexion, $consulta);

      $filas = mysqli_num_rows($resultado);
      if($filas > 0){
        $_SESSION['login_user'] = $username; // Initializing Session
          header("location: profile.php"); // Redirecting To Profile Page 
      } else {
        $error = "No hay usuario, ahora el fbi ira por ti"; 
      }
    } 
    mysqli_close($conexion); // Closing Connection 
  } 
?>