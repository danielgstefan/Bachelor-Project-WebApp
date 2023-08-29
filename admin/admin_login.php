

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<style>

    body{
        overflow: hidden;
    }
</style>
    
</head>
  <body>
  
<div class="container-fluid m-3">
<h2 class="text-center mb-5">Admin Login</h2>
<div class="row d-flex justify-content-center"> 
<div class="col-lg-6 ">
<img src="images/GDS.png" alt="Admin Login" class="img-fluid">
</div>
<div class="col-lg-6 col-xl-4">
<form action="" method="post">
<div class="form-outline mb-4">
<label for="username"class="form-label">Username</label>
<input type="text" id="username" name="username" placeholder="Enter your username" required="required" class="form-control">
</div>
<div class="form-outline mb-4">
<label for="password" class="form-label">Password</label>
 <input type="password" id="password" name="password"placeholder="Enter your password" required="required" class="form-control">
</div>
<div>
    <input type="submit" class="bg-dark py-2 px-3 border-0 text-light" name="admin_login" value="Login">
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
include('../database/connect.php');
session_start();

if (isset($_POST['admin_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $select_query = "SELECT * FROM `admin` WHERE username='$username'";
    $result = mysqli_query($conn, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);
    
    if ($row_count == 1 && password_verify($password, $row_data['password'])) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit();
    } else {
        echo "<script>alert('Invalid Credentials')</script>";
    }
}
?>
