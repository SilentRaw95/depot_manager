<?php
  include('config.php');
  //funcion de anadir usuarios
  $error_add = "";

  if (isset($_POST['guardar'])) {
    $error_add = "";
    //validaciones
    $val_username = empty($_POST['username']);
    $val_password = empty($_POST['password']);
    $val_name = empty($_POST['name']);
    $val_email = empty($_POST['email']);
    $val_rol = empty($_POST['rol']);
    //variables
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $rol = intval($_POST['rol']);

    //validacion
    $validation = TRUE;
    if($val_username == TRUE){
      $validation = FALSE;
    }
    if($val_password == TRUE){
      $validation = FALSE;
    }
    if($val_name == TRUE){
      $validation = FALSE;
    }
    if($val_email == TRUE){
      $validation = FALSE;
    }
    if($val_rol == TRUE){
      $validation = FALSE;
    }

    if($validation == TRUE){
      $sql = "INSERT INTO users (username, password, name, email, role, active) VALUES ('$username', '$password', '$name', '$email', $rol, 1)";

      if(mysqli_query($conexion, $sql)){
        $error_add = "Records inserted successfully.";
      } else{
        $error_add = "ERROR: Could not able to execute". mysqli_error($conexion);
      }
    } else {
      $error_add = "Falta completar los datos";
    }
  } 
?>