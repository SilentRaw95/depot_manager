<?php
  include('./scripts/login.php');
  if(isset($_SESSION['login_user'])){
    header("location: profile.php"); // Redirecting To Profile Page
  }
?> 
<!DOCTYPE html>
<html>
  <head>
    <title>Depot Manager - Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="./css/login.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <form class="login_container" action="" method="post">
      <img src="./img/DM.PNG" class="img-fluid" alt="Responsive image">
      <h1 class="h3 mb-3 font-weight-normal">Depot Manager</h1>

      <div class="form-group">
        <input class="form-control" id="name" name="username" placeholder="Username" type="text">
        <input class="form-control" id="password" name="password" placeholder="Contraseña" type="password">
      </div>

      <div class="form-group row">
        <div class="col-sm-12">
          <input class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="Login">
        </div>
      </div>
      <p class="text-muted"><?php echo $error; ?></p>
    </form>
  </body>
</html>