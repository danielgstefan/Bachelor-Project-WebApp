<?php

include('../database/connect.php');
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<style>

    body{
        overflow: hidden;
    }
</style>
    
</head>
  <body>
  
<div class="container-fluid m-3">
<h2 class="text-center mb-5">Admin Registration</h2>
<div class="row d-flex justify-content-center"> 
<div class="col-lg-6 ">
<img src="images/GDS.png" alt="Admin Registration" class="img-fluid">
</div>
<div class="col-lg-6 col-xl-4">
<form action="" method="post">
<div class="form-outline mb-4">
<label for="username"class="form-label">Username</label>
<input type="text" id="username" name="username" placeholder="Enter your username" required="required" class="form-control">
</div>
<div class="form-outline mb-4">
<label for="email" class="form-label">Email</label>
 <input type="email" id="email" name="email"placeholder="Enter your email" required="required" class="form-control">
</div>
<div class="form-outline mb-4">
<label for="password" class="form-label">Password</label>
 <input type="password" id="password" name="password"placeholder="Enter your password" required="required" class="form-control">
</div>
<div class="form-outline mb-4">
<label for="confirm_password" class="form-label">Confirm password</label>
 <input type="password" id="confirm_password" name="confirm_password"placeholder="Confirm your password" required="required" class="form-control">
</div>
<div>
    <input type="submit" class="bg-dark py-2 px-3 border-0 text-light" name="admin_registration" value="Register">
</div>
</form>
</div>
</div>
</div>
</body>
</html>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>

<?php
if(isset($_POST['admin_registration'])){
$username=$_POST['username'];
$email=$_POST['email'];
$password=$_POST['password'];
$hash_password=password_hash($password, PASSWORD_DEFAULT);
$confirm_password=$_POST['confirm_password'];


//select query

$select_query="Select * from `admin` where username='$username' or admin_email='$email'";
$result=mysqli_query($conn, $select_query);
$rows_count=mysqli_num_rows($result);
if ($rows_count>0){
echo "<script> alert('Username and Email already exist')</script>"; 
}else if($password!=$confirm_password){
  echo "<script> alert('Passwords do not match')</script>";
}
else{
$insert_query="insert into `admin` (username,admin_email,password) values ('$username','$email','$hash_password')";
$sql_execute=mysqli_query($conn,$insert_query);
header('Location: index.php');
    exit();
}
}
?>