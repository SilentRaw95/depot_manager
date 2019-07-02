<?php
  include('config.php');

  if(isset($_POST['save_edit'])) {
    //validaciones
    $edit_id = $_POST['modal_id'];
    $edit_username = $_POST['modal_username'];
    $edit_password = $_POST['modal_password'];
    $edit_name = $_POST['modal_name'];
    $edit_email = $_POST['modal_email'];
    $edit_rol = $_POST['modal_rol'];
    $edit_active = $_POST['modal_active'];
    
    $sql_values = "username = '".$edit_username."', password = '".$edit_password."', name = '".$edit_name."', email = '".$edit_email."', role = ".$edit_rol.", active = ".$edit_active;
    $sql_update = "UPDATE users SET ".$sql_values." WHERE id = ".$edit_id;

    if(mysqli_query($conexion, $sql_update)){
      //$error_add = "Records inserted successfully.";
    } else{
      //$error_add = "ERROR: Could not able to execute". mysqli_error($conexion);
    }
  }
?>