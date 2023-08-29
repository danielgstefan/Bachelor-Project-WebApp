<?php
include('../database/connect.php');
session_start();

// Verifică dacă utilizatorul este logat
if (!isset($_SESSION['username'])) {
    header('Location: admin_login.php');
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container-fluid p-0">
        <nav class="nav navbar navbar-expand-lg navbar-light bg-primary">
            <div class="container-fluid">
                <img src="images/logo.png" alt="" class="logo">
                <nav class="nav navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <?php if(!isset($_SESSION['username'])){
      echo "<a class='nav-link nav-item active' href='user_login.php'>Welcome Guest</a>";

    }else{
      echo "<a class='nav-link nav-item active text-light' href='#'>".$_SESSION['username']."</a>";
    }?>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
        <div class="bg-light"></div>
        <h3 class="text-center p-2">Manage Details</h3>
    </div>
    <div class="row">
        <div class="col-md-12 bg-primary p-1 d-flex align-items-center p-3">
            <div>
                <a href="#"><img src="images/logo.png" class="admin-image" alt=""></a>
               <?php echo "<p class='text-light'> Welcome ".$_SESSION['username']."</p>";?>
            </div>
            <div class="button text-center">
                <button><a href="index.php?viewproducts" class="nav-link text-light bg-secondary">Insert/View Products</a></button>
                <button><a href="index.php?viewcategory" class="nav-link text-light bg-secondary">Insert/View Categories</a></button>
                <button><a href="index.php?viewbrands" class="nav-link text-light bg-secondary">Insert/View Brands</a></button>
                <button><a href="index.php?vieworders" class="nav-link text-light bg-secondary">All orders</a></button>
                <button><a href="index.php?viewpayments" class="nav-link text-light bg-secondary">All payments</a></button>
                <button><a href="index.php?viewusers" class="nav-link text-light bg-secondary">User List</a></button>
                <button><a href="admin_registration.php" class="nav-link text-light bg-secondary">Create a new Admin</a></button>
                <button><a href="logout.php" class="nav-link text-light bg-secondary">Logout</a></button>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <?php
        if(isset($_GET['viewproducts'])){ 
            include('reportP.php');
        }
        if(isset($_GET['viewcategory'])){ 
            include('reportC.php');
        }
        if(isset($_GET['viewbrands'])){ 
            include('reportB.php');
        }
        if(isset($_GET['vieworders'])){ 
            include('reportO.php');
        }
        if(isset($_GET['viewpayments'])){ 
            include('reportPM.php');
        }
        if(isset($_GET['viewusers'])){ 
            include('reportU.php');
        }
    

        ?>
    </div>

    <?php
    // include footer.php file
    include('../footer.php');
    ?>
</body>
</html>
