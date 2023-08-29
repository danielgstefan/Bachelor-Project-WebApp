<?php
include('./database/connect.php');
?>
<?php
ob_start();
// include header.php file
include('header.php');
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid my-3">
<h2 class="text-center">New User Register</h2>
<div class="row d-flex align-items-center justify-content-center">
<div class="col-lg-12 col-xl-6">
<form action="" method="post" enctype="multipart/form-data">

<div class="form-outline mb-4">
<label for="username" class="form-label">Username</label>
<input type="text" id="username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="username">
</div>
<div class="form-outline mb-4">
<label for="first_name" class="form-label">First name</label>
<input type="text" id="first_name" class="form-control" placeholder="Enter your first name" autocomplete="off" required="required" name="first_name">
</div>
<div class="form-outline mb-4">
<label for="last_name" class="form-label">Last name</label>
<input type="text" id="last_name" class="form-control" placeholder="Enter your last name" autocomplete="off" required="required" name="last_name">
</div>

<div class="form-outline mb-4">
<label for="email" class="form-label">Email</label>
<input type="text" id="email" class="form-control" placeholder="Enter your email" autocomplete="off" required="required" name="email">
</div>

<div class="form-outline mb-4">
<label for="user_image" class="form-label">Image</label>
<input type="file" id="user_image" class="form-control" placeholder="Enter your image" autocomplete="off" required="required" name="user_image">
</div>
<div class="form-outline mb-4">
<label for="password" class="form-label">Password</label>
<input type="password" id="password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="password">
</div>
<div class="form-outline mb-4">
<label for="conf_user_password" class="form-label">Confirm Password</label>
<input type="password" id="conf_user_password" class="form-control" placeholder="Confirm your password" autocomplete="off" required="required" name="conf_user_password">
</div>
<div class="form-outline mb-4">
<label for="address" class="form-label">Address</label>
<input type="text" id="address" class="form-control" placeholder="Enter your address" autocomplete="off" required="required" name="address">
</div>
<div class="form-outline mb-4">
<label for="pnumber" class="form-label">Phone Number</label>
<input type="text" id="pnumber" class="form-control" placeholder="Enter your phone number" autocomplete="off" required="required" name="pnumber">
</div>
<div class="text-center">
  <input type="submit" value="Register" class="btn btn-primary bg-primary py-2 px-3 text-white" name="user_register">
  <p class="mt-3">Already have an account?<a href="user_login.php"> Login</a></p>
  
</div>

</form>


</div>

</div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>

<?php
if(isset($_POST['user_register'])){
$username=$_POST['username'];
$email=$_POST['email'];
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$password=$_POST['password'];
$hash_password=password_hash($password, PASSWORD_DEFAULT);
$conf_user_password=$_POST['conf_user_password'];
$address=$_POST['address'];
$pnumber=$_POST['pnumber'];
$user_image=$_FILES['user_image']['name'];
$user_image_tmp=$_FILES['user_image']['tmp_name'];
$user_ip=getIPAddress();

//select query

$select_query="Select * from `user` where username='$username' or email='$email'";
$result=mysqli_query($conn, $select_query);
$rows_count=mysqli_num_rows($result);
if ($rows_count>0){
echo "<script> alert('Username and Email already exist')</script>"; 
}else if($password!=$conf_user_password){
  echo "<script> alert('Passwords do not match')</script>";
}
else{
  move_uploaded_file($user_image_tmp,"./admin/$user_image");
$insert_query="insert into `user` (username,email,first_name,last_name,password,address,pnumber,user_image,user_ip) values ('$username','$email','$first_name','$last_name','$hash_password','$address','$pnumber','$user_image','$user_ip')";
$sql_execute=mysqli_query($conn,$insert_query);

}
// selecting cart items
$select_cart_items="Select * from `cart_details` where ip_address='$user_ip'";
$result_cart=mysqli_query($conn, $select_cart_items);
$rows_count=mysqli_num_rows($result_cart);
if ($rows_count>0){
$_SESSION['username']=$username;
echo "<script> alert('You have items in your cart')</script>"; 
echo "<script>window.open('checkout.php', '_self')</script>";
 }else{
echo "<script>window.open('index.php', '_self'></script>";
}

}
?>


<?php
// include footer.php file
include('footer.php');
?>