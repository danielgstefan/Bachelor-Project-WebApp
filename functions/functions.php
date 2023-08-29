<?php

include('./database/connect.php');

function getproducts(){
global $conn;

if(!isset($_GET['category'])){
  if(!isset($_GET['brand'])){
    $select_query="Select * from `product` order by rand() LIMIT 0,9"; 
    $result_query=mysqli_query($conn, $select_query);
    // $row=mysqli_fetch_assoc($result_query); //echo $row['product_title'];
    while($row=mysqli_fetch_assoc($result_query)){
    $item_id=$row['item_id'];
    $brand_id=$row['brand_id'];
    $item_name=$row['item_name'];
    $item_price=$row['item_price'];
    $item_image1=$row['item_image1'];
    $item_description=$row['item_description'];
    $category_id=$row['category_id'];
    echo"<div class='col-md-4 mb-2'>
    <div class='card'>
    <img src='./admin/$item_image1'
       class='card-img-top' alt='$item_name'>
      <div class='card-body'>
        <h5 class='card-title'>$item_name</h5>
        <p class='card-text'>Price: $$item_price</p>
        <a href='index.php?add_to_cart=$item_id' class='btn btn-danger'>Add to cart</a>
        <a href='product_details.php?item_id=$item_id' class='btn btn-secondary'>View more</a>
      </div>
    </div>
    </div>";
    }
}
}
}


function get_all_products(){
  global $conn;

  if(!isset($_GET['category'])){
    if(!isset($_GET['brand'])){
      $select_query="Select * from `product` order by rand()"; 
      $result_query=mysqli_query($conn, $select_query);
      // $row=mysqli_fetch_assoc($result_query); //echo $row['product_title'];
      while($row=mysqli_fetch_assoc($result_query)){
      $item_id=$row['item_id'];
      $brand_id=$row['brand_id'];
      $item_name=$row['item_name'];
      $item_price=$row['item_price'];
      $item_image1=$row['item_image1'];
      $item_description=$row['item_description'];
      $category_id=$row['category_id'];
      echo"<div class='col-md-4 mb-2'>
      <div class='card'>
      <img src='./admin/$item_image1'
         class='card-img-top' alt='$item_name'>
        <div class='card-body'>
          <h5 class='card-title'>$item_name</h5>
          <p class='card-text'>Price: $$item_price</p>
          <a href='index.php?add_to_cart=$item_id' class='btn btn-danger'>Add to cart</a>
          <a href='product_details.php?item_id=$item_id' class='btn btn-secondary'>View more</a>
        </div>
      </div>
      </div>";
      }
  }
  }
}

function get_unique_cat(){
  global $conn;
  
  if(isset($_GET['category'])){
    $category_id=$_GET['category'];
      $select_query="Select * from `product` where category_id=$category_id"; 
      $result_query=mysqli_query($conn, $select_query);
$num_of_rows=mysqli_num_rows($result_query);
if($num_of_rows==0){
echo "<h2 class='text-center text-danger ml-3'>No stock for this category</h2>";
}

      while($row=mysqli_fetch_assoc($result_query)){
      $item_id=$row['item_id'];
      $brand_id=$row['brand_id'];
      $item_name=$row['item_name'];
      $item_price=$row['item_price'];
      $item_image1=$row['item_image1'];
      $item_description=$row['item_description'];
      $category_id=$row['category_id'];
      echo"<div class='col-md-4 mb-2'>
      <div class='card'>
      <img src='./admin/$item_image1'
         class='card-img-top' alt='$item_name'>
        <div class='card-body'>
          <h5 class='card-title'>$item_name</h5>
          <p class='card-text'>Price: $$item_price</p>
          <a href='index.php?add_to_cart=$item_id' class='btn btn-danger'>Add to cart</a>
          <a href='product_details.php?item_id=$item_id' class='btn btn-secondary'>View more</a>
        </div>
      </div>
      </div>";
      }
  }
  }
  

  function get_unique_brands(){
    global $conn;
    
    if(isset($_GET['brand'])){
      $brand_id=$_GET['brand'];
        $select_query="Select * from `product` where brand_id=$brand_id"; 
        $result_query=mysqli_query($conn, $select_query);
  $num_of_rows=mysqli_num_rows($result_query);
  if($num_of_rows==0){
  echo "<h2 class='text-center text-danger ml-3'>No stock for this brand</h2>";
  }
  
        while($row=mysqli_fetch_assoc($result_query)){
        $item_id=$row['item_id'];
        $brand_id=$row['brand_id'];
        $item_name=$row['item_name'];
        $item_price=$row['item_price'];
        $item_image1=$row['item_image1'];
        $item_description=$row['item_description'];
        $category_id=$row['category_id'];
        echo"<div class='col-md-4 mb-2'>
        <div class='card'>
        <img src='./admin/$item_image1'
           class='card-img-top' alt='$item_name'>
          <div class='card-body'>
            <h5 class='card-title'>$item_name</h5>
            <p class='card-text'>Price: $$item_price</p>
            <a href='index.php?add_to_cart=$item_id' class='btn btn-danger'>Add to cart</a>
            <a href='product_details.php?item_id=$item_id' class='btn btn-secondary'>View more</a>
          </div>
        </div>
        </div>";
        }
    }
    }

