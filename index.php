<?php
session_start();
require_once "files/config.php";
require_once "files/inc.php";

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login System</title>
  </head>
  <body>

<?php include "files/navbar.php"?>


<?php
if(isset($_SESSION["email"]))
{
 ?>
  <div class="alert alert-success mt-2" role="alert">
        <?php echo "Welcome:"." ".$username;?>
    </div>
 <?php 
}
else
{
  ?>
    <div class="alert alert-success mt-2" role="alert">
        Not logged in. Please login. <a href="account.php">Login & Register</a>
    </div>
  <?php

}
?>
  </body>
</html>