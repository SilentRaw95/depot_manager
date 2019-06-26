<?php
  include('./scripts/login.php');
  if(isset($_SESSION['login_user'])){
    header("location: profile.php"); // Redirecting To Profile Page
  }
?> 
<!DOCTYPE html>
<html>
  <head>
    <title>Login Form in PHP with Session</title>
    <link href="./css/login.css" rel="stsylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
  <body>
    <div id="login">
      <h2>Login Form</h2>
      <form action="" method="post">
        <label>UserName :</label>
        <input id="name" name="username" placeholder="username" type="text">
        <label>Password :</label>
        <input id="password" name="password" placeholder="**********" type="password"><br><br>
        <input name="submit" type="submit" value=" Login ">
        <span><?php echo $error; ?></span>
      </form>
    </div>
  </body>
</html>