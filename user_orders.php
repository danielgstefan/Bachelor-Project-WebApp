

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <style>
    .thead.color{
        color: cyan;
    }
  </style>
</head>
  <body>
<?php
$username=$_SESSION['username'];
$get_user="SELECT * FROM `user` where username='$username'";
$result=mysqli_query($conn,$get_user);
$row_fetch=mysqli_fetch_assoc($result);
$user_id=$row_fetch['user_id'];

?>
<h3 class="text-success text-center">All my Orders</h3> 
<table class="table table-bordered mt-5 ">
<thead class="thead.color">
<tr>
<th>Order</th>
<th>Amount Due</th>
<th>Total products</th>
<th>Invoice number</th>
<th>Date</th>
<th>Complete/Incomplete </th>
<th>Status</th>
</tr>
</thead>
<tbody class="bg-info">
    <?php
$get_order_details="SELECT * FROM `orders` where user_id=$user_id";
$result_orders=mysqli_query($conn,$get_order_details);
$number = 1;
while($row_orders=mysqli_fetch_assoc($result_orders)){
    $order_id=$row_orders['order_id'];
    $amount_due=$row_orders['amount_due'];
    $total_products=$row_orders['total_products'];
    $invoice_number=$row_orders['invoice_number'];
    $order_status=$row_orders['order_status'];
    if($order_status=='pending'){
        $order_status='Incomplete';
    }else{
        $order_status='Complete';
    }
    $order_date=$row_orders['order_date'];
     
    echo "<tr>
    <td>$number</td>
    <td>$amount_due</td>
    <td>$total_products</td>
    <td>$invoice_number</td>
    <td>$order_date</td>
    <td>$order_status</td>";?>
<?php
if($order_status=='Complete'){
    echo "<td>Paid</td>";
}else{

   echo "<td><a href='confirm_payment.php?order_id=$order_id'>Confirm</a></td>
    </tr>";
}
    $number++;
}



?>

</tbody>
</table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>