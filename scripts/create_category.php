<?php
  include('config.php');
  //funcion de anadir categorias
  $error_add = "";

  if (isset($_POST['crear_categoria'])) {
    $error_add = "";

    //validaciones
    $val_username = $_POST['create_category'];

    $consulta = "SELECT * FROM categories WHERE name = '$val_username'";
    $resultado = mysqli_query($conexion, $consulta);

    $name = mysqli_fetch_array($resultado);
    $name_result = $name['name'];

    if($name_result == null){
      $sql = "INSERT INTO categories (name) VALUES ('$val_username')";

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