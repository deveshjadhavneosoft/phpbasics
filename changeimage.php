<?php
  error_reporting(0);
  $fileError=$success="";
  $email=$_SESSION['sid'];
  if(isset($_POST["submit"])){
      $tmp=$_FILES['image']['tmp_name'];
      $fn=$_FILES['image']['name'];
      $ext=pathinfo($fn,PATHINFO_EXTENSION);
      if(empty($tmp))
      {
          $fileError="*Image required";
      }
      if($ext=="jpg" || $ext=="png" || $ext=="jpeg"){
        $fname="image-".time()."-".rand().".$ext";
        $fo=fopen("users/$email/details.txt","r");
        $fn2=fopen("users/$email/details1.txt","a+");
        
        $i=1;
        while($i!=5){
            fwrite($fn2,fgets($fo));
            $i++;
        }
        $old_img=input_field(fgets($fo));
        if(move_uploaded_file($tmp,"users/$email/$fname")){
            fwrite($fn2,$fname."\n");
        }
        else{
          $fileError="File upload error";
        }
        
        fclose($fo);
        fclose($fn2);
        unlink("users/$email/$old_img");
        unlink("users/$email/details.txt");
        rename("users/$email/details1.txt","users/$email/details.txt");
        $success="Image Changed Successfully!";
      }
      else{
          $fileError="*Only jpg, png and jpeg supported";
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

    <title>change image page</title>
  </head>
  <body>
<header class="jumbotron bg-primary container">
<h1 class="text-center text-white">Change Image</h1>
</header>

<div class="container">
<?php
if(!empty($fileError)){
    ?>
    <div class="alert alert-danger"><?php echo $fileError; ?></div>

 <?php   
}
?>
<form method="post" enctype="multipart/form-data"> 

<div class="form-group">
    <label for="image" class="font-weight-bold"> Image</label>
    <input type="file" class="form-control-file" name="image">
  </div>

  <button type="submit" class="btn btn-primary" name="submit">Change Image</button>
  
  <div class="container">
<?php
if(!empty($success)){
    ?>
    <div class="text-success"><?php echo $success; ?></div>
 <?php  
}
?>
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