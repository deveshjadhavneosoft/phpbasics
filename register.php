<?php
include('cap.php');
error_reporting(0);
$email=$_POST['email'];
$name=$_POST['uname'];
$pass=$_POST['password'];
$gender=$_POST['gender'];
$age=$_POST['age'];
$cap=$_POST['cap'];
$tmp=$_FILES['att']['tmp_name'];
$errMessage=$genderError=$emailError=$passError=$ageError=$imageError=$capError='';
if(isset($_POST['register'])){  
  if(empty($email))  {
    $emailError="This field is required";
  }
  else if(!preg_match("/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9+.-]+$/",$email)){
        $emailError="Enter valid email ";
      }
    if(empty($name)){
      $nameError="This field is required";
    }
    else if(!preg_match("/^[a-zA-Z0-9]{6}+$/",$name)){
      $nameError="should have number and alphabet and length should be 6";
    }
    if(empty($pass)){
      $passError="This field is required";
    }
    else if(!(preg_match("/^[a-zA-Z0-9]{8,16}+$/",$pass))){
      $passError="length of password should be greater than or equal to 8 and must contain numbers and alphabets";
    }
    if(empty($age)){
      $ageError="This field is required";
    }
  else if($age<0 || $age>150){
     $ageError="Enter valid age";
   }
   if(empty($gender)){
     $genderError="please select any one";
   }
   if(empty($tmp)){
     $imageError="This field is required";
   }
   if(empty($cap)){
     $capError="This field is required";
   }

if($_POST['cap']==$_POST['capsum']){
$fn=$_FILES['att']['name'];
$_SESSION['fn']="users/$email/$fname";
$ext=pathinfo($fn,PATHINFO_EXTENSION);
$fname="image-".time()."-".rand().".$ext";
$_SESSION['sn']=$name;
$_SESSION['sa']=$age;
$_SESSION['sg']=$gender;
$_SESSION['si']=$fname;
if($ext=="png" || $ext=="jpg" || $ext=="jpeg"){
  if(is_dir("users/$email")){
  $errMessage="Email already exists";
  }
  else{
    $fo=fopen("users/$email/details.txt","r");
    $un=fgets($fo);
    if($un==$name){
      $errMessage="user name already exists";
    }
    else{
      mkdir("users/$email");
      if(move_uploaded_file($tmp,"users/$email/$fname")){
file_put_contents("users/$email/details.txt","$name\n$pass\n$gender\n$age\n$fname");
header("location:welcome.php?uid=$email");
      }
      else{
        rmdir("users/$email/");
        $errMessage="uploading error";
      }
    }
  }
}
else{
  $imageError="image should be jpg, png or jpeg";
}
   }
   else{
     $errMessage="Enter valid captcha";
   }
}
if (isset($_POST["backtologin"])) {
  header("Location: index.php");
  exit();
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

    <title>Registration page</title>
    <style>
      .error{
        color: red;
      }
    </style>
  </head>
  <body>
<header class="jumbotron bg-dark container">
<h1 class="text-center text-white">Register panel</h1>
</header>

<div class="container">
<?php
if(!empty($errMessage)){
    ?>
    <div class="alert alert-danger"><?php echo $errMessage; ?></div>

 <?php   
}
?>
<form method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="email"class="font-weight-bold">Email address</label>
    <input type="text" class="form-control" name="email" placeholder="Enter Email"><span class="error"><?php echo $emailError; ?></span>
  </div>

  <div class="form-group">
    <label for="uname"class="font-weight-bold">Username</label>
    <input type="text" class="form-control" name="uname" placeholder="Enter Username"><span class="error"><?php echo $nameError; ?></span>
  </div>


  
  <div class="form-group ">
    <label for="password" class="font-weight-bold">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password"><span class="error"><?php echo $passError; ?></span>
  </div>

  <div class="form-group">
      <label class="font-weight-bold" for="gender">Gender</label>
        <input type="radio" class="font-weight-bold" name="gender" value="Female">Female
        <input type="radio" class="font-weight-bold" name="gender" value="Male">Male <span class="error"><?php echo $genderError; ?></span>
      
    </div>
  
  <div class="form-group">
    <label for="age"class="font-weight-bold">Age</label>
    <input type="text" class="form-control" name="age" placeholder="Enter Age"><span class="error"><?php echo $ageError; ?></span>
  </div>


  <div class="form-group">
    <label for="att" class="font-weight-bold"> Image</label>
    <input type="file" class="form-control-file" name="att"><span class="error"><?php echo $imageError; ?></span>
  </div>

  <div class="form-group">
    <label for="cap" class="font-weight-bold"> Captcha:<b><?Php echo $pat; ?></b></label>
    <input type="text" class="form-control-file" name="cap">
    <input type="hidden" class="form-control-file" name="capsum" value="<?php echo $capsum; ?>"><span class="error"><?php echo $capError; ?></span>
  </div>

  <button type="submit" class="btn btn-primary" name="register">Register</button>
  <button type="submit" class="btn btn-primary " name="backtologin">Back to login </button>

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