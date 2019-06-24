<?php
    include('config.php');
    $limit = 2;
    if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
    $start_from = ($page-1) * $limit;
    
    $sql = "SELECT * FROM users LIMIT $start_from, $limit";  
    $rs_result = mysqli_query($conexion, $sql);
?>