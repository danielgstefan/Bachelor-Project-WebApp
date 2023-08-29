<?php
// Configurarea conexiunii la baza de date
$servername = 'localhost';
$username = 'root';
$password = '';
$database = "mogds";

// Crearea conexiunii
$conn = new mysqli($servername, $username, $password, $database);

// Verificați conexiunea
if ($conn->connect_error) {
    die("Conexiunea la baza de date a eșuat: " . $conn->connect_error);
}



session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magazin Online GDS</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<!--Carousel-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!--Font Awesome-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="style.css">

<?php
//require functions
require('./functions/functions.php');
?>

</head>
<body>

<!-- header-->
<header id="header">
    

<!--Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark color-primary-bg">
    <img src="./admin/images/logo.png" class="logo" >
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav m-auto font-lobster">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="display_all.php">Products </a>
        </li>
          <li class="nav-item active ">
            <a class="nav-link " href="cart.php">Total price: $<?php echo total_cart_price();?></a>
          </li>
        <?php
    if(!isset($_SESSION['username'])){
      echo "<a class='nav-link nav-item active' href='user_register.php'>Register</a>";
      echo "<a class='nav-link nav-item active' href='user_login.php'>Welcome Guest</a>";

    }else{
      echo "<a class='nav-link nav-item active' href='profile.php'>Welcome ".$_SESSION['username']."</a>";
    }
    if(!isset($_SESSION['username'])){

      echo "<a class='nav-link nav-item active' href='user_login.php'>Login</a>";
    }else{
      echo "<a class='nav-link nav-item active' href='logout.php'>Logout</a>";
    }
    ?>
      </ul>
      <nav class="navbar navbar-light color-primary-bg ">
  <form class="form-inline" action="search_product.php" method="get">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
    <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
  </form>
</nav>


      <form action="#" class="font-size-14 font-neuton">
<a href="cart.php" class="py-2 rounded-pill color-primary-bg">
<span class="font-size-16 px-2 text-white"><i class="fas fa-shopping-cart"></i></span>
<span class="px-3 py-2 rounded-pill text-dark bg-light">  <?php cart_item(); ?></span>
</a>

      </form>
    </div>
  </nav>
<?php
cart();

?>

</header>

<!-- main-->

<main id="main-site">