<?php
include('./database/connect.php');
?>
<?php
ob_start();
// include header.php file
include('header.php');

if(isset($_GET['order_id'])){
    $order_id=$_GET['order_id'];
$select_data="Select * from `orders` where order_id=$order_id";
$result=mysqli_query($conn,$select_data);
$row_fetch=mysqli_fetch_assoc($result);
$invoice_number=$row_fetch['invoice_number'];
$amount_due=$row_fetch['amount_due'];
}
if(isset($_POST['confirm_payment'])){
$invoice_number=$_POST['invoice_number'];
$amount=$_POST['amount'];
$payment_mode=$_POST['payment_mode'];
$insert_query="insert into `payments` (order_id,invoice_number, amount, payment_mode) values ($order_id, $invoice_number, $amount, '$payment_mode')";
$result=mysqli_query($conn,$insert_query);
if($result) {
  echo "<h3 class='text-center text-light'>Successfully completed the payment</h3>"; 
echo "<script>window.open('profile.php?my_orders','_self')</script>";  
}

$update_orders="update `orders` set order_status='Complete' where order_id=$order_id"; 
$result_orders=mysqli_query($conn, $update_orders);
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>

<body class="bg-dark">
<div class="container my-5">
<h1 class="text-center text-light">Confirm Payment</h1> 
<form action="" method="post">
<div class="form-outline my-4 text-center w-50 m-auto">
<input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number?>">
</div>
<div class="form-outline my-4 text-center w-50 m-auto">
<label for="" class="text-light">Amount</label>
<input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due?>" > </div>
<div class="form-outline my-4 text-center w-50 m-auto">
<select name="payment_mode" class="form-select w-50 m-auto">
<option>Select Payment Mode</option>
<option>Cash on Delivery</option>
<option>Paypall</option>
<option>Paymen order</option>
<option>Visa/Mastercard</option>
</select>
</div>
<div class="form-outline my-4 text-center w-50 m-auto">
<input type="submit" class="color-secondary-bg py-2 px-3 border-0" value="Confirm" name="confirm_payment">
</div>
</form>
</div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>