<?php
error_reporting(0);
$email=$_POST['email'];
$pass=$_POST['password'];
$errMessage='';
if(isset($_POST['login'])){
  if(empty($email))  {
    $emailError="This field is required";
  }
  else if(!preg_match("/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9+.-]+$/",$email)){
        $emailError="Enter valid email ";
      }
      if(empty($pass)){
        $passError="This field is required";
      }
      else if(!(preg_match("/^[a-zA-Z0-9]{8,16}+$/",$pass))){
        $passError="length of password should be greater than equal to 8";
      }
      if(is_dir("users/$email") && $emailError=='' && $passError==''){
        $fo=fopen("users/$email/details.txt","r");
        $t=1;
        while($t!=3){
          $ans=fgets($fo);
          $t++;
        }
        if(trim($ans)==$pass){
          session_start();
          $_SESSION['sid']=$email;
          $_SESSION['sp']=$pass;
          if(!empty($_POST['remember'])){
            setcookie('email',$email,time()+3600*24);
            setcookie('password',$pass,time()+3600*24);
          }
          header("location:dashboard.php");
        }
        else{
          $passError="wrong password";
        }
      }
      else if($emailError=='' && $passError==''){
        $errMessage="Not registered with this email id";
      }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Login page</title>
    <style>
      .error{
        color: red;
      }
    </style>
    <script>
      function cook(){
if("<?php $_COOKIE['email']; ?>"!=undefined){
  if(document.getElementById("email").value=="<?php echo $_COOKIE['email']; ?>"){
    document.getElementById("password").value="<?php echo $_COOKIE['password']; ?>";
  }
  else{
    document.getElementById("password").value="";
  }
}
      }

    </script>
  </head>
  <body>
<header class="jumbotron bg-dark container">
<h1 class="text-center text-white">Login panel</h1>
</header>
<div class="container">
    <?php
if(!empty($errMessage)){
    ?>
    <div class="alert alert-danger"><?php echo $errMessage; ?></div>

 <?php   
}
?>

   
<form method="post">
  <div class="form-group">
    <label for="email" class="font-weight-bold">Email address</label>
    <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" onchange="cook()"><span class="error"><?php echo $emailError; ?></span>
  </div>


  <div class="form-group ">
    <label for="password"  class="font-weight-bold">Password</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Password"><span class="error"><?php echo $passError; ?></span>
  </div>

  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="remember">
      <label class="form-check-label" for="remember">
        Remember me
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary" name="login">Login</button>
  <a href="register.php" class="btn btn-primary">New User ?</a>
  </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
  </body>
</html>