<?php
  include('config.php');

  $error_add2 = "";
  if(isset($_POST['save_edit_prod'])) {
    //validaciones
    $edit_id = $_POST['prod_id'];
    $edit_categoria = $_POST['prod_categoria_id'];
    $edit_name = $_POST['prod_name'];
    $edit_stock = $_POST['prod_stock'];
    $edit_price = $_POST['prod_price'];
    $edit_cell = $_POST['prod_cell'];
    
    $sql_values = "name = '".$edit_name."', category_id = ".$edit_categoria.", stock = ".$edit_stock.", price = ".$edit_price.", cell = '".$edit_cell."'";
    $sql_update = "UPDATE products SET ".$sql_values." WHERE id = ".$edit_id;
    echo "<script>console.log( 'Debug Objects: " . $sql_update . "' );</script>";

    if(mysqli_query($conexion, $sql_update)){
      $error_add2 = "sdsdsdsdsddsds";
      //$error_add = "Records inserted successfully.";
    } else {
      $error_add2 = "";
      //$error_add = "ERROR: Could not able to execute". mysqli_error($conexion);
    }
  }
?>