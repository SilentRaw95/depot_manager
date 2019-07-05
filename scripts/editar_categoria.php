<?php
  include('config.php');

  if(isset($_POST['save_edit'])) {
    //validaciones
    $edit_id = $_POST['modal_id'];
    $edit_name = $_POST['modal_categoria'];

    //name
    $consulta = "SELECT * FROM categories WHERE name = '$edit_name'";
    $resultado = mysqli_query($conexion, $consulta);
    $name = mysqli_fetch_array($resultado);
    $name_result = $name['name'];

    if($name_result == null){
      $sql_values = "name = '".$edit_name."'";
      $sql_update = "UPDATE categories SET ".$sql_values." WHERE id = ".$edit_id;
      if(mysqli_query($conexion, $sql_update)){
        //$error_add = "Records inserted successfully.";
      } else{
        //$error_add = "ERROR: Could not able to execute". mysqli_error($conexion);
      }
    }
  }
?>