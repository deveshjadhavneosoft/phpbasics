<?php
  error_reporting(0);
  $password= $_SESSION['sp'];
  $email= $_SESSION['sid'];
  $error=$cpassError=$passError=$npassError="";
  if(isset($_POST["changepass"])){
      $opass=input_field($_POST['op']);
      $pass=input_field($_POST['np']);
      $conpass=input_field($_POST['cp']);
      if(empty($opass)){
        $passError="*Old password required";
      }
      if(empty($pass)){
        $npassError="*New password required";
      }
      if(empty($conpass)){
        $cpassError="*Confirmed password required";
      } 
      else{
          if($opass!=$password){
            $error="*Old password does not match";
          }
          else if($pass==$opass){
                $error="*New Password is same as old";
          }
          else if($pass!=$conpass){
                    $error="*Enter same password";
          }
          else{
            if(!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/",$pass)){
              $error="*Must be a minimum of 8 characters, contain at least 1 number, contain at least one uppercase character and contain at least one lowercase character";
            }
          }
      }
      if(empty($npassError) && empty($cpassError) && empty($passError) && empty($error)){    
              $fo=fopen("users/$email/details.txt","r");
              $fn=fopen("users/$email/details1.txt","a+");
              $i=1;
              while($i!=2){
                  fwrite($fn,fgets($fo));
                  $i++;
              }
              fwrite($fn,$pass."\n");
              fgets($fo);
          
              while(!feof($fo)){
                fwrite($fn,fgets($fo)); 
              }
              fclose($fo);
              fclose($fn);
            
              unlink("users/$email/details.txt");
              rename("users/$email/details1.txt","users/$email/details.txt");
              $error="Password changed successfully";
              header("location:index.php");
          }
     
     
  }//isset close

  function input_field($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
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

    <title>change password page</title>
    <style>
      .error{
        color: red;
      }
    </style>
  </head>
  <body>
<header class="jumbotron bg-primary container">
<h1 class="text-center text-white">Change password</h1>
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
  <div class="form-group ">
    <label for="op" class="font-weight-bold">Old Password</label>
    <input type="password" class="form-control" name="op" placeholder="Password"><span class="error"><?php echo $passError; ?></span>
  </div>
  <div class="form-group ">
    <label for="np" class="font-weight-bold">New Password</label>
    <input type="password" class="form-control" name="np" placeholder="Password"><span class="error"><?php echo $npassError; ?></span>
  </div>
  <div class="form-group ">
    <label for="cp" class="font-weight-bold">Confirm Password</label>
    <input type="password" class="form-control" name="cp" placeholder="Password"><span class="error"><?php echo $cpassError; ?></span>
  </div>


  <button type="submit" class="btn btn-primary" name="changepass">Change Password</button>
 <div class="container text-danger">
 <?php echo $error; ?>
 </div>
  

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