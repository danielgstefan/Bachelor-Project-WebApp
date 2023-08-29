<?php
include('./database/connect.php');
?>
<?php
ob_start();
// include header.php file
include('header.php');
?>
<style>
.profile_img{
    height: 80%;
    width: 80%;
    object-fit: contain;
}
</style>
<div class="row">
<div class="col-md-2 p-0">
<ul class="navbar-nav bg-dark text-center">
<li class="nav-item bg-dark">
<a class="nav-link text-light" href="#"><h4>Your profile</h4></a>
</li>
<?php
$username=$_SESSION['username'];
$user_image="Select * from `user` where username= '$username'";
$user_image=mysqli_query($conn, $user_image);
$row_image=mysqli_fetch_array($user_image);
$user_image=$row_image['user_image'];
echo "<li class='nav-item'><img src='admin/images/$user_image' class='profile_img my-4'></li>";
?>



<li class="nav-item bg-dark">
<a class="nav-link text-light" href="profile.php"><h4>Pending orders</h4></a>
</li>
<li class="nav-item bg-dark">
<a class="nav-link text-light" href="profile.php?edit_account"><h4>Edit Account</h4></a>
</li>
<li class="nav-item bg-dark">
<a class="nav-link text-light" href="profile.php?my_orders"><h4>My orders</h4></a>
</li>
<li class="nav-item bg-dark">
<a class="nav-link text-light" href="profile.php?delete_account"><h4>Delete account</h4></a>
</li>
<li class="nav-item bg-dark">
<a class="nav-link text-light" href="logout.php"><h4>Logout</h4></a>
</li>

</ul>
</div>
<div class="col-md-10">
    <?php get_user_order_details();
    if(isset($_GET['edit_account'])){
        include('edit_account.php');
    }
    if(isset($_GET['my_orders'])){
        include('user_orders.php');
    }
    if(isset($_GET['delete_account'])){
        include('delete_account.php');
    }
    ?>
</div> 
</div>

<?php
// include footer.php file
include('footer.php');
?>