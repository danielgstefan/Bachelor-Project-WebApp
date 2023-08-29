
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
    <title>Payment page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
<style>
    img{
        width: 100%;
    }
</style>

  <body>
<!-- php code-->
<?php
$user_ip=getIPAddress();
$get_user="Select * from `user` where user_ip='$user_ip'";
$result=mysqli_query($conn,$get_user);
 $run_query=mysqli_fetch_array($result);
$user_id=$run_query['user_id'];
?>
<div class="container">
<h2 class="text-center text-info">Payment options</h2>
<div class="row d-flex justify-content-center align-items-center my-5">
<div class="col-md-6">
<a href="https://www.paypal.com" target="_blank"><img src="./admin/images/paypall.png" alt=""></a>
</div>
<div class="col-md-6">
<a href="order.php?user_id=<?php echo $user_id ?>"> <h2 class="text-center">Pay offline</h2></a>
</div>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>