function getbrands(){
  global $conn;
  $select_brands="Select * from `brands`";
  $result_brands=mysqli_query($conn, $select_brands);
  while($row_data=mysqli_fetch_assoc($result_brands)){
  $brand_title=$row_data['brand_title'];
  $brand_id=$row_data['brand_id'];
  echo "<li class='nav-item'>
  <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a> </li>";
  }

}

function getcategory(){
  global $conn;
  $select_categories="Select * from `categories`";
  $result_categories=mysqli_query($conn, $select_categories);
  while($row_data=mysqli_fetch_assoc($result_categories)){
  $category_title=$row_data['category_title'];
  $category_id=$row_data['category_id'];
  echo "<li class='nav-item'>
  <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a> </li>";
  }

}

function search_product(){
  global $conn;
if(isset($_GET['search_data_product'])){
$search_data_value=$_GET['search_data'];
      $search_query="Select * from `product` where item_key like '%$search_data_value%'"; 
      $result_query=mysqli_query($conn, $search_query);
      $num_of_rows=mysqli_num_rows($result_query);
if($num_of_rows==0){
echo "<h1 class='text-center text-danger p-3'>No results match</h1>";
}
      while($row=mysqli_fetch_assoc($result_query)){
      $item_id=$row['item_id'];
      $brand_id=$row['brand_id'];
      $item_name=$row['item_name'];
      $item_price=$row['item_price'];
      $item_image1=$row['item_image1'];
      $item_description=$row['item_description'];
      $category_id=$row['category_id'];
      echo"<div class='col-md-4 mb-2'>
      <div class='card'>
      <img src='./admin/$item_image1'
         class='card-img-top' alt='$item_name'>
        <div class='card-body'>
          <h5 class='card-title'>$item_name</h5>
          <p class='card-text'>Price: $$item_price</p>
          <a href='index.php?add_to_cart=$item_id' class='btn btn-danger'>Add to cart</a>
          <a href='product_details.php?item_id=$item_id' class='btn btn-secondary'>View more</a>
        </div>
      </div>
      </div>";
      }
  }
}

// view details function
function view_details(){

  global $conn;
if(isset($_GET['item_id'])){
  if(!isset($_GET['category'])){
    if(!isset($_GET['brand'])){
      $item_id=$_GET['item_id'];
      $select_query="Select * from `product` where item_id=$item_id"; 
      $result_query=mysqli_query($conn, $select_query);
     
      while($row=mysqli_fetch_assoc($result_query)){
      $item_id=$row['item_id'];
      $brand_id=$row['brand_id'];
      $item_name=$row['item_name'];
      $item_price=$row['item_price'];
      $item_image1=$row['item_image1'];
      $item_image2=$row['item_image2'];
      $item_image3=$row['item_image3'];
      $item_description=$row['item_description'];
      $category_id=$row['category_id'];
      echo"<div class='row px-1 ml-6'>
      <div class='container'>'
          <div class='row'>
              <div class='col-md-4'>
                  <div class='card'>
                      <img src='./admin/$item_image1' class='card-img-top' alt='$item_name'>
                      <div class='card-body'>
                          <h5 class='card-title'>$item_name</h5>
                          <p class='card-text'>Price: $$item_price</p>
                          <a href='index.php?add_to_cart=$item_id' class='btn btn-danger'>Add to cart</a>
                          <a href='index.php' class='btn btn-secondary'>Home</a>
                      </div>
                  </div>
              </div>
              <div class='col-md-8'>
                  <!-- Coloana 2 -->
                  <div class='row'>
                      <div class='col-md-12'>
                          <h4 class='text-center mb-5'>More images</h4>
                      </div>
                      <div class='col-md-6'>
                          <img src='./admin/$item_image2' class='card-img-top' alt='$item_name'>
  
                      </div>
                      <div class='col-md-6'>
                          <img src='./admin/$item_image3' class='card-img-top' alt='$item_name'>
  
                      </div>
                  </div>
                  <div class='row'>
                  <div class='d-flex '>
    <div class='return text-center mr-5'>
        <div class='font-size-20 my-2 color-second'>
            <span class='fas fa-retweet border p-3 rounded-pill'></span>
        </div>
        <a href='#' class='font-neuton font-size-12 color-second'>14 Days <br>to Return</a>
    </div>
    <div class='return text-center mr-5'>
        <div class='font-size-20 my-2 color-second'>
            <span class='fas fa-truck border p-3 rounded-pill'></span>
        </div>
        <a href='#' class='font-neuton font-size-12 color-second'>GDS <br>Delivery</a>
    </div>
    <div class='return text-center mr-5'>
        <div class='font-size-20 my-2 color-second'>
            <span class='fas fa-check-double border p-3 rounded-pill'></span>
        </div>
        <a href='#' class='font-neuton font-size-12 color-second'>1 Year <br>Warranty</a>
    
    </div>
</div>
                  </div>
              </div>
          </div>
          <div class='row'>
              <div class='row mt-5'>
                  <h4 class='text-center mb-5'>Product Description</h4>
              </div>
              <div class='row mb-5'>
                  <p class='card-text'>$item_description</p>
              </div>
          </div>
      </div>
  </div>";


      }
  }
  }
}
}

