<?php
  include('config.php');
  session_start();
  $error = '';

  if (isset($_POST['submit'])) { 
    if (empty($_POST['username']) || empty($_POST['password'])) { 
      $error = "Username or Password is invalid"; 
    } else {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $consulta = "SELECT * FROM users WHERE username = '$username' AND password = '$password' LIMIT 1";
      $resultado = mysqli_query($conexion, $consulta);

      $id = mysqli_fetch_array($resultado);
      $id_result = $id['id'];

      if($id_result != ""){
        $_SESSION['login_user'] = $id_result; // Initializing Session
        header("location: profile.php"); // Redirecting To Profile Page 
      } else {
        $error = "No hay usuario, ahora el fbi ira por ti"; 
      }
    } 
    mysqli_close($conexion); // Closing Connection 
  } 
?>