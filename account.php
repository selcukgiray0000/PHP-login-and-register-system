<?php
session_start();
require_once "files/config.php";
require_once "files/inc.php";



//register
if(isset($_POST["registerform"]))
{
  $username = $_POST['username'];
  $emails = $_POST['email'];
  $password = md5($_POST['password']);
  $gender = $_POST['gender'];

  
    if($username!="" && $email=!"" && $password!="")
    {
      if(filter_var($emails, FILTER_VALIDATE_EMAIL))
      {
        $mailcontrol = $db->prepare("SELECT * FROM user WHERE email=?");
        $mailcontrol->execute([$emails]);
        $number = $mailcontrol->rowCount();
        
        if($number > 0)
        {
          $msg = "This e-mail address is being used.";
        }
        else
        {
            $query = $db->prepare("insert into user set username=?, email=?, password=?, gender=?");
            $add = $query->execute([$username, $emails, $password, $gender]);
        
          if($add)
          {
            $msg = "Account created.";
            header("Refresh: 2; url=account.php");
          }
          else
          {
            $msg = "Account not created!";
          }
        }
      }
      else
      {
        $msg = "Please enter a valid mail type!";
      }
    }
    else
    {
      $msg = "Please do not leave blank spaces!";
    }
}


//login
if(isset($_POST['loginform']))
{
  $emails = $_POST['email'];
  $password = $_POST['password'];

  if($emails!="" && $password!="")
  {
    if(filter_var($emails, FILTER_VALIDATE_EMAIL))
    {
      $query = $db->prepare("SELECT * FROM user WHERE email=? and password=?");
      $query->execute([$emails, md5($password)]);
      $number = $query->rowCount();

      if($number > 0)
      {
        $_SESSION["email"] = $emails;
        $loginmsg = "Login successful.";
        header("Refresh: 2; url=index.php");
      }
      else
      {
        $loginmsg = "User information does not match!";
      }
    }
    else
    {
      $loginmsg = "Please enter a valid mail type!";
    }
  }
  else
  {
    $loginmsg = "Please do not leave blank spaces!";
  }
}
?>







<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <title>Login & Register</title>
  </head>
  <?php include "files/navbar.php"?>
  <body>
    <div class="container-fluid mt-3">
      <div class="row ">
        <div class="col-4  mx-auto">
          <div class="alert alert-danger" role="alert">
            Login Form
          </div>
          <form method="post">
            <label>Email</label>
            <input type="text" class="form-control" name="email">
            <label>Password</label>
            <input type="text" class="form-control" name="password">
              <?php 
          if(!empty($loginmsg))
          {
            ?>
            <div class="alert alert-warning mt-1" role="alert">

            <?php  echo $loginmsg;?>
            </div>
            <?php
          }
          ?>
            <button type="type" class="btn btn-success mt-2" name="loginform">Login</button>
          </form>
        </div>
        <div class="col-4  mx-auto">
        <div class="alert alert-danger" role="alert">
            Register Form
        </div>
        <form method="post">
          <label>Username</label>
          <input type="text" class="form-control" name="username">
          <label>Email</label>
          <input type="text" class="form-control" name="email">
          <label>Password</label>
          <input type="text" class="form-control" name="password">
          <label>Gender</label>
          <select name="gender" class="form-control">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
          <?php 
          if(!empty($msg))
          {
            ?>
            <div class="alert alert-warning mt-1" role="alert">
            <?php  echo $msg;?>
            </div>
            <?php
          }
          ?>
          <button type="type" class="btn btn-success mt-1" name="registerform">Register</button>
        </form>
        </div>
      </div>
    </div>
  </body>
</html>