//get ip address function
function getIPAddress() {  
  //whether ip is from the share internet  
   if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
              $ip = $_SERVER['HTTP_CLIENT_IP'];  
      }  
  //whether ip is from the proxy  
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
              $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
   }  
//whether ip is from the remote address  
  else{  
           $ip = $_SERVER['REMOTE_ADDR'];  
   }  
   return $ip;  
}  
//$ip = getIPAddress();  
//echo 'User Real IP Address - '.$ip; 

//cart function
function cart(){
if(isset($_GET['add_to_cart'])){
global $conn;
$get_ip_add = getIPAddress(); 
$get_item_id=$_GET['add_to_cart'];
$select_query="Select * from `cart_details` where ip_address= '$get_ip_add' and item_id=$get_item_id";
$result_query=mysqli_query($conn, $select_query);
$num_of_rows=mysqli_num_rows($result_query);
if($num_of_rows>0){
//echo "<script>alert('This item is already present inside cart') </script>";
echo "<script>window.open('index.php', '_self')</script>";
}else{
$insert_query="insert into `cart_details` (item_id,ip_address, quantity) values ($get_item_id, '$get_ip_add',1)";
 $result_query=mysqli_query($conn, $insert_query);
echo "<script>window.open('index.php','_self')</script>";

}
}
}

//function to get cart item number
function cart_item() {
  if (isset($_GET['add_to_cart'])) {
    global $conn;
    $get_ip_add = getIPAddress();
    $product_id = $_GET['add_to_cart'];

    // Verifică dacă produsul există deja în coș
    $check_query = "SELECT * FROM `cart_details` WHERE item_id = '$product_id' AND ip_address = '$get_ip_add'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
      // Produsul există deja în coș, nu adăuga din nou
      echo "Product already exists in the cart.";
    } else {
      // Produsul nu există în coș, adaugă-l
      $insert_query = "INSERT INTO `cart_details` (item_id, ip_address, quantity) VALUES ('$product_id', '$get_ip_add', 1)";
      mysqli_query($conn, $insert_query);
    }
  }

  // Calculează suma coloanei "quantity" din tabela "cart_details"
  global $conn;
  $get_ip_add = getIPAddress();
  $select_query = "SELECT SUM(quantity) AS total_quantity FROM cart_details WHERE ip_address = '$get_ip_add'";
  $result_query = mysqli_query($conn, $select_query);
  $row = mysqli_fetch_assoc($result_query);
  $total_quantity = $row['total_quantity'];

  echo $total_quantity;
}


//total price function
function total_cart_price() {
  global $conn;
  $get_ip_add = getIPAddress();
  $total_price = 0;
  $cart_query = "SELECT cart_details.quantity, product.item_price FROM cart_details INNER JOIN product ON cart_details.item_id = product.item_id WHERE ip_address = '$get_ip_add'";
  $result = mysqli_query($conn, $cart_query);

  while ($row = mysqli_fetch_array($result)) {
    $quantity = $row['quantity'];
    $price = $row['item_price'];
    $subtotal = $quantity * $price;
    $total_price += $subtotal;
  }

  return $total_price;
}





function get_user_order_details(){
global $conn;
$username=$_SESSION['username'];
$get_details="Select * from `user` where username='$username'"; 
$result_query=mysqli_query($conn, $get_details);
while($row_query=mysqli_fetch_array($result_query)){
$user_id=$row_query['user_id'];
if(!isset($_GET['edit_account'])){
if(!isset($_GET['my_orders'])){
if(!isset($_GET['delete_account'])){
$get_orders="Select * from `orders` where user_id=$user_id and order_status='pending'";
$result_order_query=mysqli_query($conn, $get_orders);
$row_count=mysqli_num_rows($result_order_query);
if($row_count>0){
  echo "<h3 class='text-center text-success mt-5'>You have <span class='text-danger'>$row_count</span> pending orders</h3>
  <p class='text-center text-dark'><a href='profile.php?my_orders'>Order Details</a></p>";
}else{
  echo "<h3 class='text-center text-success mt-5'>You have 0 pending orders</h3>
  <p class='text-center text-dark'><a href='index.php'>Explore our products</a></p>";
}
}
}
}
}
}