
<?php
include('./database/connect.php');

?>
<?php
ob_start();
// include header.php file
include('header.php');
?>
<style>

</style>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid my-3">
<h2 class="text-center">Login user</h2>
<div class="row d-flex align-items-center justify-content-center">
<div class="col-lg-12 col-xl-6">
<form action="" method="post" class="mt-4">

<div class="form-outline mb-4">
<label for="username" class="form-label">Username</label>
<input type="text" id="username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="username">
</div>
<div class="form-outline mb-4">
<label for="password" class="form-label">Password</label>
<input type="password" id="password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="password">
</div>
<div class="text-center">
  <input type="submit" value="Login" class="btn btn-primary bg-primary py-2 px-3 text-white" name="user_login">
  <p class="mt-3">Don't have an account?<a href="user_register.php"> Register</a></p>
  
</div>

</form>


</div>

</div>


    </div>
    <?php
if (isset($_POST['user_login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $select_query = "SELECT * FROM `user` WHERE username='$username'";
  $result = mysqli_query($conn, $select_query);
  $row_count = mysqli_num_rows($result);
  $row_data = mysqli_fetch_assoc($result);
  $user_ip=getIPAddress();

  //cart item
  $select_query_cart = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
  $select_cart=mysqli_query($conn,$select_query_cart);
  $row_count_cart = mysqli_num_rows($select_cart);
  if ($row_count > 0) {
    $_SESSION['username']=$username;
    if (password_verify($password, $row_data['password'])) {
      //echo "<script>alert('Login successful')</script>";
      if($row_count==1 and $row_count_cart==0)
      {
        $_SESSION['username']=$username;
        echo "<script>alert('Login successful')</script>";
        echo "<script>window.open('profile.php','_self')</script>";
      }else{
        $_SESSION['username']=$username;
        echo "<script>alert('Login successful')</script>";
        echo "<script>window.open('payment.php','_self')</script>";
      }
    } else {
      echo "<script>alert('Invalid Credentials')</script>";
    }
  } else {
    echo "<script>alert('Invalid Credentials')</script>";
  }
}

    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>
<?php
// include footer.php file
include('footer.php');
?>
